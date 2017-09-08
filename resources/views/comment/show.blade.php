@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <comments model="1"></comments>
    </div>
@endsection

{{--{{\Carbon\Carbon::createFromFormat("y-m-d",$comment->created_at)}}--}}