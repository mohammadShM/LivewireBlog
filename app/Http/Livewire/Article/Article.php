<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Article;

use App\Models\Article as ModelArticle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Article extends Component
{

    public $article;

    public function mount($id)
    {
        $this->article = ModelArticle::query()->find($id)->first();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.article.article');
    }
}
