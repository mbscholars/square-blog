<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InfoComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $message;
    public function __construct()
    {
        $this->message =  session('info') ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.info-component');
    }
}
