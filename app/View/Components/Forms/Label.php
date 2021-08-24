<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * The label for.
     *
     * @var string
     */
    public $for;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for)
    {
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.label');
    }
}
