<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\Builder;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function gio_hang(Request $request){
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request ->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }

    // public function add_cart_ajax(Request $request){
    //     $data = $request->all();
    //     $session_id = substr(md5(microtime()),rand(0,26),5);
    //     $cart = Session::get('cart');

    //     if($cart ==true){
    //         $is_avaiable = 0;
    //         foreach($cart as $key => $val){
    //             if($val['product_id']==$data['cart_product_id']){
    //                 $is_avaiable++;
    //             }
    //         }
    //         if($is_avaiable = 0){
    //             $cart[] = array(
    //                 'session_id'=> $session_id,
    //                 'product_id' => $data['cart_product_id'],
    //                 'product_name' => $data['cart_product_name'],
    //                 'product_image' => $data['cart_product_image'],
    //                 'product_qty' => $data['cart_product_qtv'],
    //                 'product_price' => $data['cart_product_price'],
    //             );
    //             Session::put('cart',$cart);
    //         }

    //     }else{
    //         $cart[] = array(
    //             'session_id'=> $session_id,
    //             'product_id' => $data['cart_product_id'],
    //             'product_name' => $data['cart_product_name'],
    //             'product_image' => $data['cart_product_image'],
    //             'product_qty' => $data['cart_product_qtv'],
    //             'product_price' => $data['cart_product_price'],
    //         );
    //         Session::put('cart',$cart);
    //     }
        
    //     Session::save();
    // }

    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_infor = DB::table('tbl_product')->where('product_id',$productId)->first();

        $data['id']= $product_infor->product_id;
        $data['qty']= $quantity;
        $data['name']= $product_infor->product_name;
        $data['price']= $product_infor->product_price;
        $data['weight']= 0;
        $data['options']['image']= $product_infor->product_image;
        
        Cart::add($data);
        Cart::setGlobalTax(10);

        return Redirect::to('/show-cart');
    }

    public function show_cart(Request $request){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        // $cart = Cart::content()->where('rowId',$rowId);
        //     if($cart->isNotEmpty()){
        //         Cart::remove($rowId);
        //     }
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request -> rowId_cart;
        $qty = $request -> cart_quantity;

        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
