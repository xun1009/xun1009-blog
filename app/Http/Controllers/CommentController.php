<?php

namespace App\Http\Controllers;

use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CommentRepositoryEloquent;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    protected $repository;
    protected $articleRepository;

    public function __construct(CommentRepositoryEloquent $repository,ArticleRepositoryEloquent $articleRepository)
    {
        $this->repository = $repository;
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $comments = $this->repository->with('user')->all();

        return view('comment.show',compact('comments'));
    }

    public function show($id)
    {
        $article = $this->articleRepository->with(['comments','comments.user'])->findWhere(['id'=>$id])->first();

        $comments = $article->comments;

        $comments = $this->repository->convertCommentsToArray($comments);

        return response($comments);
    }

    public function store()
    {
        $comment = $this->repository->create([
            'article_id' => request('article_id'),
            'user_id' => request('user_id'),
            'parent_id' => request('parent_id')?:null,
            'content' => request('content'),
        ]);
        $comment = $this->repository->with('user')->find($comment->id);

        $comment = $this->repository->convertCommentToArray($comment);

        return $comment;
    }

}
