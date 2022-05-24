<?php

namespace App\View\Components\Parts;

use Illuminate\View\Component;

class Container extends Component
{
    public $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.parts.container');
    }
}
