<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-admin-menu
 *
 * Sidebar menu component.
 * 
 * Simple menu:
 * <x-admin-menu title="Account" :url="route('user.account')" />
 * 
 * Nested menus:
 * <x-admin-menu title="User">
 *   <x-admin-submenu title="Login" :url="route('login')" />
 *   <x-admin-submenu title="Register" :url="route('register')" />
 * </x-admin-menu>
 */
class Menu extends Component
{
    /**
     * The menu title.
     */
    public string $title;

    /**
     * The menu icon.
     */
    public string $icon;

    /**
     * The menu url.
     */
    public string $url;

    /**
     * Internal menu counter.
     */
    private static int $menu = 0;

    /**
     * The Menu ID.
     *
     * Used for collapse children.
     */
    public int $menuId;

    /**
     * Create a new component instance.
     *
     * @param string $title The menu title.
     * @param string $icon  Optional. The icon name.
     * @param string $url   The menu url.
     */
    public function __construct(string $title, string $icon = '', string $url = '')
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->url = $url;
        $this->menuId = ++static::$menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin::components.menu');
    }
}
