<?php

namespace App\Http\Controllers;

use App\Article;
use App\Role;
use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use App\Xun\Repositories\UserRepositoryEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\ArticleStoreRequest;
use App\Xun\Repositories\Interfaces\ArticleRepository;
use App\Validators\ArticleValidator;


class ArticleController extends Controller
{

    /**
     * @var ArticleRepository
     */
    protected $repository;

    /**
     * @var ArticleValidator
     */
    protected $categoryRepository;
    protected $userRepository;
    protected $tagRepository;

    public function __construct(ArticleRepositoryEloquent $repository,
                                CategoryRepositoryEloquent $categoryRepository,
                                TagRepositoryEloquent $tagRepository,
                                UserRepositoryEloquent $userRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        //$article = $this->repository->find($id);
        //$article->increment('view_count');
        $article = Article::find($id);

        $comments = $article->comments;
//        foreach ($comments as $comment){
//            dd($comment->user->name);
//        }

        $article->increment('view_count');

        return view('article.show', compact('article','comments'));
    }

    public function search()
    {
        $categories = $this->categoryRepository->all();

        $tags = $this->tagRepository->all();

        $hotArticles = $this->repository->getHotArticles();

//应当是管理员的

        $owner = Role::where('name','owner')->first();

        $author = $owner->hasUser()->first();

        $settings = json_decode($author->settings,true);

        $articles = $this->repository->searchKeywordArticles(request()->get('search'));

        $user = $author;

        return view('search',compact('articles','categories','tags','hotArticles','settings','user'));
    }
}