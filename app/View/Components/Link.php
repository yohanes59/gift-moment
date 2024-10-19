<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public $to, $size, $icon, $text, $padding;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($to, $size, $icon, $text, $padding)
    {
        $this->to = $to;
        $this->size = $size;
        $this->icon = $icon;
        $this->text = $text;
        $this->padding = $padding;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link');
    }
}
