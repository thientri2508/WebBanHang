<?php
    if(Session::has('userloggin')) {
        $userloggin = Session::get('userloggin');
    } else {
        echo '<script>location.replace("/");</script>';
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 100px; height: 580px;">
    <div class="content">
        <div style="font-family: monospace; width: 50%; text-align: center; margin: auto; font-size: 42px; font-weight: bold">Tài khoản của bạn</div>
        <div style="width: 64px; margin: auto; margin-top: 5px"><img src="/storage/line.png"></div>
        <div style="float: left; width: 20%; height: 400px; margin-top: 50px; margin-left: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">tài khoản</div>
            <a href="/account"><div class="category_account" style="color: #c80204"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Tài khoản của tôi</div></a>
            <a href="/account/addresses"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Danh sách địa chỉ</div></a>
            <a href="/account/orders"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đơn đặt hàng</div></a>
            <a href="/account/password"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đổi mật khẩu</div></a>
        </div>
        <div style="float: right; width: 70%; height: 400px; margin-top: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">thông tin tài khoản</div>
            <hr style="margin-top: -20px; width: 100%">
            <div style="font-size: 14px; margin-bottom: 12px;"><?php if(Session::has('userloggin')) echo $userloggin['fullname'] ?></div>
            <div style="font-size: 14px; margin-bottom: 25px;"><?php if(Session::has('userloggin')) echo $userloggin['email'] ?></div>
            <div style="font-size: 16px; margin-bottom: 5px;">Địa chỉ giao hàng mặc định</div>
            <div style="font-size: 14px; margin-bottom: 12px;">
            <?php if(Session::has('userloggin')){
                if($userloggin['address']=="") echo '<i style="color: gray">Bạn chưa thiết lập địa chỉ giao hàng mặc định</i>';
                else echo 'Tỉnh/Thành Phố: '.$userloggin["city"].', Quận/Huyện: '.$userloggin["district"].', Phường/Xã: '.$userloggin["ward"].', Địa Chỉ: '.str_replace('-','/',$userloggin["address"]).', Số Điện Thoại: '.$userloggin["phone"];
            }
             ?>
            </div>
        </div>
    </div>
</div>
@endsection