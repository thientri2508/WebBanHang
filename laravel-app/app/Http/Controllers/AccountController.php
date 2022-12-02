<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Account;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AccountController extends Controller
{
    public function addAccount(Request $request){
        if(Account::checkEmail($request->email)) {
            $data = array();
            $data['fullname'] = $request->firstname." ".$request->lastname;
            $data['email'] = $request->email;
            $data['password'] = md5($request->password);
            $data['role'] = "user";
            $data['address'] = "";
            $data['city'] = "";
            $data['district'] = "";
            $data['ward'] = "";
            $data['phone'] = "";
            Account::addAccount($data);
            Session::put('userloggin',$data);
            return Redirect::to('/account');
        }else{
            Session::put('message','Email này đã tồn tại');
            return Redirect::to('/account/register');
        }
    }
    public static function getListAddress($email){
        $list = Account::getListAddress($email);
        return $list;
    }
    public static function getProvince(){
        $list = Account::getProvince();
        return $list;
    }
    public static function getProvinceFromUrl(){
        $list = Account::getProvinceFromUrl();
        return $list;
    }
    public function selectCity($city){
        if($city!='Tỉnh/Thành Phố'){
            $district=Account::getDistrictByCity($city);
            echo '<option selected>Quận/Huyện</option>';
            foreach($district as $d){
                echo '<option>'.$d->_name.'</option>';
            }
        }else{
            echo '<option selected>Quận/Huyện</option>';
        }
    }
    public function selectDistrict($district, $city){
        if($district!='Quận/Huyện'){
            $ward=Account::getWard($district, $city);
            echo '<option selected>Phường/Xã</option>';
            foreach($ward as $w){
                echo '<option>'.$w->_name.'</option>';
            }
        }else{
            echo '<option selected>Phường/Xã</option>';
        }
    }
    public function addAddress(Request $request){
        $userloggin = Session::get('userloggin');
        $data = array();
        $data['email'] = $userloggin['email'];
        $data['address'] = str_replace('/','-',$request->txtaddress);
        $data['city'] = $request->city;
        $data['district'] = $request->district;
        $data['ward'] =$request->ward;
        $data['phone'] = $request->phone;
        Account::addAddress($data);
        return Redirect::to('/account/addresses');
    }
    public function savePassword(Request $request){
        $userloggin = Session::get('userloggin');
        if(md5($request->old_pass)==$userloggin['password']){
            Account::savePassword(md5($request->new_pass),$userloggin['email']);
        }else{
            Session::put('message','Mật khẩu cũ không đúng');
        }
        return Redirect::to('/account/password');
    }
    public function Loggin(Request $request){
        if(Account::Loggin($request->email_loggin,md5($request->password_loggin))){
            Session::put('userloggin',Account::getAccount($request->email_loggin));
            return Redirect::to('/account');
        }else{
            return Redirect::to('/');
        }
    }
    public function logout(){
        if(Session::has('userloggin')) {
            Session::forget('userloggin');
        }
        return Redirect::to('/');
    }
    public function updateAddress($city, $district, $ward, $address, $phone){
        $userloggin = Session::get('userloggin');
        Account::updateAddress($city, $district, $ward, $address, $phone, $userloggin);
        $userloggin['address'] = $address;
        $userloggin['city'] = $city;
        $userloggin['district'] = $district;
        $userloggin['ward'] = $ward;
        $userloggin['phone'] = $phone;
        Session::put('userloggin',$userloggin);
        return Redirect::to('/account/addresses');
    }
    public function deleteAddress($city, $district, $ward, $address, $phone){
        $userloggin = Session::get('userloggin');
        Account::deleteAddress($city, $district, $ward, $address, $phone, $userloggin['email']);
        return Redirect::to('/account/addresses');
    }
    public function adminLoggin(Request $request){
        if(Account::checkLogginAdmin($request->Username, md5($request->Password))){
            $account = Account::getAccount($request->Username);
            Session::put('adminloggin',$account);
            return Redirect::to('/admin_home');
        }else{
            Session::put('message','Email or Password is incorrect');
            return Redirect::to('/admin');
        }
        
    }
    public function admin_logout(){
        if(Session::has('adminloggin')) {
            Session::forget('adminloggin');
        }
        return Redirect::to('/admin');
    }
}
