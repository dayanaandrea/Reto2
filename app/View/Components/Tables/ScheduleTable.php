<?php

namespace App\View\Components\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Schedule;

class ScheduleTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Schedule $schedules,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.schedule');
    }
}
