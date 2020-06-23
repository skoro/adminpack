<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-icon component.
 */
class Icon extends Component
{
    /**
     * Icon name.
     */
    public string $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <i {{ $attributes->merge(['class' => 'fas fa-' . $icon]) }}></i>
        blade;
    }
}
