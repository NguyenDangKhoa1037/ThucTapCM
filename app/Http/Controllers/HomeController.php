<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
session_start();

class HomeController extends Controller
{
    public function index(Request $request){

        // seo
        // $meta_desc = 'Chuyên bán phụ kiện game';
        // $meta_keywords = 'Tai nghe gaming, bàn phím gaming.';
        // $meta_title = 'Phụ kiện chơi game chất lượng cao';
        // $url_canonical = $request->url();
        //end seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
        // ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        // ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }

    public function send_mail(){
        $to_name = "Khoa Gaming";
        $to_email = "nhoxsakerxx@gmail.com";//send to this email
        
        $data = array("name"=>"Khoa gaming","body"=>" Đặt hàng thành công "); //body of mail.blade.php
            
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Đặt hàng thành công');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
         });

        return Redirect::to('/')->with('message',' ');

    }
}
