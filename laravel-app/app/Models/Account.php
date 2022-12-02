<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model
{
    public static function addAccount($data){
        DB::table('account')->insert($data);
    }
    public static function checkEmail($email){
        $check = DB::select('SELECT * FROM account where email="'.$email.'"');
        if(count($check)==0) return true;
        else return false;
    }
    public static function getListAddress($email){
        $list = DB::select('SELECT * FROM address where email="'.$email.'"');
        return $list;
    }
    public static function getProvince(){
        $list = DB::select('SELECT * FROM province');
        return $list;
    }
    public static function getProvinceFromUrl(){
        $json = file_get_contents('https://api.mysupership.vn/v1/partner/areas/province');
        $obj = json_decode($json);
        $list = $obj->results;
        return $list;
    }
    public static function getDistrictByCity($city){
        $district = DB::select('SELECT district._name FROM district,province where province._name="'.$city.'" AND province.id=district._province_id');
        return $district;
    }
    public static function getWard($district, $city){
        $ward = DB::select('SELECT ward._name FROM ward,province,district WHERE province.id=ward._province_id AND district.id=ward._district_id AND province._name="'.$city.'" AND district._name="'.$district.'"');
        return $ward;
    }
    public static function addAddress($data){
        DB::table('address')->insert($data);
    }
    public static function Loggin($email, $password){
        $check = DB::select('SELECT * FROM account WHERE email="'.$email.'" AND password="'.$password.'" AND role="user"');
        if(count($check)==1) return true;
        else return false;
    }
    public static function getAccount($email){
        $list = DB::select('SELECT * FROM account WHERE email="'.$email.'"');
        $data = array();
        $data['fullname'] = $list[0]->fullname;
        $data['email'] = $list[0]->email;
        $data['password'] = $list[0]->password;
        $data['role'] = $list[0]->role;
        $data['address'] = $list[0]->address;
        $data['city'] = $list[0]->city;
        $data['district'] = $list[0]->district;
        $data['ward'] = $list[0]->ward;
        $data['phone'] = $list[0]->phone;
        return $data;
    }
    public static function updateAddress($city, $district, $ward, $address, $phone, $userloggin){
        if($userloggin['address']==""){
            DB::table('account')->where('email', $userloggin['email'])->update(['address' => $address, 'city' => $city, 'district' => $district, 'ward' => $ward, 'phone' => $phone]);
            DB::table('address')->where('email', $userloggin['email'])->where('address',$address)->where('city',$city)->where('district',$district)->where('ward',$ward)->where('phone',$phone)->delete();
        }else{
            DB::table('account')->where('email', $userloggin['email'])->update(['address' => $address, 'city' => $city, 'district' => $district, 'ward' => $ward, 'phone' => $phone]);
            DB::table('address')->where('email', $userloggin['email'])->where('address',$address)->where('city',$city)->where('district',$district)->where('ward',$ward)->where('phone',$phone)->delete();
            DB::table('address')->insert(['email' => $userloggin['email'], 'address' => $userloggin['address'], 'city' => $userloggin['city'], 'district' => $userloggin['district'], 'ward' => $userloggin['ward'], 'phone' => $userloggin['phone']]);
        }
    }
    public static function deleteAddress($city, $district, $ward, $address, $phone, $email){
        DB::table('address')->where('email', $email)->where('address',$address)->where('city',$city)->where('district',$district)->where('ward',$ward)->where('phone',$phone)->delete();
    }
    public static function savePassword($password, $email){
        DB::table('account')->where('email', $email)->update(['password' => $password]);
    }
    public static function checkLogginAdmin($email, $password){
        $check = DB::select('SELECT * FROM account WHERE email="'.$email.'" AND password="'.$password.'" AND role="admin"');
        if(count($check)==0) return false;
        else return true;
    }
}