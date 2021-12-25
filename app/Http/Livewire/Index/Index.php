<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Index;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{

    public $newArticles;
    public $bestArticles;
    public $categories;

    public function mount(): void
    {
        $this->newArticles = Article::query()->orderBy('id', 'desc')->take(4)->get();
        $this->bestArticles = Article::query()->where('is_best', 1)->take(4)->get();
        $this->categories = Category::all();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.index.index');
    }
}
