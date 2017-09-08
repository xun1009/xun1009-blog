@extends('backend.layouts.app')
@section('title','分类')
@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6><i class="fa fa-folder fa-fw"></i>分类</h6>
                </div>
                <a class="btn pull-right" data-toggle="modal" href="{{route('category.create')}}">
                    <i class="fa fa-folder-o"></i>
                </a>
                <ul class="widget-body list-group">
                    @if($categories)
                        <table class="table table-hover table-striped table-bordered table-responsive" style="overflow: auto">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>日期</th>
                                <th>文章</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        @for($i = 0; $i < $category->depth; $i++)
                                            <?php echo '&nbsp;&nbsp;&nbsp;'?>
                                        @endfor
                                            {{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $category->posts_count }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info"
                                               data-toggle="tooltip" data-placement="top" title="编辑">
                                                <i class="fa fa-pencil fa-fw"></i>
                                            </a>
                                            <button class="btn btn-danger swal-dialog-target"
                                                    data-toggle="tooltip" data-placement="top" title="删除"
                                                    data-url="{{ route('category.destroy',$category->id) }}"
                                                    data-dialog-msg="删除{{ $category->name }}?">
                                                <i class="fa fa-trash-o fa-fw"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            {{--@foreach($categories as $category)--}}
                                {{--@if($category->par_id == 0)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ $category->name }}</td>--}}
                                        {{--<td>{{ $category->created_at->format('Y-m-d') }}</td>--}}
                                        {{--<td>{{ $category->posts_count }}</td>--}}
                                        {{--<td>--}}
                                            {{--<div>--}}
                                                {{--<a href="{{ route('category.edit',$category->id) }}" class="btn btn-info"--}}
                                                   {{--data-toggle="tooltip" data-placement="top" title="编辑">--}}
                                                    {{--<i class="fa fa-pencil fa-fw"></i>--}}
                                                {{--</a>--}}
                                                {{--<button class="btn btn-danger swal-dialog-target"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="删除"--}}
                                                        {{--data-url="{{ route('category.destroy',$category->id) }}"--}}
                                                        {{--data-dialog-msg="删除{{ $category->name }}?">--}}
                                                    {{--<i class="fa fa-trash-o fa-fw"></i>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--@foreach($categories as $lowerCategory)--}}
                                        {{--@if($category->id == $lowerCategory->par_id)--}}
                                            {{--<tr>--}}
                                                {{--<td>&nbsp;&nbsp;&nbsp;{{ $lowerCategory->name }}</td>--}}
                                                {{--<td>{{ $lowerCategory->created_at->format('Y-m-d') }}</td>--}}
                                                {{--<td>--}}{{--{{ $category->posts_count }}--}}{{--</td>--}}
                                                {{--<td>--}}
                                                    {{--<div>--}}
                                                        {{--<a href="{{ route('category.edit',$lowerCategory->id) }}" class="btn btn-info"--}}
                                                           {{--data-toggle="tooltip" data-placement="top" title="编辑">--}}
                                                            {{--<i class="fa fa-pencil fa-fw"></i>--}}
                                                        {{--</a>--}}
                                                        {{--<button class="btn btn-danger swal-dialog-target"--}}
                                                                {{--data-toggle="tooltip" data-placement="top" title="删除"--}}
                                                                {{--data-url="{{ route('category.destroy',$lowerCategory->id) }}"--}}
                                                                {{--data-dialog-msg="删除{{ $lowerCategory->name }}?">--}}
                                                            {{--<i class="fa fa-trash-o fa-fw"></i>--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                            {{--@foreach($categories as $lowerLowerCategory)--}}
                                                {{--@if($lowerCategory->id == $lowerLowerCategory->par_id)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $lowerLowerCategory->name }}</td>--}}
                                                        {{--<td>{{ $lowerLowerCategory->created_at->format('Y-m-d') }}</td>--}}
                                                        {{--<td>--}}{{--{{ $lowerLowerCategory->posts_count }}--}}{{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--<div>--}}
                                                                {{--<a href="{{ route('category.edit',$lowerLowerCategory->id) }}" class="btn btn-info"--}}
                                                                   {{--data-toggle="tooltip" data-placement="top" title="编辑">--}}
                                                                    {{--<i class="fa fa-pencil fa-fw"></i>--}}
                                                                {{--</a>--}}
                                                                {{--<button class="btn btn-danger swal-dialog-target"--}}
                                                                        {{--data-toggle="tooltip" data-placement="top" title="删除"--}}
                                                                        {{--data-url="{{ route('category.destroy',$lowerLowerCategory->id) }}"--}}
                                                                        {{--data-dialog-msg="删除{{ $lowerLowerCategory->name }}?">--}}
                                                                    {{--<i class="fa fa-trash-o fa-fw"></i>--}}
                                                                {{--</button>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    @else
                        <p class="meta-item center-block">没有分类</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    @include('backend.modals.add-category-modal')
@endsection