<?php

namespace App\View\Components;

use Illuminate\View\Component;

class productRate extends Component
{
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $value = $this->value;
        return view('components.product-rate',compact('value'));
    }
}
