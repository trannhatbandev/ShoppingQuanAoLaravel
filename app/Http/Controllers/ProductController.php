<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->checkLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderby('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderby('color_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('size_product',$size_product)->with('color_product',$color_product);
    }
    public function all_product(){
        $this->checkLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')
        ->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$product);
    }
    public function save_product(Request $request){
        $this->checkLogin();
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_desc'] = $request->product_desc;
       $data['product_content'] = $request->product_content;
       $data['product_price'] = $request->product_price;
       $data['product_status'] = $request->product_status;
       $data['category_id'] = $request->category_id;
       $data['brand_id'] = $request->brand_id;
       $data['size_id'] = $request->size_id;
       $data['color_id'] = $request->color_id;
       $image = $request->file('product_image');

       if($image){
            // $nameimage = explode('.',$image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path('/public/uploads/product/');
            $image->move("public/uploads/product/", $imageName);
            $image->imagePath = "public/uploads/product/" . $imageName;
            $data['product_image'] = $imageName;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
       }
       $data['product_image'] = '';
       DB::table('tbl_product')->insert($data);
       Session::put('message','Thêm sản phẩm thành công');
       return Redirect::to('all-product');
    }
    public function unactive_product($product_id)
    {
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 0]);
        Session::put('message','Ẩn  sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=> 1]);
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function update_product($product_id){
        $this->checkLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderby('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderby('color_id','desc')->get();

        $update_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $product = view('admin.update_product')->with('update_product',$update_product)
        ->with('cate_product',$cate_product)->with('brand_product',$brand_product)
        ->with('size_product',$size_product)->with('color_product',$color_product);

        return view('admin_layout')->with('admin.update_product',$product);
    }
    public function updates_product(Request $request, $product_id){
        $this->checkLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['size_id'] = $request->size_id;
        $data['color_id'] = $request->color_id;
        $image = $request->file('product_image');

        if($image){
             // $nameimage = explode('.',$image);
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             // $destinationPath = public_path('/public/uploads/product/');
             $image->move("public/uploads/product/", $imageName);
             $image->imagePath = "public/uploads/product/" . $imageName;
             $data['product_image'] = $imageName;
             DB::table('tbl_product')->where('product_id',$product_id)->update($data);
             Session::put('message','Thêm sản phẩm thành công');
             return Redirect::to('all-product');
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
     }
     public function delete_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
     }
     // KẾt thúc product back end

     public function details_product($product_id)
     {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $size_product = DB::table('tbl_size')->orderby('size_id','desc')->get();
        $color_product = DB::table('tbl_color')->orderby('color_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')
        ->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
        

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_size','tbl_size.size_id','=','tbl_product.size_id')
        ->join('tbl_color','tbl_color.color_id','=','tbl_product.color_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.product.show_details_product')
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)
        ->with('size_product',$size_product)
        ->with('color_product',$color_product)
        ->with('details_product',$details_product)
        ->with('related_product',$related_product);
     }
}
