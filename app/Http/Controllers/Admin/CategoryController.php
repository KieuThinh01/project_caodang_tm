<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    function index(){
        $data = Category::with('parent')->paginate(15); //phan trang
        //return view('admin.users.index',$data);
        //dd($data);
        return view('admin.category.index',['data'=>$data]);
    }
    //
    function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->name;
            $parent_id = $request->parent_id;
          

            //tạo mới một đối tượng user
            $category = new Category;
            $category->parent_id = $parent_id;
            $category->name = $name;
            $category->save();
        }
        $data = Category::all();
        return view('admin.category.add',['parentCategory'=>$data]);
    }

    function delete(Request $request){
       $id = $request->id;
       $user = Category::find($id); //tìm user có id truyền vào
       if($user!=null){
         $user->delete();
       }
       return redirect('admin/category');
    }
}
