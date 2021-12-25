<main class="main container">
    <div class="row my-4">
        {{-- ================================= content ================================= --}}
        <div id="articleRight" class="col-12 col-md-8 col-xl-9">
            <div class="p-2 bg-light rounded">
                <h1 class="text-center font_2 py-2">{{$article->h_title}}</h1>
                <div class="image text-center">
                    <img class="max_w_100 m-auto"
                         src="{{$article->image}}" alt="{{$article->h_title}}">
                </div>
                <div class="p-2 text_container">{!! $article->text !!}</div>
            </div>
        </div>
        {{-- ================================= sideba ================================= --}}
        <div id="articleLeft" class="col-12 col-md-4 col-xl-3 mt-3 mt-md-0">
            <div class="row bg-light px1 py-5 text-center justify-content-center d-flex rounded w-100 m-auto">
                <div class="image rounded-circle overflow-hidden h_10 w_10 text-center justify-content-center">
                    <img class="max_w_100 m-auto" src="{{asset($article->user->image ??
                            './assets/images/logo.png')}}" alt="توضیح تصویر">
                </div>
                <div class="col-12 mt-3 justify-content-center">
                    <small class="text-center d-block">نویسنده:</small>
                    <h6 class="text-center">{{$article->user->name." ".$article->user->lastname}}</h6>
                    <small class="text-center d-block mt-3">تاریخ:</small>
                    <h6 class="text-center">{{$article->created_at->diffForHumans()}}</h6>
                    <div class="col-12 justify-content-center text-center mt-3">
                        <span class="text-center">بازدید : {{$article->view_count}} </span>
                    </div>
                    <div class="col-12 justify-content-center text-center mt-3">
                        <a href="#" class="btn rounded_5 btn-outline-dark">دیگر مقالات </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ================================= comments ================================= --}}
    <div class="row justify-content-center align-items-center alert-secondary p-3">
        <div class="row p-3 justify-content-center text-right alert-light d-block mb-4 col-12">
            @foreach (explode("-",$article->keywords) as $key)
                ( <a href="#">{{$key}}</a> )
            @endforeach
        </div>
        @if (auth()->check())
            <div class="col-12 row justify-content-center form-group">
                <h5 class="col-12 text-center">{{$isAnswer === 1 ?'متن پاسخ:' : 'متن نظر:'}}</h5>
                <!--suppress HtmlFormInputWithoutLabel -->
                <textarea rows="10"
                          class="form-control rounded shadow col-12 col-md-8 {{$isAnswer === 1 ?'alert-warning':''}}"
                          wire:model="comment_text"></textarea>
                @error('comment_text')
                <small class="text-center text-danger d-block col-md-12">{{$message}}</small>
                @enderror
                <div class="text-center col-12">
                    @if ($isAnswer===1)
                        <button type="button" class="btn btn-warning rounded_5 mt-3" wire:click="addAnswer">
                            ثبت پاسخ
                        </button>
                        <button type="button" class="btn btn-secondary rounded_5 mt-3" wire:click="cancelAnswer">
                            انصراف
                        </button>
                    @else
                        <button type="button" class="btn btn-success rounded_5 mt-3" wire:click="addComment">
                            ثبت نظر
                        </button>
                    @endif
                </div>
            </div>
        @else
            <p class="text-center text-primary">
                <a href="{{route('index-login')}}">لطفا جهت ثبت نظر وارد شوید</a>
            </p>
        @endif
        <div class="col-12 col-md-11 bg-white p-3">
            @foreach ($comments as $comment)
                <div class="mb-3">
                    <div class="row my-2 d-block p-2 rounded shadow-sm col-11 m-auto shadow">
                        <div class="row justify-content-lg-between w-100 m-auto">
                            <h6 class="text-right text-success">{{$comment->user->name ." ".$comment->user->lastname}} در تاریخ
                                <span class="text-danger">{{$comment->created_at->diffForHumans()}}</span></h6>
                            @if (auth()->check() && $comment->user_id === auth()->user()->id)
                                <span>
                                    <i class="fas fa-trash text-danger cursor_pointer_text_shadow mx-2"
                                       wire:click="deleteComment({{$comment->id}})"></i>
                                    <i class="fas fa-edit text-success cursor_pointer_text_shadow mx-2"></i>
                    </span>
                            @endif
                        </div>
                        <div class=" w-100 pb-3">
                            <p class="text-justify">{{$comment->text}}</p>
                            <button class="btn btn-primary rounded_5 px-3"
                                    wire:click="getCommentToAnswers({{$comment}})">پاسخ
                            </button>
                        </div>
                        @foreach ($answer as $ans)
                            @if ($ans->parent_id === $comment->id)
                                <div class="mb-3">
                                    <div class="answer shadow-sm alert-success p-2 rounded">
                                        <h6 class="text-right text-primary">پاسخ</h6>
                                        <div class="row justify-content-lg-between w-100 m-auto">
                                            <h6 class="text-right text-success">{{$ans->user->name ." "
                                                .$ans->user->lastname}} در تاریخ
                                                <span class="text-danger">{{$ans->created_at->diffForHumans()}}</span></h6>
                                            @if (auth()->check() && $ans->user_id === auth()->user()->id)
                                                <span>
                                    <i class="fas fa-trash text-danger cursor_pointer_text_shadow mx-2"
                                       wire:click="deleteComment({{$ans->id}})"></i>
                                    <i class="fas fa-edit text-success cursor_pointer_text_shadow mx-2"></i>
                    </span>
                                            @endif
                                        </div>
                                        <p class="text-justify">{{$ans->text}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
