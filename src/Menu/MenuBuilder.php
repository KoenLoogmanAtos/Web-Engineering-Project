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

        $menu->addChild('Home', array('route' => 'index'));

        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Admin', array('route' => 'admin_index'));
        }

        return $menu;
    }

    
    public function createAdminMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav flex-column');

        $menu->addChild('Dashboard', array('route' => 'admin_index'));
        $menu->addChild('Room Types', array('route' => 'admin_room_type'));
        $menu->addChild('Rooms', array('route' => 'admin_room'));
        

        return $menu;
    }
}

?>