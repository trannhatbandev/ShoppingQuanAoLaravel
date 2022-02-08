<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Darryldecode\Cart\CartCondition;
session_start();

class CartController extends Controller
{
    public function gio_hang(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.cart.cart_ajax')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,30),5);
        $cart = Session::get('cart');
        if($cart ==true){
            $is_available = 0;
            foreach($cart as $key => $value){
                if($value['product_id']==$data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available ==0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }
      
        Session::save();
    }
    public function delete_cart($session_id)
    {
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
    public function delete_all_cart()
    {
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            return redirect()->back()->with('message','Xóa hết giỏ hàng thành công');
        }
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $value){
                    if($value['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Cập nhật sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Cập nhật sản phẩm không thành công');
        }
    }
    public function save_cart(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        Cart::add(array(
                'id' => $product_info->product_id,
                'name' => $product_info->product_name,
                'price' => $product_info->product_price,
                'quantity' => $quantity,
                'attributes' => array(
                  'image' => $product_info->product_image,
                )
          ));
       
        $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 1.5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '1.5%',
            'order' => 2
        ));
        Cart::condition($condition1);
        // Cart :: removeCartCondition ($condition2);
        return Redirect::to('/show-cart');
        
    }

    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    }
    public function delete_to_cart($id)
    {
        Cart::remove($id);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $product_id = $request->product_id_to_cart;
        $qty = $request->cart_to_quantity;
        Cart::update($product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
          ));
        return Redirect::to('/show-cart');
    }
}
