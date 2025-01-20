<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class EmbedLayout extends Component
{
    public function __construct(
        public ?string $bgColor = null,
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.embed', [
            'bgColor' => $this->bgColor,
        ]);
    }
}
