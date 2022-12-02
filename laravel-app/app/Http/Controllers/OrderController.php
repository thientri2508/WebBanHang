<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Order;
use App\Models\Product;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class OrderController extends Controller
{
    public function order(){
        $mycart = Session::get('mycart');
        $userloggin = Session::get('userloggin');
        $total = 0;
        $address = 'Tỉnh/Thành Phố: '.$userloggin["city"].' Quận/Huyện: '.$userloggin["district"].' Phường/Xã: '.$userloggin["ward"].' Địa Chỉ: '.str_replace('-','/',$userloggin["address"]).' Số Điện Thoại: '.$userloggin["phone"];
        foreach($mycart as $i){
            $product = Product::getProduct($i[0]);
            $total+=($product[0]->price*$i[2]);
        }
        $data = array();
        $data['EmailUser'] = $userloggin['email'];
        $data['DateOrder'] = date("Y-m-d");
        $data['status'] = "Unconfimred";
        $data['total'] = $total;
        $data['delivery_address'] = $address;
        $OrderID=Order::addOrder($data);
        foreach($mycart as $i){
            $data = array();
            $product = Product::getProduct($i[0]);
            $data['OrderID'] = $OrderID;
            $data['ProductID'] = $i[0];
            $data['size'] = $i[1];
            $data['amount'] = $i[2];
            $data['price'] = $product[0]->price;
            $data['total'] = $product[0]->price*$i[2];
            Order::addOrderDetail($data);
            Product::order($i[0],$i[1],$i[2]);
        }
        $mycart = [];
        Session::put('mycart',$mycart);
        return Redirect::to('/account/orders');
    }
    public function update_status($status, $id){
        Order::update_status($status, $id);
        return Redirect::to('/admin/order_detail/'.$id);
    }
    public static function getOrderByEmail($id){
        $list = Order::getOrderByEmail($id);
        return array_reverse($list);
    }
    public function cancel_order($id){
        Order::cancel_order($id);
        return Redirect::to('/account/order_detail/'.$id);
    }
}