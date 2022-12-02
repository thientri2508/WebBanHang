<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Detail_Category;
use App\Models\Order;
use App\Models\Account;

class PagesController extends Controller
{
    public function index(){
        $list_hot_product = Product::getListByStatus('hot',8);
        $list_new_product = Product::getListByStatus('new-arrival',8);
        $list_best_product = Product::getListByStatus('best-seller',8);
        return view('client.index', compact('list_hot_product','list_new_product','list_best_product'));
    }
    public function collections($idCategory, $page){
        $t = explode("-",$page);
        $p = intval($t[1]);
        $list = Product::getListCollectionsByPage($idCategory, $p);
        $amount = Product::getAmountByCategory($idCategory);
        $nameCategory = Category::getName($idCategory);
        $list_hot_product = Product::getListByStatus('hot',5);
        return view('client.collections', compact('list','amount','p','idCategory','nameCategory','list_hot_product'));
    }
    public function register(){
        return view('client.register');
    }
    public function detail_product($idProduct){
        $product = Product::getProduct($idProduct);
        $category = Product::getCategoryByProduct($idProduct);
        $image = Product::getImageProduct($idProduct);
        return view('client.detail_product',compact('product','category','image'));
    }
    public function cart(){
        return view('client.cart');
    }
    public function account(){
        return view('client.account');
    }
    public function addresses(){
        return view('client.addresses');
    }
    public function password(){
        return view('client.password');
    }
    public function payment(){
        return view('client.payment');
    }
    public function order(){
        return view('client.order');
    }
    public function order_detail($id){
        $order = Order::getOrderByID($id);
        $detail_order = Order::getOrderDetailByID($id);
        $list_product_order = array();
        foreach($detail_order as $o){
            $p = Product::getProduct($o->ProductID);
            array_push($list_product_order,$p[0]);
        }
        return view('client.detail_order',compact('order','detail_order','list_product_order'));
    }
    public function admin_loggin(){
        return view('server.loggin');
    }
    public function admin_index(){
        return view('server.index');
    }
    public function admin_listCategory(){
        $list_category = Category::getList();
        $list_detail_category = Detail_Category::getListALL();
        return view('server.listCategory',compact('list_category','list_detail_category'));
    }
    public function admin_listProduct(){
        $list = Product::getListAll();
        return view('server.listProduct',compact('list'));
    }
    public function admin_createCategory(){
        return view('server.createCategory');
    }
    public function admin_order(){
        $list = Order::getAllOrder();
        return view('server.order',compact('list'));
    }
    public function admin_OrderDetail($id){
        $order = Order::getOrderByID($id);
        $order_detail = Order::getOrderDetailByID($id);
        $list_product_order = array();
        $customer = Account::getAccount($order[0]->EmailUser);
        foreach($order_detail as $o){
            $p = Product::getProduct($o->ProductID);
            array_push($list_product_order,$p[0]);
        }
        return view('server.OrderDetail',compact('order','order_detail','list_product_order','customer'));
    }
    public function admin_installCategory($id){
        $category = Category::getCategoryById($id);
        $amountCategory = Category::getAmount();
        $list_detail_category = Detail_Category::getDetailCategoryById($id);
        return view('server.installCategory',compact('category','list_detail_category','amountCategory'));
    }
    public function admin_installProduct($id){
        $product = Product::getProduct($id);
        $list_image_product = Product::getImageProduct($id);
        $list_detailCategory = Detail_Category::getListALL();
        $list_category = Category::getList();
        $list_all_category = array();
        foreach($list_category as $l){
            if(Category::checkCategory($l->id)) {
                $array = [$l->id, $l->name];
                array_push($list_all_category,$array);
            }
        }
        foreach($list_detailCategory as $l){
            $array = [$l->id, $l->name];
            array_push($list_all_category,$array);
        }
        $list_CategoryOfProduct = Category::getCategoryByIDProduct($id);
        $amount = Product::getAmountProduct($id);
        return view('server.installProduct',compact('product','list_image_product','list_all_category','list_CategoryOfProduct','amount'));
    }
    public function admin_createProduct(){
        $list_detailCategory = Detail_Category::getListALL();
        $list_category = Category::getList();
        $list_all_category = array();
        foreach($list_category as $l){
            if(Category::checkCategory($l->id)) {
                $array = [$l->id, $l->name];
                array_push($list_all_category,$array);
            }
        }
        foreach($list_detailCategory as $l){
            $array = [$l->id, $l->name];
            array_push($list_all_category,$array);
        }
        return view('server.createProduct',compact('list_all_category'));
    }
}
