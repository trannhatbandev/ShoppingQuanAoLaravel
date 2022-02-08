<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class SizeController extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_size(){
        $this->checkLogin();
        return view('admin.add_size');
    }
    public function all_size(){
        $this->checkLogin();
        $all_size=DB::table('tbl_size')->get();
        $size_product = view('admin.all_size')->with('all_size',$all_size);
        return view('admin_layout')->with('admin.all_size',$size_product);
    }
    public function save_size(Request $request){
        $this->checkLogin();
       $data = array();
       $data['size_name'] = $request->size_name;
       $data['size_desc'] = $request->size_desc;
       $data['size_status'] = $request->size_status;

       DB::table('tbl_size')->insert($data);
       Session::put('message','Thêm size sản phẩm thành công');
       return Redirect::to('add-size');
    }
    public function unactive_size($size_id)
    {
        $this->checkLogin();
        DB::table('tbl_size')->where('size_id',$size_id)->update(['size_status' => 0]);
        Session::put('message','Ẩn size sản phẩm thành công');
        return Redirect::to('all-size');
    }
    public function active_size($size_id){
        $this->checkLogin();
        DB::table('tbl_size')->where('size_id',$size_id)->update(['size_status'=> 1]);
        Session::put('message','Hiển thị size sản phẩm thành công');
        return Redirect::to('all-size');
    }
    public function update_size($size_id){
        $this->checkLogin();
        $update_size = DB::table('tbl_size')->where('size_id',$size_id)->get();
        $size_product = view('admin.update_size')->with('update_size',$update_size);
        return view('admin_layout')->with('admin.update_size',$size_product);
    }
    public function updates_size(Request $request, $size_id){
        $this->checkLogin();
        $data = array();
        $data['size_name'] = $request->size_name;
        $data['size_desc'] = $request->size_desc;

        DB::table('tbl_size')->where('size_id',$size_id)->update($data);
        Session::put('message','Cập nhật size sản phẩm thành công');
        return Redirect::to('all-size');
     }
     public function delete_size($size_id){
        $this->checkLogin();
        DB::table('tbl_size')->where('size_id',$size_id)->delete();
        Session::put('message','Xóa size sản phẩm thành công');
        return Redirect::to('all-size');
     }
}
