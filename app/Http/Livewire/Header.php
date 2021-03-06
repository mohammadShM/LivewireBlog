<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Header extends Component
{

    public string $char = "";

    public function render(): Factory|View|Application
    {
        return view('livewire.header');
    }
}
