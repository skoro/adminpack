<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-alert component.
 * 
 * <x-alert type="error">
 *   Something went wrong.
 * </x-alert>
 */
class Alert extends Component
{
    /**
     * Alert type: info, warn, error.
     */
    public string $type;

    /**
     * Whether to need to render a close button?
     */
    public bool $close;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'info', bool $close = true)
    {
        $this->type = $type;
        $this->close = $close;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin::components.alert');
    }

    /**
     * Maps the alert type to the CSS class.
     */
    public function mapTypeToCss(): string
    {
        switch ($this->type) {
            case 'info':
                return 'success';
            case 'warn':
                return 'warning';
            case 'err': case 'error':
                return 'danger';
        }
        return '';
    }
}
