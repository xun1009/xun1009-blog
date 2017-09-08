
    <avatar avatar="{{$user->avatar}}"></avatar>

    <div class="alone-divider"></div>
    <form class="mt-30" action="{{ route('setting.user.update') }}" method="post">
        {{ csrf_field() }}
        {{--<input name="_method" type="hidden" value="patch">--}}
        <div class="form-group">
            <label>用户名：</label>
            <input class="form-control" name="name" type="text" value="{{ $user->name }}" readonly>
        </div>
        <div class="form-group">
            <label>个人简介：</label>
            <textarea class="form-control" name="description" cols="30" rows="5">{{ $settings['description'] }}</textarea>
        </div>
        <div class="form-group">
            <label>Github：</label>
            <input class="form-control" name="github" type="text" value="{{$settings['github']}}">
        </div>
        <div class="form-group">
            <label>Weibo：</label>
            <input class="form-control" name="weibo" type="text" value="{{$settings['weibo']}}">
        </div>
        <input type="submit" class="btn btn-primary" value="确定修改">
    </form>

