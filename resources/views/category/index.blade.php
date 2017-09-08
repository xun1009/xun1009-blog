@extends('layouts.app')
@section('title','分类')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('widget.categories')
            </div>
        </div>
    </div>
@endsection
