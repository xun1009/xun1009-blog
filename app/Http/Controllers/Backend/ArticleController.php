<?php

namespace App\Http\Controllers\Backend;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleStoreRequest;
use App\Xun\Markdown\Parser;
use App\Xun\Repositories\ArticleRepositoryEloquent;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use App\Xun\Repositories\TagRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    protected $categoryRepository;
    protected $tagRepository;
    protected $repository;

    public function __construct(CategoryRepositoryEloquent $categoryRepository,
                                ArticleRepositoryEloquent $articleRepository,
                                TagRepositoryEloquent $tagRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->repository = $articleRepository;
        $this->tagRepository = $tagRepository;
        $this->middleware(['auth','role:owner|admin']);
    }
    //
    public function index()
    {
        //$articles = $this->repository->getLatestPaginateArticle();
        $articles = Article::latest()->paginate(8);

        return view('backend.article',compact('articles'));
    }

    public function create()
    {
        $tags = $this->tagRepository->all();
        $categories = $this->categoryRepository->all();
        return view('backend.article.create',compact('categories','tags'));
    }

    public function store(ArticleRequest $request)
    {
        $tags = $request->get('tags');
        $newTags = [];
        $numTags = [];
        if($tags){
            foreach ($tags as $tag){
                if(!($this->tagRepository->findWhere(['name' => $tag])->first())){
                    $newTags[] = $tag;
                }
            }
            if ($newTags){
                foreach ($newTags as $tag){
                    $this->tagRepository->create([
                        'name' => $tag,
                    ]);
                }
            }
        }

        $article = $this->repository->create([
            'user_id' => Auth::id(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'content' => $request->get('content'),
            'html_content' => (new Parser())->makeHtml($request->get('content')),
        ]);
        foreach ($tags as $tag){
            $numTags[] = $this->tagRepository->findWhere(['name' => $tag])->first()->id;
        }
        $article->appendTags($numTags);
        flash('添加文章成功')->important();
        return redirect('backend/article');
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->all();
        $article = $this->repository->find($id);
        $tags = $this->tagRepository->all();
        return view('backend.article.edit',compact('article','categories','tags'));
    }

    public function update(ArticleRequest $request,$id)
    {
        //后期要把代码写到函数里面  不需要过长 在contr中
        $tags = $request->get('tags');
        $newTags = [];
        $numTags = [];
        if($tags){
            foreach ($tags as $tag){
                if(!($this->tagRepository->findWhere(['name' => $tag])->first())){
                    $newTags[] = $tag;
                }
            }
            //创建新的标签
            if ($newTags){
                foreach ($newTags as $tag){
                    $this->tagRepository->create([
                        'name' => $tag,
                    ]);
                }
            }
        }
        //更新标签 感觉有点麻烦  找出新的 删除不存在的    直接先删再加 最简单了
        $article = $this->repository->find($id);
        $article->tags()->detach();

        $article->update([
            'user_id' => Auth::id(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'html_content' => (new Parser())->makeHtml($request->get('content')),
            'content' => $request->get('content'),
        ]);

        if(!is_null($tags)) {
            foreach ($tags as $tag) {
                $numTags[] = $this->tagRepository->findWhere(['name' => $tag])->first()->id;
            }
        }
        //创建新的文章标签
        $article->appendTags($numTags);
        flash('修改文章成功')->important();
        return redirect('backend/article');
    }
    public function destroy($id)
    {
        $article = $this->repository->find($id);
        $article->tags()->detach();
        $article->delete();
        flash('删除成功')->important();
        return redirect('backend/article');
    }
}


