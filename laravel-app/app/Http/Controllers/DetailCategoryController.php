<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_Category;
use Illuminate\Support\Facades\Redirect;

class DetailCategoryController extends Controller
{
    public static function getListAll(){
        $list = Detail_Category::getListAll();
        return $list;
    }
    public function delDetailCategory($idCategory, $idDetailCategory){
        Detail_Category::delDetailCategory($idDetailCategory);
        return Redirect::to('/admin/install_category/'.$idCategory);
    }
}
