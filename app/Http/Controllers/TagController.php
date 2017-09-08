<?php

namespace App\Http\Controllers;

use App\Article;
use App\Role;
use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    protected $repository;
    protected $categoryRepository;
    protected $articleRepository;

    public function __construct(TagRepositoryEloquent $tagRepository ,
                                CategoryRepositoryEloquent $categoryRepository,
                                ArticleRepositoryEloquent $articleRepository)
    {
        $this->repository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
    }


    public function index()
    {
        $tags = $this->repository->all();

        $hotArticles = $this->articleRepository->getHotArticles();

        $categories = $this->categoryRepository->all();

        return view('tag.index',compact('tags','hotArticles','categories'));
    }

    public function show($tagName)
    {
        $hotArticles = $this->articleRepository->getHotArticles();

        $categories = $this->categoryRepository->all();

        $articles = $this->repository->findWhere(['name' => $tagName])->first()->article;

        $tags = $this->repository->all();

        $owner = Role::where('name','owner')->first();

        $author = $owner->hasUser()->first();

        $settings = json_decode($author->settings,true);

        $user = $author;

        return view('tag.show',compact('articles','tagName','hotArticles','categories','tags','settings','user'));
    }
}
