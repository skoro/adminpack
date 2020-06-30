<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-admin-submenu component.
 *
 * This component must be used in the x-admin-menu component.
 *
 * @see Menu
 */
class Submenu extends Component
{
    /**
     * The menu title.
     */
    public string $title;

    /**
     * The menu url.
     */
    public string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <a href="{{ $url }}" class="nav-link">
                {{ $title }}
            </a>
        blade;
    }
}
