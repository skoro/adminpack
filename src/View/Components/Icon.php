<?php

namespace Skoro\AdminPack\View\Components;

use Illuminate\View\Component;
use RuntimeException;

/**
 * x-admin-icon SVG icon component.
 * 
 * Icons from https://icons.getbootstrap.com
 * Use:
 * <x-admin-icon icon="search"/>
 *
 * @link https://icons.getbootstrap.com
 */
class Icon extends Component
{
    /**
     * Icon name.
     */
    public string $icon;

    /**
     * Icons data.
     */
    protected array $data = [
        // https://icons.getbootstrap.com/icons/search/
        'search' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z',
            ],
            [
                'fill-rule' => 'evenodd',
                'd' => 'M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/shield-shaded/
        'shield-shaded' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z',
            ],
            [
                'd' => 'M8 2.25c.909 0 3.188.685 4.254 1.022a.94.94 0 0 1 .656.773c.814 6.424-4.13 9.452-4.91 9.452V2.25z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/person-plus-fill/
        'person-plus-fill' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z',
            ],
            [
                'fill-rule' => 'evenodd',
                'd' => 'M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/person-circle/
        'person-circle' => [
            [
                'd' => 'M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z',
            ],
            [
                'fill-rule' => 'evenodd',
                'd' => 'M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z',
            ],
            [
                'fill-rule' => 'evenodd',
                'd' => 'M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/star-fill/
        'star-fill' => [
            [
                'd' => 'M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z',
            ]
        ],

        // https://icons.getbootstrap.com/icons/plus-circle-fill/
        'plus-circle-fill' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/diagram-3-fill/
        'diagram-3-fill' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M8 5a.5.5 0 0 1 .5.5V7H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V5.5A.5.5 0 0 1 8 5zm-8 6.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z',
            ],
            [
                'fill-rule' => 'evenodd',
                'd' => 'M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6h-1A1.5 1.5 0 0 1 6 4.5v-1z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/people-fill/
        'people-fill' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z',
            ],
        ],

        // https://icons.getbootstrap.com/icons/toggles/
        'toggles' => [
            [
                'fill-rule' => 'evenodd',
                'd' => 'M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z',
            ],
        ],
    ];

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
            <svg {{ $attributes->merge(['class' => "bi bi-$icon", 'width' => '1em', 'height' => '1em']) }} viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            @foreach ($getIconData() as $path)
                <path @foreach ($path as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach />
            @endforeach
            </svg>
        blade;
    }

    /**
     * @throws RuntimeException
     */
    public function getIconData(): array
    {
        if (!isset($this->data[$this->icon])) {
            throw new RuntimeException("Couldn't get data for icon: " . $this->icon);
        }
        return $this->data[$this->icon];
    }
}
