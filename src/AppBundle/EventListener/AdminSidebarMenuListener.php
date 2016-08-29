<?php
namespace AppBundle\EventListener;

use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AdminSidebarMenuListener
{
    private $authChecker;

    public function __construct(AuthorizationCheckerInterface $authChecker)
    {
        $this->authChecker = $authChecker;
    }


    public function onSetupMenu(SidebarMenuEvent $event)
    {

        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request)
    {
        // Build your menu here by constructing a MenuItemModel array
        $user = $this->authChecker->isGranted('ROLE_ADMIN');
        if ($user) {
            $menuItems[] = $users = new MenuItemModel(
                'users',
                'Пользователи',
                'app_admin_user_index',
                array(/* options */),
                'iconclasses fa fa-users'
            );
        } else {
            $menuItems[] = $users = new MenuItemModel(
                'users',
                'Вход',
                'fos_user_security_login',
                array(/* options */),
                'iconclasses fa fa-users'
            );

        }
        $menuItems[] = $projects = new MenuItemModel(
            'projects',
            'Артисты и Коллективы',
            false,
            array(/* options */),
            'iconclasses fa fa-music'
        );
        if ($user) {
            $menuItems[] = $settings = new MenuItemModel(
                'settings',
                'Настройки',
                false,
                array(/* options */),
                'iconclasses fa fa-cog'
            );
            $settings->addChild(
                new MenuItemModel(
                    'cities',
                    'Города',
                    'app_admin_city_index',
                    array(/* options */),
                    'iconclasses fa fa-building'
                )
            );
            $settings->addChild(
                new MenuItemModel(
                    'languages',
                    'Языки',
                    'app_admin_language_index',
                    array(/* options */),
                    'iconclasses fa fa-language'
                )
            );
            $settings->addChild(
                new MenuItemModel(
                    'styles',
                    'Стили',
                    'app_admin_style_index',
                    array(/* options */),
                    'iconclasses fa fa-star'
                )
            );
            $settings->addChild(
                new MenuItemModel(
                    'music-types',
                    'Направления',
                    'app_admin_musictype_index',
                    array(/* options */),
                    'iconclasses fa fa-star'
                )
            );
            $settings->addChild(
                new MenuItemModel(
                    'people-types',
                    'Типы Участиков',
                    'app_admin_personrole_index',
                    array(/* options */),
                    'iconclasses fa fa-users'
                )
            );
            $settings->addChild(
                new MenuItemModel(
                    'link-types',
                    'Типы Ссылок',
                    'app_admin_linktype_index',
                    array(/* options */),
                    'iconclasses fa fa-share'
                )
            );
        }
        if ($user) {
            $projects->addChild(
                new MenuItemModel(
                    'projects',
                    'Проекты',
                    'app_admin_musicproject_index',
                    array(/* options */),
                    'iconclasses fa fa-music'
                )
            );
            $projects->addChild(
                new MenuItemModel(
                    'people',
                    'Участники',
                    'app_admin_person_index',
                    array(/* options */),
                    'iconclasses fa fa-users'
                )
            );
        } else {
            $projects->addChild(
                new MenuItemModel(
                    'projects',
                    'Проекты',
                    'app_musicproject_index',
                    array(/* options */),
                    'iconclasses fa fa-music'
                )
            );
            $projects->addChild(
                new MenuItemModel(
                    'people',
                    'Участники',
                    'app_person_index',
                    array(/* options */),
                    'iconclasses fa fa-users'
                )
            );
        }

        return $this->activateByRoute($request->get('_route'), $menuItems);
    }

    protected function activateByRoute($route, $items)
    {

        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } else {
                if ($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }

}
