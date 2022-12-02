<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Detail_Category;
use Session;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public static function getListAll(){
        $list = Category::getListAll();
        return $list;
    }
    public function create_category(Request $request){
        $nameCategory = $this->vn_to_str($request->categoryName);
        $nameCategory = str_replace( ' ', '-', $nameCategory );
        if(Category::checkNameCategory($nameCategory)) {
            Category::addCategory($nameCategory, $request->categoryName);
            $amountDetail = intval($request->amount_detail);
            if($amountDetail>0){
                for($i=1;$i<=$amountDetail;$i++){
                    $s = 'detail-'.$i;
                    if($request->$s!=''){
                        $idDetailCategory = $this->vn_to_str($request->$s);
                        $idDetailCategory = str_replace( ' ', '-', $idDetailCategory);
                        $nameDetailCategory = $request->$s;
                        Detail_Category::addDetailCategory($idDetailCategory, $nameDetailCategory, $nameCategory);
                    }
                }
            }
            Session::put('message','Success');
            return Redirect::to('/admin/create_category');
        }else{
            Session::put('message','This category name already exists');
            return Redirect::to('/admin/create_category');
        }
    }
    public function install_category(Request $request){
        $nameCategory = $this->vn_to_str($request->categoryName);
        $nameCategory = str_replace( ' ', '-', $nameCategory );
        if($nameCategory!=$request->idCategory){
            if(Category::checkNameCategory($nameCategory)) {
                Category::updateCategory($request->idCategory, $request->categoryName, $nameCategory, $request->sort);
                Detail_Category::delDetailCategoryByidCategory($request->idCategory);
                $amountDetail = intval($request->amount_detail);
                if($amountDetail>0){
                    for($i=1;$i<=$amountDetail;$i++){
                        $s = 'detail-'.$i;
                        if($request->$s!=''){
                            $idDetailCategory = $this->vn_to_str($request->$s);
                            $idDetailCategory = str_replace( ' ', '-', $idDetailCategory);
                            $nameDetailCategory = $request->$s;
                            Detail_Category::addDetailCategory($idDetailCategory, $nameDetailCategory, $nameCategory);
                        }
                    }
                }
                return Redirect::to('/admin/list_category');
            }else{
                Session::put('message','This category name already exists');
                return Redirect::to('/admin/install_category/'.$request->idCategory);
            }
        }else{
            Category::updateCategory($request->idCategory, $request->categoryName, $nameCategory, $request->sort);
            Detail_Category::delDetailCategoryByidCategory($request->idCategory);
            $amountDetail = intval($request->amount_detail);
            if($amountDetail>0){
                for($i=1;$i<=$amountDetail;$i++){
                    $s = 'detail-'.$i;
                    if($request->$s!=''){
                        $idDetailCategory = $this->vn_to_str($request->$s);
                        $idDetailCategory = str_replace( ' ', '-', $idDetailCategory);
                        $nameDetailCategory = $request->$s;
                        Detail_Category::addDetailCategory($idDetailCategory, $nameDetailCategory, $nameCategory);
                    }
                }
            }
            return Redirect::to('/admin/list_category');
        }
    }
    public function delete_category($id){
        Category::deleteCategory($id);
        Detail_Category::deleteDetailCategory($id);
        return Redirect::to('/admin/list_category');
    }
    public static function vn_to_str ($str){
 
        $unicode = array(
         
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
         
        'd'=>'đ',
         
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
         
        'i'=>'í|ì|ỉ|ĩ|ị',
         
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
         
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
         
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
         
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
         
        'D'=>'Đ',
         
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
         
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
         
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
         
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         
        );
         
        foreach($unicode as $nonUnicode=>$uni){
         
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        $t=strtolower($str);
        }
        return $t;
        }
}
