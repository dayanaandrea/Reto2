<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Detail extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $value,
        public ?string $route = null
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.detail');
    }
}
