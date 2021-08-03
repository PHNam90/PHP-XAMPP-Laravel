<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
class CategoriesController extends Controller
{
    //read
    public function read(Request $request)
    {
        $data = DB::table("categories")->where("parent_id","=","0")->orderBy('id','desc')->get();
        return view("backend.categories_read",["data"=>$data]);
    }
    //update
    public function update(Request $request,$id){
        //lay mot ban ghi
        $action = url("admin/categories/update/$id");
        $record = DB::table("categories")->where("id","=",$id)->first();
        return view("backend.categories_create_update",["record"=>$record,'action'=>$action]);
    }
    //update post
    public function updatePost(Request $request,$id){
        $name = $request->name;
        $parent_id = $request->get("parent_id");
        $a = $request->get("displayhomepage");
        $displayhomepage = isset($a) ? 1:0;
        //update name
        DB::table("categories")->where("id","=",$id)->update(array("name"=>$name,"parent_id"=>$parent_id,"displayhomepage"=>$displayhomepage,"id"=>$id));
        return redirect(url('admin/categories'));
    }
    //create
    public function create(Request $request){
        $action = url("admin/categories/create");
        return View("backend.categories_create_update",['action'=>$action]);
    }
    //create post
    public function createPost(Request $request){
        $name = $request->get("name");
        $parent_id = $request->get("parent_id");
        $displayhomepage = $request->get("displayhomepage");
        $displayhomepage = isset($displayhomepage) ? 1:0;
            DB::table("categories")->insert(array("parent_id"=>$parent_id,"name"=>$name,"displayhomepage"=>$displayhomepage));
        return redirect(url('admin/categories'));
    }
    //delete
    public function delete(Request $request,$id){
        //lay mot ban ghi
        $record = DB::table("categories")->where("id","=",$id)->delete();
        return redirect(url('admin/categories'));
    }
}
