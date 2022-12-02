<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public static function getAllOrder(){
        $list = DB::select('SELECT * FROM orders');
        return array_reverse($list);
    }
    public static function addOrder($data){
        DB::table('orders')->insert($data);
        $p = DB::select('SELECT * FROM orders WHERE OrderID=(SELECT MAX(OrderID) FROM orders)');
        return $p[0]->OrderID;
    }
    public static function addOrderDetail($data){
        DB::table('detail_orders')->insert($data);
    }
    public static function getOrderByID($id){
        $order = DB::select('SELECT * FROM orders WHERE OrderID='.$id);
        return $order;
    }
    public static function getOrderDetailByID($id){
        $order_detail = DB::select('SELECT * FROM detail_orders WHERE OrderID='.$id);
        return $order_detail;
    }
    public static function update_status($status, $id){
        DB::table('orders')->where('OrderID', $id)->update(['status' => $status]);
    }
    public static function getOrderByEmail($email){
        $list = DB::select('SELECT * FROM orders WHERE EmailUser="'.$email.'"');
        return $list;
    }
    public static function cancel_order($id){
        DB::table('orders')->where('OrderID', $id)->update(['status' => 'Cancel']);
    }
}
