<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;
use Str;

/**
 * x-delete-model component.
 * 
 * <x-delete-model title="Delete model" :action="route('your.route')">
 *   ...description
 * </x-delete-model>
 */
class DeleteModel extends Component
{
    /**
     * The delete action.
     * It will be posted via DELETE method.
     */
    public string $action;

    /**
     * The dialog title.
     */
    public string $title;

    /**
     * The modal ID.
     * 
     * It generates automatically.
     */
    public string $modalId;

    /**
     * Create a new component instance.
     *
     * @param string $action
     * @param string $title
     * @return void
     */
    public function __construct(string $action, string $title = '')
    {
        $this->action = $action;
        $this->title = $title;
        $this->modalId = $this->generateModalId();
        if (empty($this->title)) {
            $this->title = __('Delete') . '?';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin::components.delete-model');
    }

    /**
     * Generates the modal ID.
     *
     * @param int $length ID length. By default is 8.
     */
    protected function generateModalId(int $length = 8): string
    {
        return 'modal_' . Str::random($length);
    }
}
