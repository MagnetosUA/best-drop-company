<?php

namespace DropBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use DropBundle\Entity\User;
use DropBundle\Entity\Ord;

class OrderVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }
//        // only vote on Ord objects inside this voter
        if (!$subject instanceof Ord) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // ROLE_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        /** @var Ord $ord */
        $ord = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($ord, $user);
            case self::EDIT:
                return $this->canEdit($ord, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(Ord $ord, User $user)
    {
        return $user === $ord->getUser();
    }

    private function canView(Ord $ord, User $user)
    {
        if ($this->canEdit($ord, $user)) {
            return true;
        }
        return false;
    }

}

