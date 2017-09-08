<?php

namespace App\Xun\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Xun\Repositories\Interfaces\ArticleRepository;
use App\Article;
use App\Validators\ArticleValidator;

/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Xun\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return Article::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getLatestPaginateArticle()
    {
        return Article::latest()->paginate(8);
    }

    public function getHotArticles($count = 5)
    {
        return Article::select([
            'id',
            'title',
            'view_count',
        ])->withCount('comments')->orderBy('view_count', 'desc')->limit($count)->get();
    }

    public function searchKeywordArticles($keyword)
    {
        $search = "%".$keyword."%";
        return Article::search($search,null,true)->paginate(5);
    }
}
