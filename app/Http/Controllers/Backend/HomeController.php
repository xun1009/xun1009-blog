<?php

namespace App\Http\Controllers\Backend;

use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use App\Xun\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public $articleRepository;
    public $userRepository;
    public $categoryRepository;
    public $tagRepository;
    
    public function __construct(ArticleRepositoryEloquent $articleRepository,
                                UserRepositoryEloquent $userRepository,
                                CategoryRepositoryEloquent $categoryRepository,
                                TagRepositoryEloquent $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->middleware(['auth','role:owner|admin']);
    }

    public function index()
    {
        $info = [];
        $info['userCount'] = $this->userRepository->all('id')->count();
        $info['articleCount'] = $this->articleRepository->all('id')->count();
        $info['categoryCount'] = $this->categoryRepository->all('id')->count();
        $info['tagCount'] = $this->tagRepository->all('id')->count();
        return view('backend.index',compact('info'));
    }

}
