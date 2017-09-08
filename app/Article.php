<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends Model implements Transformable
{
    use TransformableTrait,SearchableTrait;

    protected $fillable = ['user_id','title','content','description','category_id','html_content'];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'title' => 10,
            'description' => 10,
            'content' => 2,
        ],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tag')->withTimestamps();
    }

    public function appendTags($tags)
    {
        return $this->tags()->attach($tags);
    }

}
