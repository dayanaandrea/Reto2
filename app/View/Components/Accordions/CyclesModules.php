<?php

namespace App\View\Components\Accordions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class CyclesModules extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $cycles
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accordions.cycles-modules');
    }
}
