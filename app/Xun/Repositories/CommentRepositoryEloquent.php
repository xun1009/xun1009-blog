<?php

namespace App\Xun\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Xun\Repositories\Interfaces\CommentRepository;
use App\Comment;
use App\Validators\CommentValidator;

/**
 * Class CommentRepositoryEloquent
 * @package namespace App\Xun\Repositories;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function convertCommentsToArray(Collection $comments)
    {
        $newCommentsArray = [];
        $newComments = [];

        $comments = $comments->all();
        foreach ($comments as $comment){

            $newComments['id'] = $comment['id'];
            $newComments['username'] = $comment['user']->name;
            $newComments['avatar'] = $comment['user']->avatar;
            $newComments['article_id'] = $comment['article_id'] ;
            $newComments['content'] = $comment['content'];
            $newComments['time'] = Carbon::parse($comment->created_at)->diffForHumans();
            $newComments['parent_id'] = $comment['parent_id'];
            if($comment['parent_id'] == null){
                $newCommentsArray['root'][] = $newComments;
            }else{
                $newCommentsArray[$comment['parent_id']][] = $newComments;
            }
        }

        return $newCommentsArray;
    }

    public function convertCommentToArray(Comment $comment)
    {
        $newComment = [];

        $newComment['id'] = $comment['id'];
        $newComment['username'] = $comment['user']->name;
        $newComment['avatar'] = $comment['user']->avatar;
        $newComment['article_id'] = $comment['article_id'] ;
        $newComment['content'] = $comment['content'];
        $newComment['time'] = Carbon::parse($comment->created_at)->diffForHumans();
        $newComment['parent_id'] = $comment['parent_id'];

        return $newComment;
    }
}
