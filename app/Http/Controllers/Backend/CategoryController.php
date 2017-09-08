<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Xun\Repositories\CategoryRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    protected $repository;

    public function __construct(CategoryRepositoryEloquent $categoryRepository)
    {
        $this->repository = $categoryRepository;
        $this->middleware(['auth','role:owner|admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->repository->all();
        return view('backend.categories',compact('categories'));
    }

    public function create()
    {
        $categories = $this->repository->all();
        return view('backend.category.create',compact('categories'));
    }

    public function store(Request $request)
    {
//        if($request->parent_id == 'parent'){
//            $this->repository->create([
//                'name' => $request->category_name,
//                'depth' => 1,
//                'par_id' => 0,
//            ]);
//            return redirect('/backend/category');
//        }
////        if(!($this->repository->find($request->parent_id))){
////            return redirect('/backend/category/create')->withErrors('category','不存在的父id');
////        }
//        $depth = $this->repository->find($request->parent_id)->depth;
//        $this->repository->create([
//           'name' => $request->category_name,
//            'par_id' => $request->parent_id,
//            'depth'  => $depth + 1 ,
//        ]);
        if($request->parent_id == 'parent'){
            $root = Category::create(['name' => $request->get('category_name')]);
        }else{
            $root = Category::create(['name' => $request->get('category_name')]);

            $root->parent_id = $request->get('parent_id');
            $root->save();
        }

        return redirect('/backend/category');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('backend.category.edit',compact('category',$category));
    }

    public function update($id,Request $request)
    {
        $category = $this->repository->find($id);
        $category->name = $request->name;
        $category->save();
        return redirect('backend/category');
    }
    
    public function destroy($id,Request $request)
    {

        //后期 要先查询是否这个分类已经有文章了,如果有文章 删除不了
//        $destroys = [$id];
//        $categories = $this->repository->all();
//        foreach ($categories as $category){
//            if ($category->par_id == $id){
//                $destroys[] = $category->id;
//                //$this->repository->delete($category->id);
//                foreach ($categories as $lowerCategory){
//                    if ($category->id == $lowerCategory->par_id){
//                        //$this->repository->delete($lowerCategory->id);
//                        $destroys[] = $lowerCategory->id;
//                    }
//                }
//            }
//        }
//        //$this->repository->delete($id);
//        foreach ($destroys as $destroy){
//            $this->repository->delete($destroy);
//        }
        $category = $this->repository->find($id);
        $category->delete();

        flash('删除成功')->important();
        return back();
    }
}
