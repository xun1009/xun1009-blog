<?php

namespace App\Http\Controllers;

use App\Role;
use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $repository;
    protected $articleRepository;
    protected $tagRepository;

    public function __construct(CategoryRepositoryEloquent $categoryRepository ,
                                ArticleRepositoryEloquent $articleRepository,
                                TagRepositoryEloquent $tagRepository)
    {
        $this->repository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {

        $hotArticles = $this->articleRepository->getHotArticles();

        $categories = $this->repository->all();

        $tags = $this->tagRepository->all();

        $owner = Role::where('name','owner')->first();

        $author = $owner->hasUser()->first();

        $settings = json_decode($author->settings,true);

        $user = $author;

        return view('category.index',compact('articles','hotArticles','categories','tags','settings','user'));
    }

    public function show($categoryName)
    {
        $articles = $this->repository->findWhere(['name' => $categoryName])->first()->articles;

        $hotArticles = $this->articleRepository->getHotArticles();

        $categories = $this->repository->all();

        $tags = $this->tagRepository->all();

        $owner = Role::where('name','owner')->first();

        $author = $owner->hasUser()->first();

        $settings = json_decode($author->settings,true);

        $user = $author;

        return view('category.show',compact('articles','hotArticles','categories','tags','categoryName','settings','user'));
    }
    
}
