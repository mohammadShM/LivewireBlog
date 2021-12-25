<?php /** @noinspection PhpUndefinedMethodInspection */

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Article;

use App\Models\Article as ModelArticle;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Article extends Component
{

    public $article;
    public $comment_text = "";
    public $commentToAnswer;
    public $isAnswer = 0;

    public function deleteComment($id): void
    {
        Comment::find($id)->delete();
        $this->emit('showAlert', 'نظر با موفقیت حذف شد');
    }

    public function addComment(): void
    {
        $this->validate([
            'comment_text' => 'required|string|regex:/^[آ-یa-zA-Z0-9 ? : - . ؛ , ، * ! ]+$/u'
        ]);
        $comment = new Comment();
        $comment->text = $this->comment_text;
        $comment->user_id = Auth::user()->id;
        $comment->article_id = $this->article->id;
        $comment->is_active = 1;
        $comment->parent_id = 0;
        $comment->created_at = Carbon::now();
        $comment->updated_at = Carbon::now();
        $comment->save();
        $this->comment_text = "";
        $this->emit('showAlert', 'نظر با موفقیت ثبت شد');
    }

    public function mount($id): void
    {
        $this->article = ModelArticle::find($id);
    }

    public function getCommentToAnswers($comment): void
    {
        $this->commentToAnswer = $comment;
        $this->isAnswer = 1;
    }

    public function addAnswer(): void
    {
        $this->validate([
            'comment_text' => 'required|string|regex:/^[آ-یa-zA-Z0-9 ? : - . ؛ , ، * ! ]+$/u'
        ]);
        $comment = new Comment();
        $comment->text = $this->comment_text;
        $comment->user_id = Auth::user()->id;
        $comment->article_id = $this->article->id;
        $comment->is_active = 1;
        $comment->parent_id = $this->commentToAnswer['id'];
        $comment->created_at = Carbon::now();
        $comment->updated_at = Carbon::now();
        $comment->save();
        $this->comment_text = "";
        $this->emit('showAlert', 'پاسخ به نظر با موفقیت ثبت شد');
        $this->cancelAnswer();
    }

    public function cancelAnswer(): void
    {
        $this->reset('commentToAnswer', 'isAnswer');
    }

    public function render(): Factory|View|Application
    {
        $comments = Comment::where("article_id", $this->article->id)->
        where("parent_id", 0)->orderBy('id', 'DESC')->get();
        $answer = Comment::where("article_id", $this->article->id)->
        where("parent_id", '>', 0)->orderBy('id', 'DESC')->get();
        return view('livewire.article.article', ['comments' => $comments, 'answer' => $answer]);
    }
}
