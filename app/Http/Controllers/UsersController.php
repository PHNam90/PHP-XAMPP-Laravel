<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
class UsersController extends Controller
{
    //read
    public function read(Request $request)
    {
        $data = DB::table('users')->orderBy('id','desc')->paginate(5);
        return view("backend.users_read",["data"=>$data]);
    }
    //update
    public function update(Request $request,$id){
        //lay mot ban ghi
        $action = url("admin/users/updatePost/$id");
        $record = DB::table("users")->where("id","=",$id)->first();
        return view("backend.users_create_update",["record"=>$record,'action'=>$action]);
    }
    //update post
    public function updatePost(Request $request,$id){
        $name = $request->name;
        $password = $request->password;
        //update name
        DB::table("users")->where("id","=",$id)->update(array("name"=>$name));
        //neu password khong rong thi update password
        if($password != ""){
            //ma hoa password
            $password = Hash::make($password);
            DB::table("users")->where("id","=",$id)->update(array("password"=>$password));
        }
        return redirect(url('admin/users'));
    }
    //create
    public function create(Request $request){
        $action = url("admin/users/createPost");
        return View("backend.users_create_update",['action'=>$action]);
    }
    //create post
    public function createPost(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        //ma hoa password
        $password = Hash::make($password);
        //kiem tra xem email da ton tai chua
        $check = DB::table("users")->where("email","=",$email)->Count();
        if($check == 0)
            DB::table("users")->insert(array("name"=>$name,"email"=>$email,"password"=>$password));
        else
            return redirect(url('admin/users/create?notify=exists'));
        return redirect(url('admin/users'));
    }
    //delete
    public function delete(Request $request,$id){
        //lay mot ban ghi
        $record = DB::table("users")->where("id","=",$id)->delete();
        return redirect(url('admin/users'));
    }
}
