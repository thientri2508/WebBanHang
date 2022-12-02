<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public static function getListAll(){
        $list = Product::getListAll();
        return $list;
    }
    public static function getListCollections($idCategory){
        $list = Product::getListCollections($idCategory);
        return $list;
    }
    public static function getProduct($id){
        $product = Product::getProduct($id);
        return $product;
    }
    public static function getAmount($id, $size){
        $amount = Product::getAmountProductBySize($id, $size);
        return $amount;
    }
    public function getAmountProductBySize($id, $size){
        $amount = Product::getAmountProductBySize($id, $size);
        $count = 0;
        echo '<tr>';
        for($i=1;$i<=12;$i++)
        {
            $count++;
            if($amount>0) {echo '<td style="width:52px; height:51.2px" id="sl-'.$i.'" onclick="selectSoLuong(this.id)">'.$i.'</td>';}
            else {echo '<td style="width:52px; height:51.2px; opacity:0.2" id="sl-'.$i.'" >'.$i.'</td>';}
            if($i==12) { echo '</tr>';
                break;}
            if($count==4) { echo '</tr><tr>';
                $count=0;}
            $amount--;
        }
    }
    public function addMyCart($id, $qty, $size){
        $flag=true;
        $amount = Product::getAmountProductBySize($id, $size);
        if(!Session::has('mycart')) {
            $mycart = [];
            Session::put('mycart',$mycart);
        }
        $product = Product::getProduct($id);
        $mycart = Session::get('mycart');
        if(count($mycart)>0){
            foreach($mycart as &$sp){
                if($sp[0]==$id && $size==$sp[1]) {
                    if($sp[2]+$qty<=$amount) {
                        $sp[2]=$sp[2]+$qty;
                    }
                    $flag=false;
                    break;
                }
            }
        }
        unset($sp);
        if($flag) {
            $mycart = Session::get('mycart');
            $cart=[$id,$size,$qty];
            array_unshift($mycart,$cart);
            Session::put('mycart',$mycart);
        }else{
            Session::put('mycart',$mycart);
        }

        echo '<div class="title_cart">Giỏ hàng</div>';
        if(count($mycart)==2) {
            echo '<div id="cart_content" style="height: 255px;">';
        } else if(count($mycart)>=3) {
            echo '<div id="cart_content" style="height: 380px;">';
        } else {
            echo '<div id="cart_content">';
        }
        $tt = 0;
        foreach($mycart as $sp){
        $product = ProductController::getProduct($sp[0]);
        $tt+=($product[0]->price*$sp[2]);
        echo '<div class="ItemCartMini">
                <div style="width: 18%; height: 82%; float: left; margin-left: 5px">
                    <img src="/storage/'.$product[0]->image.'" style="width:100%; height:100%" >    
                </div>
                <div style="width: 50%; height: 82%; float: left; margin-left: 20px">
                    <div style="font-size: 12px">'.$product[0]->name.'</div>
                    <div style="color: #677279; font-size: 12px; margin-top: 3px; text-transform: uppercase">'.$sp[1].'</div>
                    <div class="box">'.$sp[2].'</div>
                </div>
                <div style="width: 20%; height: 82%; float: right; margin-right: 5px">
                    <div class="boxX">x</div>
                    <div style="clear:both; float: right; font-size: 13px; margin-top: 30px"><b>'.number_format($product[0]->price).'₫</b></div>
                </div>
            </div>';
        }
        echo '</div>
            <div style="width: 92%; margin: auto; height: 40px; margin-top: 20px">
                <div style="float: left; color: #677279; font-size: 12px;">TỔNG TIỀN:</div>
                <div style="float: right; font-weight: 600; font-size: 16px; color: red;">'.number_format($tt).'₫</div>
            </div>
            <div style="width: 92%; margin: auto; height: 45px; margin-bottom:20px">
                <a href="/cart"><div class="view_cart" style="float: left">XEM GIỎ HÀNG</div></a>
                <a href="/payment"><div class="view_cart" style="float: right">THANH TOÁN</div></a>
            </div>';
    }
    public function delItemCart($index){
        $mycart = Session::get('mycart');
        array_splice($mycart,$index-1,1);
        Session::put('mycart',$mycart);
        return Redirect::to('/cart');
    }
    public static function checkAmount($id, $size, $index, $sizetype){
        $amount = Product::getAmountProductBySize($id, $size);
        $s="'".$size."'";
        if($sizetype=='number1'){
            if($amount>0) {
                return '<td id="sizeCart-'.$index.'-'.$size.'-'.$sizetype.'" onclick="selectSizeCart(this.id);loadSLSP('.$id.','.$s.','.$index.')" style="text-transform: uppercase; width:52px; height:51.2px">'.$size.'</td>';
            }else{
                return '<td id="sizeCart-'.$index.'-'.$size.'-'.$sizetype.'" style="text-transform: uppercase; opacity:0.2; width:52px; height:51.2px">'.$size.'</td>';
            }
        }else{
            if($amount>0) {
                return '<td id="sizeCart-'.$index.'-'.$size.'-'.$sizetype.'" onclick="selectSizeCart(this.id);loadSLSP('.$id.','.$s.','.$index.')" style="text-transform: uppercase">'.$size.'</td>';
            }else{
                return '<td id="sizeCart-'.$index.'-'.$size.'-'.$sizetype.'" style="text-transform: uppercase; opacity:0.2">'.$size.'</td>';
            }
        } 
    }
    public function fixSizeItemCart($id, $size){
        $mycart = Session::get('mycart');
        $i=1;
        foreach($mycart as &$sp)
        {
            if($i==$id) { 
                $sp[1]=$size;
                $sp[2]=1;
                break;
            }
            $i++;
        }
        unset($sp);
        Session::put('mycart',$mycart);
        $tt=0;
        foreach($mycart as $sp)
        {
            $product = Product::getProduct($sp[0]);
            $tt+=($product[0]->price*$sp[2]);
        }
        echo number_format($tt).'₫';
    }
    public function fixAmountItemCart($id, $amount){
        $mycart = Session::get('mycart');
        $i=1;
        foreach($mycart as &$sp)
        {
            if($i==$id) {
                $sp[2]=$amount;
                break;
            }
            $i++;
        }
        unset($sp);
        Session::put('mycart',$mycart);
        $tt=0;
        foreach($mycart as $sp)
        {
            $product = Product::getProduct($sp[0]);
            $tt+=($product[0]->price*$sp[2]);
        }
        echo number_format($tt).'₫';
    }
    public function ResetAmountProductCart($id, $size, $index){
        $amount = Product::getAmountProductBySize($id, $size);
        $count = 0;
        echo '<tr>';
        for($j=1;$j<=12;$j++)
        {
            $count++;
            if($amount>0) {
                if($j==1){
                    echo '<td style="width:52px; height:51.2px; background:#E8E8E8" id="slCart-'.$index.'-'.$j.'" onclick="selectSoLuongCart(this.id)">'.$j.'</td>';
                }else{
                    echo '<td style="width:52px; height:51.2px" id="slCart-'.$index.'-'.$j.'" onclick="selectSoLuongCart(this.id)">'.$j.'</td>';
                }
            }
            else {echo '<td style="width:52px; height:51.2px; opacity:0.2" id="slCart-'.$index.'-'.$j.'" >'.$j.'</td>';}
            if($j==12) { echo '</tr>';
                break;}
            if($count==4) { echo '</tr><tr>';
                $count=0;}
            $amount--;
        }
    }
    public function resetCartMini(){
        $mycart = Session::get('mycart');
        echo '<div class="title_cart">Giỏ hàng</div>';
        if(count($mycart)==2) {
            echo '<div id="cart_content" style="height: 255px;">';
        } else if(count($mycart)>=3) {
            echo '<div id="cart_content" style="height: 380px;">';
        } else {
            echo '<div id="cart_content">';
        }
        $tt = 0;
        foreach($mycart as $sp){
        $product = ProductController::getProduct($sp[0]);
        $tt+=($product[0]->price*$sp[2]);
        echo '<div class="ItemCartMini">
                <div style="width: 18%; height: 82%; float: left; margin-left: 5px">
                    <img src="/storage/'.$product[0]->image.'" style="width:100%; height:100%" >    
                </div>
                <div style="width: 50%; height: 82%; float: left; margin-left: 20px">
                    <div style="font-size: 12px">'.$product[0]->name.'</div>
                    <div style="color: #677279; font-size: 12px; margin-top: 3px; text-transform: uppercase">'.$sp[1].'</div>
                    <div class="box">'.$sp[2].'</div>
                </div>
                <div style="width: 20%; height: 82%; float: right; margin-right: 5px">
                    <div class="boxX">x</div>
                    <div style="clear:both; float: right; font-size: 13px; margin-top: 30px"><b>'.number_format($product[0]->price).'₫</b></div>
                </div>
            </div>';
        }
        echo '</div>
            <div style="width: 92%; margin: auto; height: 40px; margin-top: 20px">
                <div style="float: left; color: #677279; font-size: 12px;">TỔNG TIỀN:</div>
                <div style="float: right; font-weight: 600; font-size: 16px; color: red;">'.number_format($tt).'₫</div>
            </div>
            <div style="width: 92%; margin: auto; height: 45px; margin-bottom:20px">
                <a href="/cart"><div class="view_cart" style="float: left">XEM GIỎ HÀNG</div></a>
                <div class="view_cart" style="float: right">THANH TOÁN</div>
            </div>';
    }
    public function install_product1(Request $request){
        $sizetype = Product::getSizetypeProduct($request->idProduct);
        if($sizetype != $request->sizetype){
            Product::deleteAmountProduct($request->idProduct);
            Product::addAmountProductBySizetype($request->idProduct, $request->sizetype);
        }
        Product::updateProduct($request->idProduct, $request->productName, $request->productPrice, $request->status, $request->sizetype);
        $category = $request->input('category');
        Product::updateProduct_Category($request->idProduct, $category);
        //return view('server.test',compact('category'));
        return Redirect::to('/admin/install_product/'.$request->idProduct);
    }
    public function admin_setImageProduct_MainSub($id, $image){
        Product::admin_setImageProduct_MainSub($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_SubMain($id, $image){
        Product::admin_setImageProduct_SubMain($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_TurnOffMain($id, $image){
        Product::admin_setImageProduct_TurnOffMain($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_TurnOffSub($id, $image){
        Product::admin_setImageProduct_TurnOffSub($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_TurnOnSub($id, $image){
        Product::admin_setImageProduct_TurnOnSub($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_DeleteMain($id){
        Product::admin_setImageProduct_DeleteMain($id);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function admin_setImageProduct_DeleteSub($id, $image){
        Product::admin_setImageProduct_DeleteSub($id, $image);
        return Redirect::to('/admin/install_product/'.$id);
    }
    public function install_product2(Request $request){
        $idProduct = $request->idProduct;
        $file = $request->file('file');
        $ex = array('jpg','png','jpeg');
        $imageProduct = Product::getImageProduct($idProduct);
        if(count($imageProduct)==0){
            $j = 1;
        }else{
            $j = 0;
            foreach($imageProduct as $i){
                $arr1 = explode('.', $i->image);
                $arr2 = explode('_',$arr1[0]);
                if(intval($arr2[1]) > $j){
                    $j = intval($arr2[1]);
                }
            }
            $j+=1;
        }
        if($file){
            foreach($file as $i){
                $flag = true;
                $nameImg = $i->getClientOriginalName();
                $file_type= strtolower(pathinfo($nameImg, PATHINFO_EXTENSION));
	            if(!in_array($file_type,$ex)) {
                    $flag=false;
                } 
                if($flag){
                    $name = 'sp'.$idProduct.'_'.$j.'.'.$i->getClientOriginalExtension();
                    $i->move('storage/',$name);
                    Product::admin_addImageProduct($idProduct, $name);
                    $j+=1;
                }
            }
        }
        return Redirect::to('/admin/install_product/'.$idProduct);
    }
    public function install_product3(Request $request){
        $idProduct = $request->idProduct;
        $product = Product::getProduct($idProduct);
        $sizetype = $product[0]->sizetype;
        if($sizetype=='word') {
            Product::updateAmountProduct($idProduct, 's', $request->sizes);
            Product::updateAmountProduct($idProduct, 'm', $request->sizem);
            Product::updateAmountProduct($idProduct, 'l', $request->sizel);
            Product::updateAmountProduct($idProduct, 'xl', $request->sizexl);
        }else if($sizetype=='number1'){
            for($i=29;$i<=36;$i++){
                $s = 'size'.$i;
                Product::updateAmountProduct($idProduct, $i, $request->$s);
            }
        }else if($sizetype=='number2'){
            Product::updateAmountProduct($idProduct, '40', $request->size40);
            Product::updateAmountProduct($idProduct, '41', $request->size41);
            Product::updateAmountProduct($idProduct, '42', $request->size42);
            Product::updateAmountProduct($idProduct, '43', $request->size43);
        }else if($sizetype=='free'){
            Product::updateAmountProduct($idProduct, 'freesize', $request->sizefreesize);
        }
        return Redirect::to('/admin/install_product/'.$idProduct);
    }
    public function create_product(Request $request){
        $idProduct = Product::addProduct($request->productName, $request->productPrice, $request->status, $request->sizetype);
        Product::addAmountProductBySizetype($idProduct, $request->sizetype);
        $category = $request->input('category');
        Product::addProduct_Category($idProduct, $category);
        $file = $request->file('file');
        $ex = array('jpg','png','jpeg');
        $j = 1;
        if($file){
            foreach($file as $i){
                $flag = true;
                $nameImg = $i->getClientOriginalName();
                $file_type= strtolower(pathinfo($nameImg, PATHINFO_EXTENSION));
	            if(!in_array($file_type,$ex)) {
                    $flag=false;
                } 
                if($flag){
                    $name = 'sp'.$idProduct.'_'.$j.'.'.$i->getClientOriginalExtension();
                    $i->move('storage/',$name);
                    Product::admin_addImageProduct($idProduct, $name);
                    $j+=1;
                }
            }
        }
        return Redirect::to('/admin/list_product');
    }
    public function delete_product($id){
        Product::deleteProduct($id);
        return Redirect::to('/admin/list_product');
    }
}
