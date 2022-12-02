<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    public static function getListAll(){
        $list = DB::select('SELECT * FROM product');
        return array_reverse($list);
    }
    public static function getListCollections($idCategory){
        $list = DB::select('SELECT * FROM product, product_category Where id = idProduct AND idCategory ="'.$idCategory.'"');
        return $list;
    }
    public static function getListCollectionsByPage($idCategory, $page){
        $start = ($page-1)*2;
        $list = DB::select('SELECT * FROM product, product_category Where id = idProduct AND idCategory ="'.$idCategory.'" LIMIT '.$start.', 15');
        return $list;
    }
    public static function getAmountByCategory($idCategory){
        $list = DB::select('SELECT * FROM product, product_category Where id = idProduct AND idCategory ="'.$idCategory.'"');
        return count($list);
    }
    public static function getListByStatus($status, $limit){
        $list = DB::select('SELECT * FROM product Where status ="'.$status.'" LIMIT '.$limit);
        return $list;
    }
    public static function getProduct($id){
        $product = DB::select('SELECT * FROM product Where id ='.$id);
        return $product;
    }
    public static function getCategoryByProduct($id){
        $category = DB::select('SELECT detail_category.id, detail_category.name
        FROM product, product_category, detail_category 
        Where product.id = product_category.idProduct AND product_category.idCategory = detail_category.id AND product.id='.$id);
        return $category;
    }
    public static function getImageProduct($id){
        $image = DB::select('SELECT * FROM image_product Where idProduct ='.$id.' ORDER BY status="off"');
        return $image;
    }
    public static function getAmountProductBySize($id, $size){
        if($size=='free'){
            $res = DB::select('SELECT amount from warehouse where idProduct='.$id);
        }else{
            $res = DB::select('SELECT amount from warehouse where idProduct='.$id.' AND size="'.$size.'"');
        }
        $amount = $res[0]->amount;
        return $amount;
    }
    public static function getSizetypeProduct($id){
        $size = DB::select('SELECT sizetype from product where id='.$id);
        return $size[0]->sizetype;
    }
    public static function deleteAmountProduct($id){
        DB::table('warehouse')->where('idProduct', $id)->delete();
    }
    public static function addAmountProductBySizetype($id, $sizetype){
        if($sizetype=='word'){
            DB::table('warehouse')->insert(['idProduct' => $id, 'size' => 's', 'amount' => 0]);
            DB::table('warehouse')->insert(['idProduct' => $id, 'size' => 'm', 'amount' => 0]);
            DB::table('warehouse')->insert(['idProduct' => $id, 'size' => 'l', 'amount' => 0]);
            DB::table('warehouse')->insert(['idProduct' => $id, 'size' => 'xl', 'amount' => 0]);
        } else if($sizetype=='number1'){
            for($i=29;$i<=36;$i++){
                DB::table('warehouse')->insert(['idProduct' => $id, 'size' => $i, 'amount' => 0]);
            }
        } else if($sizetype=='number2'){
            for($i=40;$i<=43;$i++){
                DB::table('warehouse')->insert(['idProduct' => $id, 'size' => $i, 'amount' => 0]);
            }
        } else if($sizetype=='free'){
            DB::table('warehouse')->insert(['idProduct' => $id, 'size' => 'freesize', 'amount' => 0]);
        }
    }
    public static function updateProduct($id, $name, $price, $status, $sizetype){
        DB::table('product')->where('id', $id)->update(['name' => $name, 'price' => $price, 'status' => $status, 'sizetype' => $sizetype]);
    }
    public static function addProduct($name, $price, $status, $sizetype){
        DB::table('product')->insert(['name' => $name, 'price' => $price, 'image' => '', 'status' => $status, 'sizetype' => $sizetype]);
        $p = DB::select('SELECT * FROM product WHERE id=(SELECT MAX(id) FROM product)');
        return $p[0]->id;
    }
    public static function updateProduct_Category($id, $category){
        DB::table('product_category')->where('idProduct', $id)->delete();
        if(!empty($category)){
            for($i=0;$i<count($category);$i++){
                DB::table('product_category')->insert(['idProduct' => $id, 'idCategory' => $category[$i]]);
                $c = DB::select('SELECT * from detail_category where id="'.$category[$i].'"');
                if(count($c)>0){
                    $t = $c[0]->idCategory;
                    $check = DB::select('SELECT * from product_category where idProduct='.$id.' AND idCategory="'.$t.'"');
                    if(count($check)==0) {
                        DB::table('product_category')->insert(['idProduct' => $id, 'idCategory' => $t]);
                    }
                }
            }
        }   
    }
    public static function addProduct_Category($id, $category){
        if(!empty($category)){
            for($i=0;$i<count($category);$i++){
                DB::table('product_category')->insert(['idProduct' => $id, 'idCategory' => $category[$i]]);
                $c = DB::select('SELECT * from detail_category where id="'.$category[$i].'"');
                if(count($c)>0){
                    $t = $c[0]->idCategory;
                    $check = DB::select('SELECT * from product_category where idProduct='.$id.' AND idCategory="'.$t.'"');
                    if(count($check)==0) {
                        DB::table('product_category')->insert(['idProduct' => $id, 'idCategory' => $t]);
                    }
                }
            }
        }   
    }
    public static function admin_setImageProduct_MainSub($id, $image){
        DB::table('product')->where('id', $id)->update(['image' => '']);
        DB::table('image_product')->insert(['idProduct' => $id, 'image' => $image, 'status' => 'on']);
    }
    public static function admin_setImageProduct_SubMain($id, $image){
        DB::table('image_product')->where('idProduct', $id)->where('image', $image)->delete();
        $mainImg = DB::select('SELECT image from product where id='.$id);
        if($mainImg[0]->image!=''){
            DB::table('image_product')->insert(['idProduct' => $id, 'image' => $mainImg[0]->image, 'status' => 'on']);
        }
        DB::table('product')->where('id', $id)->update(['image' => $image]);
    }
    public static function admin_setImageProduct_TurnOffMain($id, $image){
        DB::table('product')->where('id', $id)->update(['image' => '']);
        DB::table('image_product')->insert(['idProduct' => $id, 'image' => $image, 'status' => 'off']);
    }
    public static function admin_setImageProduct_TurnOffSub($id, $image){
        DB::table('image_product')->where('idProduct', $id)->where('image', $image)->update(['status' => 'off']);
    }
    public static function admin_setImageProduct_TurnOnSub($id, $image){
        DB::table('image_product')->where('idProduct', $id)->where('image', $image)->update(['status' => 'on']);
    }
    public static function admin_setImageProduct_DeleteMain($id){
        DB::table('product')->where('id', $id)->update(['image' => '']);
    }
    public static function admin_setImageProduct_DeleteSub($id, $image){
        DB::table('image_product')->where('idProduct', $id)->where('image', $image)->delete();
    }
    public static function admin_addImageProduct($id, $image){
        DB::table('image_product')->insert(['idProduct' => $id, 'image' => $image, 'status' => 'off']);
    }
    public static function getAmountProduct($id){
        $amount = DB::select('SELECT * FROM warehouse Where idProduct='.$id);
        return $amount;
    }
    public static function updateAmountProduct($idProduct, $size, $amount){
        DB::table('warehouse')->where('idProduct', $idProduct)->where('size', $size)->update(['amount' => $amount]);
    }
    public static function getIDnewProduct(){
        $p = DB::select('SELECT * FROM product WHERE id=(SELECT MAX(id) FROM product)');
        return $p[0]->id;
    }
    public static function deleteProduct($id){
        $product = DB::select('SELECT * FROM product Where id ='.$id);
        DB::table('product_delete')->insert(['id' => $id, 'name' => $product[0]->name, 'price' => $product[0]->price, 'image' => $product[0]->image, 'status' => $product[0]->status, 'sizetype' => $product[0]->sizetype]);
        DB::table('product')->where('id', $id)->delete();
    }
    public static function order($id, $size, $amount){
        $qty = DB::select('SELECT * FROM warehouse Where idProduct ='.$id.' AND size="'.$size.'"');
        $a = $qty[0]->amount-$amount;
        DB::table('warehouse')->where('idProduct', $id)->where('size', $size)->update(['amount' => $a]);
    }
}
