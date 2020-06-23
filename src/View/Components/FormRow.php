<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;

/**
 * x-form-row component.
 * 
 * Use as:
 * <x-form-row label="Email" error="email">
 *   <input type="email" name="email">
 * </x-form-row>
 * 
 * This will render a form row with label "Email" and the email input.
 * Error processing will be also done thankful to "error" component's attribute.
 * 
 * There is also 'custom_label' slot, it accepts an html markup and it will
 * show in the component's label:
 * <x-form-row>
 *   <x-slot name="custom_label">
 *     <span class="text-muted">My Label</span>
 *   </x-slot>
 * </x-form-row>
 */
class FormRow extends Component
{
    /**
     * Form row label.
     */
    public string $label;

    /**
     * Error field name.
     */
    public string $error;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label = '', string $error = '')
    {
        $this->label = $label;
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-row');
    }
}
