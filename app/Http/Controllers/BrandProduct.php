<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->checkLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->checkLogin();
        $all_brand_product=DB::table('tbl_brand')->get();
        $brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$brand_product);
    }
    public function save_brand_product(Request $request){
       $this->checkLogin();
       $data = array();
       $data['brand_name'] = $request->brand_product_name;
       $data['brand_desc'] = $request->brand_product_desc;
       $data['brand_status'] = $request->brand_product_status;

       DB::table('tbl_brand')->insert($data);
       Session::put('message','Thêm thương hiệu sản phẩm thành công');
       return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        $this->checkLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' => 0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->checkLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=> 1]);
        Session::put('message','Hiển thị thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function update_brand_product($brand_product_id){
        $this->checkLogin();
        $update_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $brand_product = view('admin.update_brand_product')->with('update_brand_product',$update_brand_product);
        return view('admin_layout')->with('admin.update_brand_product',$brand_product);
    }
    public function updates_brand_product(Request $request, $brand_product_id){
        $this->checkLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
     }
     public function delete_brand_product($brand_product_id){
        $this->checkLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
     }

      //Kết thúc brand bên backend

     public function show_brand_home($brand_id)
     {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        return view('pages.brand.show_brand_home')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
     }
}
