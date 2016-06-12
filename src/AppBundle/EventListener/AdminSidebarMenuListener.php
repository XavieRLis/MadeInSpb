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
