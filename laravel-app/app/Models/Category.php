<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    public static function getListAll(){
        $list = DB::select('SELECT * FROM category WHERE sort!=0 Order By sort');
        return $list;
    }
    public static function getList(){
        $list = DB::select('SELECT * FROM category');
        return $list;
    }
    public static function getAmount(){
        $list = DB::select('SELECT * FROM category WHERE sort != 0');
        return count($list);
    }
    public static function getName($idCategory){
        $name = DB::select('SELECT name FROM category Where id="'.$idCategory.'"');
        if(count($name)==0){
            $name = DB::select('SELECT name FROM detail_category Where id="'.$idCategory.'"');
            return $name[0]->name;
        } else {
            return $name[0]->name;
        }
    }
    public static function checkNameCategory($name){
        $check = DB::select('SELECT * FROM category where id="'.$name.'"');
        if(count($check)==0) return true;
        else return false;
    }
    public static function addCategory($id, $name){
        $count = DB::select('SELECT * FROM category');
        $sort = count($count) + 1;
        DB::table('category')->insert(['id' => $id, 'name' => $name, 'sort' => $sort]);
    }
    public static function updateCategory($id, $name, $newid, $sort){
        if($sort=="0"){
            DB::table('category')->where('id', $id)->update(['id' => $newid, 'name' => $name, 'sort' => $sort]);
        } else if($sort=="appear"){
            $listCategory = DB::select('SELECT * FROM category WHERE sort!=0');
            $amountCategory = count($listCategory) + 1;
            DB::table('category')->where('id', $id)->update(['id' => $newid, 'name' => $name, 'sort' => $amountCategory]);
        } else{
            $oldsort = DB::select('SELECT sort FROM category where id="'.$id.'"');
            DB::table('category')->where('sort', $sort)->update(['sort' => $oldsort[0]->sort]);
            DB::table('category')->where('id', $id)->update(['id' => $newid, 'name' => $name, 'sort' => $sort]);
        }  
    }
    public static function getCategoryById($id){
        $category = DB::select('SELECT * FROM category WHERE id="'.$id.'"');
        return $category[0];
    }
    public static function deleteCategory($id){
        DB::table('category')->where('id', $id)->delete();
    }
    public static function checkCategory($id){
        $list = DB::select('SELECT * FROM detail_category WHERE idCategory="'.$id.'"');
        if(count($list)==0) return true;
        return false;
    }
    public static function getCategoryByIDProduct($id){
        $list = DB::select('SELECT * FROM product_category WHERE idProduct='.$id);
        return $list;
    }
}
