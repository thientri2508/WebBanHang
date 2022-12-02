<?php
    if(!Session::has('userloggin')) {
        echo '<script>location.replace("/");</script>';
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 100px; height: 800px;">
    <div class="content">
        <div style="font-family: monospace; width: 50%; text-align: center; margin: auto; font-size: 42px; font-weight: bold">Thay đổi mật khẩu</div>
        <div style="width: 64px; margin: auto; margin-top: 5px"><img src="/storage/line.png"></div>
        <div style="float: left; width: 20%; height: 100%; margin-top: 50px; margin-left: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">tài khoản</div>
            <a href="/account"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Tài khoản của tôi</div></a>
            <a href="/account/addresses"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Danh sách địa chỉ</div></a>
            <a href="/account/orders"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đơn đặt hàng</div></a>
            <a href="/account/password"><div class="category_account" style="color: #c80204"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đổi mật khẩu</div></a>
        </div>
        <div style="float: right; width: 70%; height: 100%; margin-top: 50px; position: relative">
            <form method="post" action="/save_password" role="form">
                {{ csrf_field() }}
            <div id="kt" style="position:absolute; width:85%; height:20px; top:240px; left:0px; color: gray; font-style: italic; font-size: 14px"></div>
            <input class="form-control inputRegister" style="width: 58%; height: 45px" name="old_pass" id="old_pass" type="password" placeholder="Mật khẩu cũ">
            <input class="form-control inputRegister" style="width: 58%; height: 45px" name="new_pass" id="new_pass" type="password" placeholder="Mật khẩu mới">
            <input class="form-control inputRegister" style="width: 58%; height: 45px" name="checkpass" id="checkpass" type="password" placeholder="Xác nhận mật khẩu mới">
            <input type="submit" class="register" style="width:100px; height:40px; font-size:17px; margin-left: 205px; margin-top:70px" value="Cập Nhật" onclick="return checkPassword();">
            </form>
            <?php
            if(Session::has('message')) {
                $message = Session::get('message');
                echo '<script>document.getElementById("kt").innerHTML="'.$message.'"</script>';
                Session::forget('message');
            }
            ?>
        </div>
    </div>
</div>
@endsection