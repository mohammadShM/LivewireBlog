<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection PhpMissingReturnTypeInspection */

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Search;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categories;
    public $categoryId;
    public $char = "";

    public function updatedCategoryId()
    {
        return redirect()->to(route('index-search', ["catId" => $this->categoryId, "char" => $this->char]));
    }

    public function updatedChar()
    {
        return redirect()->to(route('index-search', ["catId" => $this->categoryId, "char" => $this->char]));
    }

    public function mount($catId, $char = ""): void
    {
        $this->categories = Category::all();
        $this->categoryId = $catId;
        $this->char = $char;
    }

    public function render(): Factory|View|Application
    {
        $catId = $this->categoryId;
        $char = $this->char;
        if ((int)$catId === 0) {
            $result = Article::query()
                ->where('h_title', 'like', '%' . $char . '%')
                ->orWhere('top_title', 'like', '%' . $char . '%')
                ->orWhere('text', 'like', '%' . $char . '%')
                ->paginate(4);
        } else {
            $result = Article::query()
                ->where(['category_id' => $catId], ['h_title' => 'like', '%' . $char . '%'])
                ->orWhere(['category_id' => $catId], ['top_title' => 'like', '%' . $char . '%'])
                ->orWhere(['category_id' => $catId], ['text' => 'like', '%' . $char . '%'])
                ->paginate(4);
        }
        $articles = $result;
        return view('livewire.search.search', [
            "articles" => $articles,
        ]);
    }

}
