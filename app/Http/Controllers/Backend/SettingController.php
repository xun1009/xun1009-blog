<?php

namespace App\Http\Controllers\Backend;

use App\Xun\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $repository;

    public $allow = ['description','github','weibo'];

    public function __construct(UserRepositoryEloquent $userRepository)
    {
        $this->repository = $userRepository;
        $this->middleware('auth');
    }

    public function userShow()
    {
        $user = Auth::user();
        $settings = json_decode($user->settings,true);
        return view('backend.settings.userSettings',compact('user','settings'));
    }

    public function userUpdate()
    {
        $user = Auth::user();
        //合并设置数组
        $settings = $user->settings;
        if($settings == null){
            $settings = "[]";
        }
        $newSettings = array_merge(json_decode($settings,true),array_only(request()->all(),$this->allow));
        $jsonSettings = json_encode($newSettings);
        $user->update(['settings' => $jsonSettings]);
        return back();
    }

    //  管理员才能进此页面
    public function website()
    {
        return view('backend.settings.settings');
    }

    public function websiteUpdate()
    {
        dd(request()->all());
        return back();
    }

    public function changAvatar(Request $request)
    {
        $file = $request->file('img');
        $user = Auth::user();
        $fileName = $user->name.'_'.time().str_random(5).'.'.$file->getClientOriginalExtension();
        Storage::disk('qiniu')->writeStream('/avatars/'.$fileName,fopen($file->getRealPath(),'r'));
        $user->avatar = 'http://'.config('filesystems.disks.qiniu.domain').'/avatars/'.$fileName;
        $user->save();
        $config = config('filesystems.disks.qiniu.domain');
        return ['status' => 'success'];
    }
}
