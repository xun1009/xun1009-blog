@extends('backend.layouts.app')
@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="{{ route('user') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="info-icon">
                                <i class="fa fa-user fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span>用户</span>
                            <div class="info-title">{{ $info['userCount'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="{{ route('article.index') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="info-icon">
                                <i class="fa fa-sticky-note fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span>文章</span>
                            <div class="info-title">{{ $info['articleCount'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="{{--{{ route('admin.comments') }}--}}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="info-icon">
                                <i class="fa fa-comments fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span>评论</span>
                            <div class="info-title">{{--{{ $info['comment_count'] }}--}}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="{{ route('tag.index') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="info-icon">
                                <i class="fa fa-tags fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span>标签</span>
                            <div class="info-title">{{ $info['tagCount'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="{{ route('category.index') }}">
                <div class="info-box">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="info-icon">
                                <i class="fa fa-folder fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span>分类</span>
                            <div class="info-title">{{ $info['categoryCount'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{--<div class="col-md-3 col-sm-4 col-xs-6">--}}
            {{--<a href="--}}{{--{{ route('admin.images') }}--}}{{--">--}}
                {{--<div class="info-box">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-4">--}}
                            {{--<div class="info-icon">--}}
                                {{--<i class="fa fa-image fa-fw"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-8">--}}
                            {{--<span>图片</span>--}}
                            {{--<div class="info-title">--}}{{--{{ $info['image_count'] }}--}}{{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-md-3 col-sm-4 col-xs-6">--}}
            {{--<a href="--}}{{--{{ route('admin.ips') }}--}}{{--">--}}
                {{--<div class="info-box">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-4">--}}
                            {{--<div class="info-icon">--}}
                                {{--<i class="fa fa-internet-explorer fa-fw"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-8">--}}
                            {{--<span>IP</span>--}}
                            {{--<div class="info-title">--}}{{--{{ $info['ip_count'] }}--}}{{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    </div>
@endsection
