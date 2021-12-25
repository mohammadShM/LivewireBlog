<?php

namespace App\Http\Livewire\Search;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{

    public function mount($catId, $char = ""): void
    {

    }

    public function render(): Factory|View|Application
    {
        return view('livewire.search.search');
    }
}
