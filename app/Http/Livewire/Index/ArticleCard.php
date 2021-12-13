<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Index;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArticleCard extends Component
{

    public $article;

    public function mount($article)
    {
        $this->article = $article;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.index.article-card');
    }
}
