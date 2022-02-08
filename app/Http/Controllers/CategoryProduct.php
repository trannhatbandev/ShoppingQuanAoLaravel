<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->checkLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->checkLogin();
        $all_category_product=DB::table('tbl_category_product')->get();
        $category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$category_product);
    }
    public function save_category_product(Request $request){
       $this->checkLogin();
       $data = array();
       $data['category_name'] = $request->category_product_name;
       $data['category_desc'] = $request->category_product_desc;
       $data['category_status'] = $request->category_product_status;

       DB::table('tbl_category_product')->insert($data);
       Session::put('message','Thêm danh mục sản phẩm thành công');
       return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id)
    {
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 0]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=> 1]);
        Session::put('message','Hiển thị danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function update_category_product($category_product_id){
        $this->checkLogin();
        $update_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $category_product = view('admin.update_category_product')->with('update_category_product',$update_category_product);
        return view('admin_layout')->with('admin.update_category_product',$category_product);
    }
    public function updates_category_product(Request $request, $category_product_id){
        $this->checkLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
     }
     public function delete_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
     }

     //Kết thúc category bên backend

     public function show_category_home($category_id)
     {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category_home')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
     }

}
