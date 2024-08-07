<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stats extends Component
{
    public $clients;
    public $projects;
    /**
     * Create a new component instance.
     */
    public function __construct($projects, $clients)
    {
        $this->clients = $clients;
        $this->projects = $projects;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stats');
    }
}
