<?php

namespace App\Http\Controllers\Backend;

use App\Xun\Repositories\TagRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    //
    protected $repository;

    public function __construct(TagRepositoryEloquent $tagRepository)
    {
        $this->repository = $tagRepository;
        $this->middleware(['auth','role:owner|admin']);
    }

    public function index()
    {
        $tags = $this->repository->all();
        return view('backend.tags',compact('tags',$tags));
    }

    public function create()
    {
        return view('backend.tag.create');
    }

    public function store(Request $request)
    {
        $this->repository->create([
           'name' => $request->get('name'),
        ]);
        flash('添加成功')->important();
        return back();
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }
}
