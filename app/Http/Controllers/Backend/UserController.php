<?php

namespace App\Http\Controllers\Backend;

use App\Xun\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    protected $repository;

    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
        $this->middleware(['auth','role:owner|admin']);
    }

    public function index()
    {
        $users = $this->repository->all();
        return view('backend.users',compact('users'));
    }
}
