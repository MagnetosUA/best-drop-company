<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Ord;
use Droparea\DropBundle\Services\GetNewPostAddressFromDB;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class OrderClientType extends AbstractType
{
    public $staticSitiesFull = ["Авангард", "Авдіївка", "Авіаторське", "Агрономічне", "Аджамка", "Ананьїв", "Андріївка (Балаклійський р-н)", "Андріївка (Бердянський р-н)", "Андрушівка", "Антонівка (Скадовський р-н)", "Антоніни", "Апостолове", "Арбузинка", "Арциз", "Асканія-Нова", "Аули", "Бабаї", "Бабанка", "Балабине", "Балаклея (Черкаська обл.)", "Балаклія (Харківська обл.)", "Балки (Запорізька обл.)", "Балта", "Банилів", "Бар", "Баранинці (Закарпатська обл.)", "Баранівка", "Барвінкове", "Баришівка", "Батурин", "Бахмач", "Бахмут", "Баштанка", "Безлюдівка", "Бердичів", "Бердянськ", "Берегове", "Берегомет", "Бережани (Тернопільська обл.)", "Березанка(Миколаївська обл.)", "Березань", "Березівка", "Березна (Чернігівська обл.)", "Березне", "Березнегувате", "Берестечко", "Берислав (Херсонська обл.)", "Бершадь", "Билбасівка", "Бишів", "Бібрка", "Біла", "Біла Криниця (Рівненська обл.)", "Біла Церква", "Білгород-Дністровський", "Біленьке(Запорізька обл.)", "Білики", "Білицьке(Донецька обл.)", "Білки", "Біловодськ", "Білогір'я", "Білогородка", "Білозерка (Херсонська обл.)", "Білозерське (Донецька обл.)", "Білозір'я", "Білокуракине", "Білолуцьк", "Білопілля", "Більмак (Запорізька обл.)", "Більшівці", "Біляївка", "Благовіщенка (Кам'янсько-Дніпровський р-н)", "Благовіщенське(Кіровоградська обл.)", "Близнюки", "Бобринець", "Бобровиця", "Богдан", "Богданівка (Дніпропетровська обл.)", "Богданівка (Кіровоградська обл.)", "Богодухів", "Богородчани", "Богуслав (Дніпропетровська обл.)", "Богуслав (Київська обл.)", "Божедарівка(Криничанський р-н)", "Болград (Одеська обл.)", "Болехів", "Борзна", "Борислав (Львівська обл.)", "Бориспіль", "Борівське(Луганська обл.)", "Борова (Київська обл.)", "Борова (Харківська обл.)", "Бородянка", "Боромля (Сумська обл.)", "Борщів", "Бохоники", "Бояни", "Боярка", "Браїлів", "Братське", "Брацлав", "Брилівка", "Бровари", "Броди", "Бронниця", "Брошнів-Осада", "Брусилів", "Брюховичі", "Буди (Харківська обл.)", "Буки", "Буринь", "Бурштин", "Буськ", "Буча", "Бучач", "Буштино", "Валки", "Вапнярка", "Вараш", "Варва", "Василівка (Запорізька обл.)", "Васильків", "Васильківка (Дніпропетровська обл.)", "Ватутіне", "Вашківці (Вижницький р-н)", "Велика Багачка", "Велика Березовиця", "Велика Білозерка", "Велика Виска (Маловисківський р-н.)", "Велика Димерка", "Велика Знам'янка", "Велика Лепетиха", "Велика Михайлівка", "Велика Новосілка", "Велика Олександрівка (Херсонська обл.)", "Велика Писарівка", "Велика Чернеччина", "Великий Березний", "Великий Бичків", "Великий Бурлук", "Великий Дальник", "Великий Кучурів", "Великий Любінь", "Великі Бірки", "Великі Гаї", "Великі Копані", "Великі Кринки (Глобинський р-н)", "Великі Лучки", "Великі Мости", "Великі Сорочинці", "Великодолинське", "Велятин", "Вендичани", "Верба(Рівненська обл.)", "Вербка", "Верхівцеве", "Верхнє Водяне", "Верхнє Синьовидне", "Верхній Рогачик", "Верхньодніпровськ", "Верхня Сироватка", "Верховина", "Веселе (Запорізька обл.)", "Веселинове", "Вигода (Івано-Франківська обл)", "Вижниця", "Вилкове", "Вилок (Закарпатська обл.)", "Винники", "Виноградів", "Випасне (Білгород-Дністровський р-н)", "Вири", "Вирішальне (Лохвицький р-н)", "Високий", "Високопілля", "Вишгород", "Вишеньки", "Вишково", "Вишневе", "Вишнівець", "Війтівка", "Війтівці (Хмельницька обл.)", "Вільне (Криворізький р-н)", "Вільне(Новомосковський р-н)", "Вільногірськ", "Вільнянськ", "Вільхівці", "Вільшана (Черкаська обл.)", "Вільшана(Сумська обл.)", "Вільшани (Харківська обл.)", "Вільшанка (Кіровоградська обл.)", "Вінницькі Хутори", "Вінниця", "Віньківці", "Власівка", "Вовчанськ", "Вовчинець", "Водяне (Кам'янсько-Дніпровський р-н)", "Вознесенськ", "Волноваха", "Воловець", "Володарка", "Володимир-Волинський", "Володимирець", "Володимирівка (Донецька обл.)", "Волочиськ", "Ворзель", "Ворожба (Білопільський р-н)", "Вороніж", "Вороновиця", "Вороньків", "Ворохта", "Воскресенське (Миколаївська обл.)", "Врадіївка", "Вугледар", "Вузлове", "Гавришівка", "Гадяч", "Гайворон", "Гайсин", "Галич", "Гвардійське (Дніпропетровськ)", "Гвіздець", "Гельмязів", "Генічеськ", "Геронимівка", "Герца", "Гірник", "Гірське", "Глеваха", "Глибока", "Глобине", "Глухів (Сумська обл.)", "Глухівці", "Гнівань", "Гніздичів", "Гоголеве (Полтавська обл.)", "Гоголів(Броварський р-н)", "Гола Пристань", "Голоби", "Голованівськ", "Головне", "Голубівка", "Гончарівське", "Горінчово", "Горішні Плавні", "Горностаївка", "Городенка", "Городець", "Городище (Черкаська обл.)", "Городківка", "Городня", "Городок(Львівська обл.)", "Городок(Хмельницька обл.)", "Горохів", "Горького", "Гоща", "Градизьк", "Гребінка (Полтавська обл.)", "Гребінки (Київська обл.)", "Григорівка", "Гримайлів", "Гришківці", "Губиниха", "Гуляйполе", "Гусятин", "Давидів", "Дар'ївка", "Дачне", "Дашів", "Дворічна", "Делятин", "Демидів", "Демидівка", "Деражня", "Дергачі", "Десна (Вінницька обл.)", "Десна (Чернігівська обл.)", "Джулинка (Бершадський р-н)", "Джурин (Шаргородський р-н.)", "Диканька", "Димер", "Ділове", "Дмитрівка (Знам'янський р-н Кіровоградська обл.)", "Дмитрівка (Чернігівська обл.)", "Дніпро", "Дніпровка (Запорізька обл.)", "Дніпровське", "Дніпрорудне", "Добровеличківка", "Добромиль", "Добропілля", "Доброслав", "Добротвір", "Довбиш", "Довге (Закарпатська обл.)", "Долина", "Долинська", "Долинське (Запорізький р-н)", "Доманівка", "Донець(Балаклійський р-н)", "Донське", "Дорошівка", "Драбів", "Драгово", "Драчинці", "Дрогобич", "Дружба (Сумська обл.)", "Дружба (Тернопільська обл.)", "Дружківка", "Дубляни (Львів.обл.,Жовків.р-н)", "Дубно", "Дубове", "Дубровиця (Рівненська обл.)", "Дударків", "Дуліби", "Дунаївці", "Дунаївці (Дунаєвецький р-н.)", "Дядьковичі (Рівненський р-н)", "Енергодар", "Єланець", "Єлизаветівка", "Ємільчине", "Єрки", "Жашків", "Жеребкове", "Жидачів", "Житомир", "Жмеринка", "Жовква", "Жовті Води", "Журавно", "Забір'я", "Заболотів (Снятинський р-н)", "Заболоття (Волинська обл.)", "Завалля (Кіровоград. обл)", "Заводське(Лохвицький р-н,Полтав. обл)", "Заводське(Тернопільська обл.)", "Зазим'я", "Залізний Порт", "Залізці", "Заліщики", "Запитів", "Запоріжжя", "Зарванці", "Зарічне(Рівненська обл.)", "Заріччя(Закарпатська обл.)", "Заставна", "Засулля", "Затока", "Захарівка(Одеська обл)", "Зачепилівка", "Збараж", "Зборів", "Звенигородка", "Згурівка", "Здолбунів", "Зеленогірське", "Зеленодольськ", "Зимна Вода", "Зіньків", "Зміїв", "Зміїнець", "Знам'янка (Кіровоградська обл.)", "Знам'янка (Одеська обл.)", "Знам'янка Друга", "Знаменівка (Новомосковський р-н)", "Зноб-Новгородське", "Зняцьово", "Золотоноша", "Золочів (Львівська обл.)", "Золочів(Харківська обл.)", "Зоря (Рівненська обл.)", "Іваничі (Волинська обл.)", "Іванівка (Одеська обл., Іванівський р-н)", "Іванівка (Херсонська обл.)", "Іванків (Іванківський р-н)", "Іванків(Бориспільський р-н)", "Івано-Франківськ", "Івано-Франкове", "Іза", "Ізмаїл", "Ізюм", "Ізяслав", "Іларіонове", "Ілічанка", "Іллінці", "Ільниця", "Іркліїв", "Ірпінь", "Іршава", "Іршанськ", "Іспас", "Ічня", "Кагарлик", "Казанка", "Каланчак", "Калинівка (Броварський р-н)", "Калинівка (Вінницька обл., Калинівський р-н)", "Калинівка(Васильківський р-н.)", "Калита", "Калуш", "Кам'янець-Подільський", "Кам'янка (Черкаська обл.)", "Кам'янка (Чернівецька обл., Глибоцький р-н)", "Кам'янка-Бузька", "Кам'янка-Дніпровська (Запорізька обл.)", "Кам'янське(Дніпропетровська обл)", "Камінь-Каширський", "Канів", "Карлівка", "Карнаухівка(Дніпропетровська обл.)", "Кароліно-Бугаз", "Карпівка (Широківський р-н)", "Катеринопіль", "Каховка", "Квасилів (Рівненська обл.)", "Кегичівка", "Кельменці", "Київ", "Кириківка(Великописарів.р-н)", "Кирилівка(Якимівський р-н)", "Кислиця", "Ківерці", "Ківшарівка", "Кілія", "Кінецьпіль", "Кіцмань", "Клавдієво-Тарасове", "Клевань", "Клесів", "Клішківці", "Княжичі (Броварський р-н)", "Кобеляки", "Коблеве", "Ковель", "Кодима", "Козацьке (Херсонська обл.)", "Козача Лопань", "Козелець", "Козельщина", "Козин (Київська обл.)", "Козин (Рівненська обл.)", "Козова", "Козятин", "Колки", "Колоденка", "Коломак", "Коломия", "Колочава", "Комар", "Комарно", "Комишани", "Комишня", "Комишуваха", "Компаніївка", "Конотоп", "Копайгород", "Копашново", "Копилів", "Копистин", "Копичинці (Гусятинський р-н)", "Корець", "Коритняни", "Корнин (Житомирська обл.)", "Королево", "Короп", "Коростень", "Коростишів", "Корсунь-Шевченківський", "Коршів", "Корюківка", "Косів", "Косонь (Косино)", "Костопіль", "Костянтинівка (Донецька обл.)", "Костянтинівка(Арбузинський р-н, Микол.обл.)", "Костянтинівка(Мелітоп.р-н,Запоріз.обл)", "Котельва", "Коцюбинське", "Краковець", "Краматорськ", "Красилів", "Красилівка (Броварський р-н)", "Красна Поляна", "Красне (Львівська обл.)", "Красноград (Харківська обл)", "Краснокутськ", "Краснопавлівка", "Краснопілля (Сумська обл.)", "Красноріченське", "Красятичі", "Кременець", "Кременчук", "Кремінна", "Криве Озеро", "Кривий Ріг", "Крижопіль", "Кримне", "Кринички", "Крихівці", "Кролевець", "Кропивницький", "Крупець", "Крюківщина", "Куликів", "Куликівка", "Куп'янськ", "Куп'янськ-Вузловий", "Курахове", "Кути (Косівський р-н)", "Кучурган", "Кушниця", "Ладан", "Ладижин", "Ладижинка", "Лазірки (Оржицький р-н)", "Лазурне (Херсонська обл.)", "Ланівці", "Ланчин", "Лебедин (Сумська обл.)", "Лебедин (Черкаська обл., Шполянський р-н)", "Летичів", "Лиман(Донецька обл)", "Лиманське (Роздільнянський р-н)", "Липини", "Липова Долина", "Липовець", "Лиса Гора", "Лисичанськ", "Лисянка", "Літин", "Лішня", "Лозова", "Лозуватка(Криворізький р-н)", "Локачі", "Лопатин (Львівська обл.)", "Лосинівка", "Лохвиця", "Лубни", "Лугини", "Лужани", "Лука-Мелешківська", "Луків", "Луцьк", "Львів", "Любар", "Любашівка", "Любешів", "Любимівка (Каховський р-н)", "Люблинець", "Любомль", "Люботин", "Магдалинівка", "Майське", "Макарів", "Мала Білозерка", "Мала Виска", "Мала Данилівка", "Малехів", "Малин", "Малинівка (Харківська обл.)", "Мамаївці", "Мамалига", "Мангуш", "Маневичі", "Маньківка", "Мар'їнка", "Мар'янське", "Марганець", "Маріуполь", "Марківка", "Матвіївка(Вільнянський р-н)", "Махнівка (Вінницька обл.)", "Машівка", "Медвеже Вушко", "Меденичі", "Меджибіж", "Межова", "Мелітополь", "Мельниця-Подільська (Тернопільська обл.)", "Мена", "Мерефа", "Мигове", "Миколаїв", "Миколаїв (Львівська обл., Миколаївський р-н)", "Миколаївка (Одеська обл., Миколаївський р-н)", "Миколаївка (Петропавлівський р-н)", "Миколаївка (Слов’янська міська рада)", "Миколаївка(Білопільський р-н)", "Микулинці", "Мила", "Минай", "Миргород", "Мирне(Мелітопол.р-н)", "Мирноград", "Миронівка", "Миропілля(Сумська обл.)", "Миропіль(Житомирська обл.)", "Михайлівка (Михайлівський р-н. Запорізька обл.)", "Михайлівка (Черкаська обл.)", "Міжгір'я", "Мізоч", "Мілове", "Містки (Сватівський р-н)", "Мішково-Погорілове", "Млинів", "Могилів", "Могилів-Подільський", "Молодіжне", "Молочанськ", "Монастириська", "Монастирище", "Моршин", "Мостиська", "Мошни", "Мукачево", "Муровані Курилівці", "Надвірна", "Народичі", "Недобоївці", "Недригайлів (Сумська обл.)", "Некрасове (Вінницький р-н)", "Немирів (Вінницька обл.)", "Немирів (Львівська обл.)", "Немішаєве", "Неполоківці", "Нересниця (Тячівський р-н)", "Нерубайське", "Нетішин", "Нехвороща", "Нещеретове", "Нива Трудова", "Нижанковичі", "Нижнє Селище", "Нижні Ворота", "Нижні Сірогози", "Нижні Станівці", "Нижня Дуванка", "Нижня Сироватка", "Низи", "Ніжин", "Нікольське", "Нікополь (Дніпропетровська обл.)", "Нісмичі", "Нова Борова", "Нова Водолага", "Нова Галещина (Козельщинський р-н)", "Нова Збур'ївка", "Нова Каховка", "Нова Маячка", "Нова Одеса", "Нова Прага", "Нова Ушиця", "Новгород-Сіверський", "Новгородка(Кіровоградська обл.)", "Новгородське (Донецька обл.)", "Нове", "Новий Буг", "Новий Калинів", "Новий Розділ", "Новий Стародуб", "Новий Яричів", "Нові Білокоровичі", "Нові Петрівці", "Нові Санжари", "Новоайдар", "Новоархангельськ", "Новобогданівка(Запоріз.обл.)", "Нововолинськ", "Нововоронцовка", "Новоград-Волинський", "Новогродівка", "Новогуйвинське", "Новодністровськ", "Новодружеськ", "Новомиколаївка (Запорізька обл.)", "Новомиколаївка(Скадовський р-н)", "Новомиргород", "Новомосковськ", "Новоолександрівка (Нововорон.р-н,Херсон.обл.)", "Новоолександрівка(Дніпропетровська обл.)", "Новоолексіївка (Херсонська обл.)", "Новопавлівка(Межівський р-н)", "Новопокровка (Харківська обл.)", "Новопсков", "Новоселиця", "Новосілки (Києво-Святошинський р-н)", "Новотроїцьке (Донецька обл.)", "Новотроїцьке (Херсонська обл.)", "Новоукраїнка", "Новояворівськ", "Носівка", "Обертин", "Оболонь (Семенівський р-н)", "Обухів", "Обухівка", "Овідіополь", "Овруч", "Одеса", "Оженин", "Озерне (Житомирська обл.)", "Окни", "Олевськ", "Олександрівка (Миколаївська обл.)", "Олександрівка (Олександр.р-н,Донец.обл.)", "Олександрівка (смт.Кіровог.обл.райц)", "Олександрія (м.Кіровогр.обл.райц)", "Олександрія (Рівненська обл.)", "Олексієво-Дружківка", "Олешки(Херсонська обл)", "Олика", "Ольшанське", "Оноківці (ст. Доманинці)", "Онуфріївка", "Опитне (Бахмутський р-н)", "Опішня", "Оратів", "Оржиця", "Оржів", "Оріхів", "Орлівщина", "Осипенко(Бердянський р-н)", "Остер", "Острог", "Острожець", "Отинія", "Охтирка", "Очаків", "Очеретине (Ясинуватський р-н)", "П'ятихатки", "Павлиш", "Павлів(Львівська обл.)", "Павлоград", "Пантаївка", "Панютине", "Парафіївка", "Партизанське (Дніпропетров.р-н)", "Первомайськ(Микол.обл.Первомайс.р-н)", "Первомайське(смт-Микол.обл.Вітовський.р-н)", "Первомайський (Харківська обл.)", "Перегінське", "Перемишляни", "Пересадівка", "Перечин", "Перещепине", "Переяслав-Хмельницький", "Першотравенськ (Дніпропетровська обл)", "Першотравенськ (Житомирська обл.)", "Петриківка", "Петрівське (Харківська обл.)", "Петрове", "Петропавлівка", "Печеніги", "Печеніжин", "Пирятин", "Південне (Харківський р-н)", "Північне", "Підбуж", "Підволочиськ", "Підгайці (Луцький р-н)", "Підгайці(Тернопільська обл.)", "Підгорівка", "Підгородне", "Піски-Радьківські", "Пісківка", "Пісочин", "Піщане ( Полтавська обл.)", "Піщане(Черкаська обл.)", "Піщаний Брід", "Піщанка (Вінницька обл.)", "Піщанка(Дніпропетровська обл.)", "Плотича", "Побузьке", "Погреби", "Погребище", "Подільськ", "Покотилівка", "Покров (Дніпропетровська обл.)", "Покровськ (Донецька обл.)", "Покровське (Мангушський р-н)", "Покровське (Покровський р-н Дніпропетровська обл.)", "Полігон", "Пологи", "Полонне", "Полтава", "Поляна (Закарпатська обл.)", "Поляниця (Буковель)", "Помічна", "Понінка", "Понорниця", "Попасна", "Попільня", "Почаїв", "Преображенка (Каланчацький р-н)", "Приазовське", "Прилуки", "Приморськ (Запорізька обл.)", "Приютівка (Кіровоградська обл.)", "Проліски", "Просяна (Покровський р-н)", "Пулини", "Пустомити", "Путивль", "Путила", "Рава-Руська", "Радехів", "Радивилів", "Радомишль", "Радушне", "Райгородка", "Райгородок(Слов'янський р-н)", "Райське(Херсонська обл.)", "Ракошино", "Ралівка", "Ратне", "Рафалівка", "Рахів", "Рахни-Лісові", "Ременів", "Рені", "Решетилівка", "Ржищів", "Рикове", "Рівне", "Рівне (Новоукраїнський р-н Кіровоградська обл.)", "Ріпки", "Рогань(Велика Рогань)", "Рогатин", "Родинське", "Рожище", "Рожнятів", "Роздільна (Одеська обл.)", "Розівка (Розівський р-н)", "Розсошенці(Полтавська обл.)", "Розтоки", "Рокитне (Київська обл., Рокитнянський р-н)", "Рокитне (Рівненська обл., Рокитнівський р-н)", "Романів", "Романківці", "Ромни", "Ромодан", "Рубанівка", "Рубіжне", "Рудки", "Рудне", "Ружин", "Руська Лозова", "Руська Поляна", "Рясне-Руське", "Саврань", "Сагунівка", "Сад", "Самбір", "Сарата", "Сарни", "Сартана (Донецька обл.)", "Сахновщина", "Свалява", "Сватове", "Свеса", "Світловодськ", "Світлодарськ", "Святогірськ", "Святопетрівське (Києво-Свят.р-н)", "Селидове", "Семенівка(Полт.обл., Семенів.р-н)", "Семенівка(Чернігівська обл.)", "Сенча", "Сергіївка (Білгород-Дністровський р-н)", "Серебрія", "Середина-Буда", "Середнє", "Середнє Водяне", "Сєвєродонецьк", "Сиваське", "Сигнаївка", "Синельникове", "Ситківці", "Сіверськ", "Сінгури", "Скадовськ", "Скала-Подільська", "Скалат", "Сквира", "Сколе", "Скороходове (Полтавська обл.)", "Славське (Львівська обл.)", "Славута", "Славутич", "Слатине", "Слобожанське(Зміївський р-н., Харківська обл.)", "Слов'янськ", "Словечне", "Смига", "Сміла", "Смоліне", "Снігурівка", "Сновськ", "Снятин", "Сокаль", "Сокирниця (Хуст.р-н,Закарпатська обл.)", "Сокиряни", "Сокільники", "Соколівка", "Соледар", "Солоне", "Солоницівка", "Солонка (Львівська обл.)", "Солотвино", "Сосниця", "Соснівка (Львівська обл.)", "Софіївка(Дніпропетровська обл.)", "Сошичне", "Срібне", "Ставище", "Станиця Луганська", "Стара Вижівка", "Стара Синява", "Стара Ушиця", "Старий Крим (Донецька обл.)", "Старий Остропіль", "Старий Самбір", "Старобільськ", "Старовойтове", "Старокозаче", "Старокостянтинів", "Старомлинівка", "Стасі", "Стеблів (Черкаська обл.)", "Стеблівка", "Стебник", "Степанівка (Сумська обл.)", "Степань", "Стецьківка", "Сторожинець", "Сторожниця(Ужгородський р-н)", "Стоянів (Львівська обл.)", "Стоянка", "Страбичово", "Стрижавка", "Стрий", "Стрілки", "Стрілковичі", "Струмівка", "Стуфчинці", "Суботці", "Судилків", "Судова Вишня", "Суми", "Сурсько-Литовське", "Сутиски", "Східниця", "Таврійськ (Херсонська обл.)", "Таврійське (Голопристанський р-н)", "Таїрове", "Талаківка", "Талалаївка (Талалаївський р-н., Чернігівська обл.)", "Тальне", "Тальянки", "Таранівка", "Тарасівка", "Тараща", "Тарутине", "Татарбунари", "Теофіполь", "Теплик", "Теплодар", "Теребовля", "Тересва", "Терешки (Полтавський р-н)", "Терни", "Тернівка", "Тернопіль", "Терпіння", "Тетіїв", "Тиврів", "Тинне", "Тисмениця", "Тишківка", "Тлумач", "Товсте", "Токмак", "Томаківка", "Томашгород", "Томашпіль", "Торецьк", "Торчин", "Требухів", "Трипілля (Київська обл.)", "Троїцьке (Луганська обл.)", "Троїцьке (Одеська обл.Біляївський р-н)", "Тростянець (Вінницька обл.)", "Тростянець (Сумська обл.)", "Трускавець", "Тульчин", "Турбів", "Турійськ", "Турка", "Тучин", "Тячів", "Угля", "Угринів", "Ужгород", "Узин", "Українка", "Українськ (Донецька обл.)", "Уланів", "Умань", "Урзуф", "Устилуг", "Устинівка", "Фастів", "Фонтанка", "Харків", "Херсон", "Хирів", "Хмельницький", "Хмельове (Кіровоградська обл.)", "Хмільник (Вінницька обл.)", "Ходорів", "Хорол", "Хоростків", "Хорошів", "Хотин", "Хотів", "Хотінь", "Христинівка", "Хуст", "Царичанка", "Цебрикове", "Цекинівка", "Цибулів", "Циркуни", "Цумань", "Чабани", "Чайки", "Чаплине", "Чаплинка (Херсонска обл.)", "Часів Яр", "Чемерівці", "Червона Кам'янка", "Червона Слобода", "Червоне (Житомирська обл.)", "Червоноград (Львівська обл.)", "Черкаси", "Черкаське", "Чернівці", "Чернівці(Вінницька обл.)", "Чернігів", "Чернігівка", "Черніїв", "Чернятин (Жмеринський р-н)", "Черняхів (Житомирська обл.)", "Чечельник", "Чигирин", "Чинадійово", "Чкалове (Новотроїцький р-н, Херсонська обл.)", "Чкаловське", "Чонгар(Херсонська обл.)", "Чоп", "Чорний Острів", "Чорнобаївка", "Чорнобай", "Чорноморськ", "Чорнухи (Полтавська обл.)", "Чортків", "Чугуїв", "Чудей", "Чуднів", "Чутове", "Шабо", "Шаргород (Вінницька обл.)", "Шацьк", "Шаян", "Шевченкове (Кілійський р-н)", "Шевченкове (Харківська обл.)", "Шевченкове (Черкаська обл.)", "Шегині", "Шепетівка", "Шипинці", "Широке (Широківський р-н)", "Ширяєве", "Шишаки", "Шостка", "Шпола", "Шумськ", "Щасливе", "Щастя", "Щирець", "Южне", "Южноукраїнськ", "Юр'ївка", "Яблунів", "Яворів", "Яготин", "Якимівка (Запорізька обл.)", "Якушинці", "Ялта (Донецька обл.)", "Ямпіль (Вінницька обл.)", "Ямпіль (Сумська обл.)", "Ямпіль (Хмельницька обл.)", "Яремче", "Яреськи", "Ярмолинці", "Ясенів-Пільний", "Ясіня"];

    public $addressFromDB;

    public function __construct(GetNewPostAddressFromDB $addressFromDB)
    {
        $this->addressFromDB = $addressFromDB;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, [
                'label' => ' ',
                'data' => 'Фамилия',
            ])
            ->add('name', TextType::class, [
                'label' => ' ',
                'data' => 'Имя',
            ])
            ->add('patronymic', TextType::class, [
                'label' => ' ',
                'data' => 'Отчество',
            ])
            ->add('phone', TelType::class, [
                'label' => ' ',
                'data' => 'Контактный телефон',
            ])
            ->add('city', ChoiceType::class, [
                'placeholder' => 'Укажите город',
                'label' => ' ',
                'attr' => [
                    'class' => 'js-example-basic-single',
                    'name' => 'state',
                ],
                'choice_loader' => new CallbackChoiceLoader(function() {
                    return $this->addressFromDB->getCities();
                }),
            ])
            ->add('warehouse', ChoiceType::class, [
                'attr' => [
                    'class' => 'js-example-basic-single',
                ],
                'placeholder' => 'Укажите отделение',
                'label' => ' ',
                'choice_loader' => new CallbackChoiceLoader(function() {
                    return ['one'=>'one', 'two' => 'two', 'three' => 'three'];
                }),
            ])
            ->add('full_address', TextareaType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'full-address',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ord::class,
        ]);
    }
}

