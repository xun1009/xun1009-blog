<div class="widget widget-default">
    <div class="widget-header"><h6><i class="fa fa-fire fa-fw"></i>热门文章</h6></div>
    <ul class="widget-body hot-posts">
        @forelse($hotArticles as $article)
            <a class="list-group-item" title="{{ $article->title }}"
               href="{{ route('front.article.show',$article->id) }}">
                <span class="badge">{{ $article->view_count.'+'.$article->comments_count }}</span>
                {{ str_limit($article->title,32) }}
                <span class="clearfix"></span>
            </a>
        @empty <p class="meta-item center-block">No hot article</p>
        @endforelse
    </ul>
</div>