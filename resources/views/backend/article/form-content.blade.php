<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="control-label">文章标题*</label>
    <input id="title" type="text" class="form-control" name="title"
           value="{{ isset($article) ? $article->title : old('title') }}"
           autofocus>
    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="control-label">文章描述*</label>

    <textarea id="post-description-textarea" style="resize: vertical;" rows="3" spellcheck="false"
              id="description" class="form-control autosize-target" placeholder="首页中这篇文章的简介"
              name="description">{{ isset($article) ? $article->description : old('description') }}</textarea>

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>


<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="categories" class="control-label">文章分类*</label>
    <select name="category_id" class="form-control">
        @if(!isset($article))
            <option value="" selected>请选择分类</option>
        @endif
        @foreach($categories as $category)

            @if(isset($article))
                @if(($article->category_id == $category->id))
                    <option value="{{ $category->id }}" selected>
                        @for($i = 0; $i < $category->depth; $i++)
                            <?php echo '&nbsp;&nbsp;'?>
                        @endfor
                        {{$category->name }}</option>
                @else
                    <option value="{{ $category->id }}">
                        @for($i = 0; $i < $category->depth; $i++)
                            <?php echo '&nbsp;&nbsp;'?>
                        @endfor
                        {{$category->name }}</option>
                @endif
            @else
                <option value="{{ $category->id }}">
                    @for($i = 0; $i < $category->depth; $i++)
                    <?php echo '&nbsp;&nbsp;'?>
                    @endfor
                    {{$category->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('tags[]') ? ' has-error' : '' }}">
    <label for="tags[]" class="control-label">文章标签</label>
    <select id="post-tags" name="tags[]" class="form-control" multiple>
        @foreach($tags as $tag)
            @if(isset($article) && $article->tags->contains($tag))
                <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
            @else
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('tags[]'))
        <span class="help-block">
            <strong>{{ $errors->first('tags[]') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error ' : ' ' }}">
    <label for="post-content-textarea" class="control-label">文章内容*</label>
    <textarea spellcheck="false" id="post-content-textarea" class="form-control" name="content"
              rows="36"
              placeholder="请使用 Markdown 格式书写"
              style="resize: vertical">{{ isset($article) ? $article->content : '' }}</textarea>
    @if($errors->has('content'))
        <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
    @endif
</div>


{{--<div class="form-group">--}}
    {{--<div class="radio radio-inline">--}}
        {{--<label>--}}
            {{--<input type="radio"--}}
                   {{--{{ (isset($article)) && $article->status == 1 ? ' checked ':'' }}--}}
                   {{--name="status"--}}
                   {{--value="1">发布--}}
        {{--</label>--}}
    {{--</div>--}}
    {{--<div class="radio radio-inline">--}}
        {{--<label>--}}
            {{--<input type="radio"--}}
                   {{--{{ (!isset($article)) || $article->status == 0 ? ' checked ':'' }}--}}
                   {{--name="status"--}}
                   {{--value="0">草稿--}}
        {{--</label>--}}
    {{--</div>--}}
{{--</div>--}}
{{ csrf_field() }}