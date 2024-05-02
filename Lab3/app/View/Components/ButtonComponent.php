<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonComponent extends Component
{
    /**
     * The component's class attributes.
     *
     * @var array
     */
    public $class;

    /**
     * The button's href attribute.
     *
     * @var string
     */
    public $href;

    /**
     * Create a new component instance.
     *
     * @param string $class (optional)
     * @param string $href (optional)
     *
     * @return void
     */
    public function __construct($class = '', $href = '')
    {
        $this->class = $class;
        $this->href = $href;
    }

    /**
     * Get the view that renders the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.button-component');
    }
}