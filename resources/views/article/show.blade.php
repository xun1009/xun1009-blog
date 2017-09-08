@extends('layouts.app')
@section('description',$article->description)
@section('keywords',$article->category->name)
@section('title',$article->title)
@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 phone-no-padding">
                <div class="post-detail">
                    <div class="center-block">
                        <div class="post-detail-title">{{ $article->title }}</div>
                        <div class="post-meta">
                            <span class="post-category">
                           <i class="fa fa-folder-o fa-fw"></i>
                           <a href="{{ route('front.category.show',$article->category->name) }}">
                           {{ $article->category->name }}
                           </a>
                           </span>
                            <span class="post-comments-count">
                           &nbsp;|&nbsp;
                           <i class="fa fa-comments-o fa-fw" aria-hidden="true"></i>
                           <span>{{ $article->comments_count }}</span>
                           </span>
                            <span>
                           &nbsp;|&nbsp;
                           <i class="fa fa-eye"></i>
                           <span>{{ $article->view_count }}</span>
                           </span>
                            @can('update',$article)
                                <span>
                                    &nbsp;|&nbsp;
                                    <a href="{{ route('article',$article->id) }}">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </a>
                                </span>
                                <span>
                                    &nbsp;|&nbsp;
                                    <a class="swal-dialog-target"
                                       data-url="{{ route('post.destroy',$article->id) }}"
                                       data-dialog-msg="Delete {{ $article->title }} ?">
                                    <i class="fa fa-trash-o fa-fw"></i>
                                    </a>
                                </span>
                            @endcan
                        </div>
                    </div>
                    <div class="post-detail-content">
                        {{--{!! $article->html_content !!}--}}
                        {!! $article->html_content !!}
                        <p>-- END</p>
                        @include('widget.pay')
                    </div>
                    <div class="post-info-panel">
                        <p class="info">
                            <label class="info-title">版权声明:</label><i class="fa fa-fw fa-creative-commons"></i>自由转载-非商用-非衍生-保持署名（<a
                                    href="https://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">创意共享3.0许可证</a>）
                        </p>
                        <p class="info">
                            <label class="info-title">创建日期:</label>{{ $article->created_at->format('Y年m月d日') }}
                        </p>
                        @if(isset($article->published_at) && $article->published_at)
                            <p class="info">
                                <label class="info-title">修改日期:</label>{{ $article->published_at->format('Y年m月d日') }}
                            </p>
                        @endif
                        <p class="info">
                            <label class="info-title">文章标签:</label>
                            @foreach($article->tags as $tag)
                                <a class="tag" href="{{ route('tag.show',$tag->name) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>

                </div>
                @if(isset($recommendedPosts))
                    @include('widget.recommended_posts',['recommendedPosts'=>$recommendedPosts])
                @endif

            </div>
        </div>
    </div>

    {{--<div class="container">--}}
        {{--<div class="col-md-offset-1 col-md-10">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">评论</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<ul class="list-group">--}}
                        {{--@foreach($comments as $comment)--}}
                            {{--<li class="list-group-item"><comment id="{{$comment->id}}"--}}
                                                                 {{--name="{{$comment->user->name}}"--}}
                                                                 {{--avatar="{{$comment->user->avatar}}"--}}
                                                                 {{--content="{{$comment->content}}"--}}
                                                                {{--time="{{$comment->created_at->diffForHumans()}}"></comment></li>--}}
                        {{--@endforeach--}}
                        {{--<comment article_id="{{$article->id}}"></comment>--}}
                        {{--<li class="divider"></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection