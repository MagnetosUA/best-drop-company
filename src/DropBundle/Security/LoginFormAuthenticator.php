<?php

namespace DropBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use DropBundle\Form\Type\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Security;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $em,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->attributes->get('_route') === 'security.login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }

        $form = $this->formFactory->create(LoginType::class);
        $form->handleRequest($request);
        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );
        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];
        return $this->em->getRepository('DropBundle:User')
            ->findOneBy(['email' => $username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            return true;
        }
        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security.login');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // if the user hits a secure page and start() was called, this was
        // the URL they were on, and probably where you want to redirect to
        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);

        if (!$targetPath) {
            $targetPath = $this->router->generate('guest.home');
        }
        return new RedirectResponse($targetPath);
    }
}

