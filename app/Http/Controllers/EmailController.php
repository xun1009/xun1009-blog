<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    //
    public function checkEmail()
    {
        return view('check_email');
    }

    public function verify($token)
    {
        $user = User::where('confirm_token',$token)->first();
        if($user == null ){
            return redirect('home');
        }
        $user->confirm_token = str_random(40);
        $user->is_active = 1;
        $user->save();
        Auth::login($user);
        flash('恭喜您账号注册成功')->important();
        //flash()->overlay('恭喜您账号注册成功', 'xun');
        return redirect('home');
    }
}
