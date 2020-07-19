<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $pageName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageName,$title)
    {
        $this->pageName = $pageName;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.app-layout');
    }
}
