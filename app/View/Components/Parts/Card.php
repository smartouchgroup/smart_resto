<?php

namespace App\View\Components\Parts;

use App\Models\Dish;
use Illuminate\View\Component;

class Card extends Component
{
    public $dish;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Dish $dish)
    {
        $this->dish = $dish;
    }
  
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.parts.card');
    }
}
