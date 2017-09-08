@extends('backend.layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6>
                        <i class="fa fa-sticky-note fa-fw"></i>文章
                        {{--<a class="meta-item" href="{{ route('post.download-all') }}">Download All</a>--}}
                    </h6>
                </div>
                <div class="widget-body">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>状态</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr class="">
                                <td title="{{ $article->title }}">{{ str_limit($article->title,64) }}</td>
                                <td></td>
                                <td>
                                    <div>
                                        <a  href="{{ route('article.edit',$article->id) }}"
                                           data-toggle="tooltip" data-placement="top" title="编辑"
                                           class="btn btn-info">
                                            <i class="fa fa-pencil fa-fw"></i>
                                        </a>
                                        {{--<form style="display: inline" method="post"--}}
                                              {{--action="{{ route('post.publish',$article->id) }}">--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<button type="submit" class="btn btn-default" data-toggle="tooltip"--}}
                                                    {{--data-placement="top" title="发布">--}}
                                                {{--<i class="fa fa-send-o fa-fw"></i>--}}
                                            {{--</button>--}}
                                        {{--</form>--}}
                                        <button class="btn btn-danger swal-dialog-target"
                                                data-title="{{ $article->title }}"
                                                data-dialog-msg="确定删除文章<label>{{ $article->title }}</label>？"
                                                title="删除"
                                                data-dialog-enable-html="1"
                                                data-url="{{ route('article.destroy',$article->id) }}"
                                                data-dialog-confirm-text="删除">
                                            <i class="fa fa-trash-o  fa-fw"></i>
                                        </button>
                                        {{--<a class="btn btn-default" href="{{ route('post.download',$article->id) }}">--}}
                                            {{--<i class="fa fa-cloud-download fa-fw"></i>--}}
                                        {{--</a>--}}
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                操作
                                                <span class="caret"></span>
                                            </button>
                                            <?php $commentable = $article?>
                                            <ul class="dropdown-menu">

                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$articles->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection

