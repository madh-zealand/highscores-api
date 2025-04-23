<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BlankLayout extends Component
{
    private $bgClasses;

    public function __construct($bgClasses)
    {
        $this->bgClasses = $bgClasses;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.blank')
            ->with('bgClasses', $this->bgClasses);
    }
}
