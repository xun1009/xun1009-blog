<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Xun\Repositories\UserRepositoryEloquent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Overtrue\Socialite\SocialiteManager;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->middleware('guest')->except('logout');
        $this->repository = $repository;
    }

    public function github()
    {
        $socialite = new SocialiteManager(config('xun'));
        return $socialite->driver('github')->redirect();
    }

    public function githubCallback()
    {
        $socialite = new SocialiteManager(config('xun'));
        $github = $socialite->driver('github')->user();
        if($this->repository->isRegisterPlatform('github',$github->getId()))
        {
            Auth::login($this->repository->findWhere(['platform_id'=> $github->getId()])->first());
            flash('用github登入成功')->important();
            return redirect('/');
        }
        $newUser = $this->registerPlatformNewUser($github);
        Auth::login($newUser);
        flash('用github注册成功')->important();
        return redirect('/home');
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            flash('登入成功')->important();
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = array_merge($this->credentials($request),['is_active' => 1]);
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $field = filter_var(request('email'),FILTER_VALIDATE_EMAIL)?'email':'name';
        app('request')->merge([$field => request('email')]);
        return $field;
    }


    public function registerPlatformNewUser($platform)
    {
        $newName = $platform->getNickname();

        while($this->repository->isNameExist($platform->getNickname())){
            $newName = $platform->getNickname().'_'.str_random(5);
        }
        //记得将头像图片保存到本站中 再将本站中图片地址保存到avatar
        $avatar = file_get_contents($platform->getAvatar());

        $avatarName = '/images/avatars/'.$newName.'_'.time().'_'.str_random(5).'.jpg';

        Storage::disk('public')->put($avatarName, $avatar);

        do{
            $api_token = str_random(60);
        } while($this->repository->isApiTokenExist($api_token));

        return $this->repository->create([
            'name' => $newName,
            'avatar' => url('/').$avatarName,
            'password' => bcrypt(str_random(16)),
            'register_platform' => 'github',
            'platform_id' => $platform->getId(),
            'api_token' => $api_token,
            'is_active' => 1,
        ]);
    }
}
