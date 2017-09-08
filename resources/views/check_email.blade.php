@extends('layouts.app')
@section('title','博客')
@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">请先验证你的邮箱</h2>
            </div>
        </div>
    </div>
@endsection