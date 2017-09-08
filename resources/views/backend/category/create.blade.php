@extends('backend.layouts.app')
@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-md-8 col-md-offset-2">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3>添加分类</h3>
                </div>
                <div class="widget-body">
                    <form role="form" class="form-horizontal" action="{{ route('category.store') }}"
                          method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">新的分类</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control" name="category_name" value="{{ old('category') }}" autofocus>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text" class="col-md-4 control-label">上级分类</label>

                            <div class="col-md-6">
                                <select name="parent_id" class="form-control">
                                    <option value="parent">顶级分类</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            @for($i = 0; $i < $category->depth; $i++)
                                                <?php echo '&nbsp;&nbsp;&nbsp;'?>
                                            @endfor
                                                {{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    添加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection