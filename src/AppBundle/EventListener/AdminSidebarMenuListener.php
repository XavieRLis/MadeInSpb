<?php
namespace AppBundle\EventListener;

use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;

class AdminSidebarMenuListener
{
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
        $menuItems = array(
            $users = new MenuItemModel(
                'users',
                'Пользователи',
                'app_admin_user_index',
                array(/* options */),
                'iconclasses fa fa-users'
            ),
            $projects = new MenuItemModel(
                'projects',
                'Музыкальные проекты',
                false,
                array(/* options */),
                'iconclasses fa fa-music'
            ),
            $settings = new MenuItemModel(
                'settings',
                'Настройки',
                false,
                array(/* options */),
                'iconclasses fa fa-cog'
            )
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
                'app_admin_peoplerole_index',
                array(/* options */),
                'iconclasses fa fa-users'
            )
        );
        $projects->addChild(
            new MenuItemModel(
                'people',
                'Участники',
                'app_admin_people_index',
                array(/* options */),
                'iconclasses fa fa-users'
            )
        );
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
