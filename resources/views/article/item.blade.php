<article class="post">
    <!-- article header -->
    <div class="post-header">
        <h1 class="post-title">
            <a title="{{ $article->title }}" href="{{ route('front.article.show',$article->id) }}">{{ $article->title }}</a>
        </h1>
        <div class="post-meta">
                           <span class="post-time">
                           <i class="fa fa-calendar-o"></i>
                           <time datetime="2016-08-05T00:10:14+08:00">
                           {{ $article->created_at->format('Y-m-d') }}
                           </time>
                           </span>
            <span class="post-category">
                           &nbsp;|&nbsp;
                           <i class="fa fa-folder-o"></i>
                           <a href="{{ route('front.category.show',$article->category->name) }}">
                           {{ $article->category->name }}
                           </a>
                           </span>
            <span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comments-o fa-fw" aria-hidden="true"></i>
                           <span>{{ $article->comments_count }}</span>
                           </span>
        </div>
    </div>
    {{--article content--}}
    <div class="post-description">
        {{--<p class="markdown-target" data-markdown="{{ $article->description }}">
        </p>--}}
        {!! $article->description !!}
    </div>
    {{--read more--}}
    <div class="post-permalink">
        <a title="阅读全文" href="{{ route('front.article.show',$article->id) }}" class="btn btn-more">阅读全文</a>
    </div>
    {{--article footer--}}
    <div class="post-footer clearfix">
        <div class="pull-left tag-list">
            <i class="fa fa-tags"></i>
            @foreach($article->tags as $tag)
                <a  class="tag" href="{{ route('front.tag.show',$tag->name) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</article>