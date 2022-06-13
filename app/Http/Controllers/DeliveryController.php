<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\Builder;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\wards;
use App\Models\Feeship;
session_start();

class DeliveryController extends Controller
{
    public function insert_delivery(Request $request){
        $data = $request ->all();
        $fee_ship = new Feeship();
        $fee_ship -> fee_matp = $data['city'];
        $fee_ship -> fee_maqh = $data['province'];
        $fee_ship -> fee_xaid = $data['wards'];
        $fee_ship -> fee_freeship = $data['fee_ship'];
        
        $fee_ship -> save();
    }

    public function delivery(Request $request){
        $city = City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
        $data = $request -> all();
        if($data['action']){
            $output ='';
            if($data['action'] == "city"){
                $select_province = Province::where('matp',$data['matp'])->orderby('matp','ASC')->get();
                    $output.='<option>--Chọn quận huyện--</option>';
                foreach ($select_province as $key => $province) {
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
                
            }else{
                $select_wards = wards::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                    $output.='<option>--Chọn phường xã--</option>';
                foreach ($select_wards as $key => $wards) {
                    $output.='<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }

    }

    
}
