<?php

namespace App\Http\Controllers;

use App\Role;
use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use App\Xun\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $articleRepository;

    protected $categoryRepository;

    protected $tagRepository;

    protected $userRepository;

    public function __construct(ArticleRepositoryEloquent $articleRepository,
                                CategoryRepositoryEloquent $categoryRepository,
                                TagRepositoryEloquent $tagRepository,
                                UserRepositoryEloquent $userRepository)
    {
        //$this->middleware('auth');
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->getLatestPaginateArticle();

        $categories = $this->categoryRepository->all();

        $tags = $this->tagRepository->all();

        $hotArticles = $this->articleRepository->getHotArticles();
//应当是管理员的
        $owner = Role::where('name','owner')->first();

        $author = $owner->hasUser()->first();

        $settings = json_decode($author->settings,true);

        $user = $author;

        return view('home',compact('articles','categories','tags','hotArticles','settings','user'));
    }

    public function user($userName)
    {
        $user = $this->userRepository->findWhere(['name'=>$userName])->first();
        return view('user.show',compact('user'));
    }
}
