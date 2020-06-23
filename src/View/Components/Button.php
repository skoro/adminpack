<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;
use RuntimeException;

/**
 * x-button component.
 */
class Button extends Component
{
    /**
     * Icon name.
     */
    public string $icon = '';

    /**
     * Url for toolbar button type.
     */
    public string $url = '';

    /**
     * Button type: submit, toolbar.
     */
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = '', string $url = '', string $icon = '')
    {
        if (empty($type) && !empty($url)) {
            $type = 'toolbar';
        }
        
        if (empty($type)) {
            throw new RuntimeException('Button type is required.');
        }

        $this->icon = $icon;
        $this->type = $type;
        $this->url  = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $classes = ['btn'];
        $isSubmit = false;
        $href = '';

        switch ($this->type) {
            case 'submit':
                $tag = 'button';
                $isSubmit = true;
                $classes[] = 'btn-primary';
                break;

            case 'toolbar':
                $tag = 'a';
                $classes[] = 'btn-outline-secondary';
                $href = $this->url ?? '#';
                break;
        }

        return view('admin::components.button', [
            'tag'      => $tag,
            'isSubmit' => $isSubmit,
            'classes'  => implode(' ', $classes),
            'href'     => $href,
        ]);
    }
}
