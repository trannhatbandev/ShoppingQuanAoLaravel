<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class ColorController extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_color(){
        $this->checkLogin();
        return view('admin.add_color');
    }
    public function all_color(){
        $this->checkLogin();
        $all_color=DB::table('tbl_color')->get();
        $color_product = view('admin.all_color')->with('all_color',$all_color);
        return view('admin_layout')->with('admin.all_color',$color_product);
    }
    public function save_color(Request $request){
       $this->checkLogin();
       $data = array();
       $data['color_name'] = $request->color_name;
       $data['color_desc'] = $request->color_desc;
       $data['color_status'] = $request->color_status;

       DB::table('tbl_color')->insert($data);
       Session::put('message','Thêm màu sản phẩm thành công');
       return Redirect::to('add-color');
    }
    public function unactive_color($color_id)
    {
        $this->checkLogin();
        DB::table('tbl_color')->where('color_id',$color_id)->update(['color_status' => 0]);
        Session::put('message','Ẩn màu sản phẩm thành công');
        return Redirect::to('all-color');
    }
    public function active_color($color_id){
        $this->checkLogin();
        DB::table('tbl_color')->where('color_id',$color_id)->update(['color_status'=> 1]);
        Session::put('message','Hiển thị màu sản phẩm thành công');
        return Redirect::to('all-color');
    }
    public function update_color($color_id){
        $this->checkLogin();
        $update_color = DB::table('tbl_color')->where('color_id',$color_id)->get();
        $color_product = view('admin.update_color')->with('update_color',$update_color);
        return view('admin_layout')->with('admin.update_color',$color_product);
    }
    public function updates_color(Request $request, $color_id){
        $this->checkLogin();
        $data = array();
        $data['color_name'] = $request->color_name;
        $data['color_desc'] = $request->color_desc;

        DB::table('tbl_color')->where('color_id',$color_id)->update($data);
        Session::put('message','Cập nhật màu sản phẩm thành công');
        return Redirect::to('all-color');
     }
     public function delete_color($color_id){
        $this->checkLogin();
        DB::table('tbl_color')->where('color_id',$color_id)->delete();
        Session::put('message','Xóa màu sản phẩm thành công');
        return Redirect::to('all-color');
     }
}
