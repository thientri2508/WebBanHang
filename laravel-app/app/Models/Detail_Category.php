<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Detail_Category extends Model
{
    public static function getListALL(){
        $list = DB::select('SELECT * FROM detail_category');
        return $list;
    }
    public static function addDetailCategory($id, $name, $idCategory){
        DB::table('detail_category')->insert(['id' => $id, 'name' => $name, 'idCategory' => $idCategory]);
    }
    public static function getDetailCategoryById($id){
        $list = DB::select('SELECT * FROM detail_category WHERE idCategory="'.$id.'"');
        return $list;
    }
    public static function delDetailCategory($id){
        DB::table('detail_category')->where('id', $id)->delete();
    }
    public static function delDetailCategoryByidCategory($id){
        DB::table('detail_category')->where('idCategory', $id)->delete();
    }
    public static function deleteDetailCategory($idCategory){
        DB::table('detail_category')->where('idCategory', $idCategory)->delete();
    }
}
