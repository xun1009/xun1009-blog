@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-8">
                @if($articles->count()==0)
                    <h3 class="meta-item center-block">NO POSTS.</h3>
                @else
                    @each('article.item',$articles,'article')
                    @if($articles->lastPage() > 1)
                        {{ $articles->links() }}
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                <div class="slide">
                    @include('layouts.widgets')
                </div>
            </div>
        </div>
    </div>
@endsection