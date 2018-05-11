<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authChecker)
    {
        $this->factory = $factory;
        $this->authChecker = $authChecker;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto mt-2 mt-md-0');

        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Admin', array('route' => 'admin_index'));
        }

        if ($this->authChecker->isGranted('ROLE_USER')) {
            $menu->addChild('User', array('route' => 'user_index'));
        }

        return $menu;
    }

    
    public function createSideMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav flex-column');

        if ($this->authChecker->isGranted('ROLE_USER')) {
            $menu->addChild('Menu');
            $menu->addChild('Dashboard', array('route' => 'index'));
        }
        
        // menu items for the admin
        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Manage');
            $menu->addChild('Room Types', array('route' => 'admin_room_type'));
            $menu->addChild('Rooms', array('route' => 'admin_room'));
            $menu->addChild('Bookings', array('route' => 'admin_booking'));
        }

        // menu items for the user
        if ($this->authChecker->isGranted('ROLE_USER')) {
            $menu->addChild('Account');
            $menu->addChild('Show Details', array('route' => 'user_index'));
            $menu->addChild('Change Password', array('route' => 'user_password'));
        }

        return $menu;
    }
}

?>