<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-form-actions component.
 * 
 * Use as:
 * <x-form-actions submit="Create something">
 *   <x-button>Refresh</x-button>
 *   <x-slot name="secondary">
 *     <x-button>Remove</x-button>
 *   </x-slot>
 * </x-form-actions>
 * This will create form actions with "Create something" primary button
 * and "Refresh" as additional button. "Remove" button will be
 * on the secondary area (right aligned).
 */
class FormActions extends Component
{
    /**
     * @var bool|string Submit label or disable label if false.
     */
    public $submit;

    /**
     * Whether to render the Back button in the form actions?
     */
    public string $backUrl;

    /**
     * Create a new component instance.
     *
     * @param bool|string $submit Disable submit or submit label.
     *
     * @return void
     */
    public function __construct($submit = '', string $backUrl = '')
    {
        if ($submit !== false && empty($submit)) {
            $submit = __('Save');
        }
        $this->submit = $submit;
        $this->backUrl = $backUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-actions');
    }
}
