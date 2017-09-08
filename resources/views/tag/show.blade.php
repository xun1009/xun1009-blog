@extends('layouts.app')
@section('title','标签 文章')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">博客</a></li>
            <li><a href="{{ route('front.tag') }}">标签</a></li>
            <li class="active">{{ $tagName }}</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                @if($articles->isEmpty())
                    <h3 class="meta-item center-block">没有找到相关文章</h3>
                @else
                    @each('article.item',$articles,'article')
                    {{--@if($articles->lastPage() > 1)--}}
                        {{--{{ $articles->links() }}--}}
                    {{--@endif--}}
                @endif
            </div>
            <div class="col-md-4">
                @include('layouts.widgets')
            </div>
        </div>
    </div>
@endsection