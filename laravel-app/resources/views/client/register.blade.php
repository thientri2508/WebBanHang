<?php
    if(Session::has('userloggin')) {
        echo '<script>location.replace("/account");</script>';
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 80px">
    <div class="content">
        <div style="width: 100%; height: 720px">
            <div style="width: 44%; height: 100%; float: left; margin-left: 75px; border-right: 0.5px solid #ccc">
                <img src="{{ asset('storage/register.jpg') }}"  style="width: 70%; margin-top: 80px">
            </div>
            <div style="width: 44%; height: 80%; float: right; margin-right: 75px; position: relative;">
                <div style="width: 88%; height: 100%; margin-left: 100px; margin-top: 80px; ">
                    
                    <form role="form" action="/save_account" method="POST">
                        {{ csrf_field() }}
                    <div id="kt" style="position:absolute; width:77%; height:20px; top:35px; left:100px;color:gray; font-style: italic"></div>
                    <input class="form-control inputRegister" name="firstname" id="firstname" type="text" placeholder="Họ">
                    <input class="form-control inputRegister" name="lastname" id="lastname" type="text" placeholder="Tên">
                    <input class="form-control inputRegister" name="email" id="email" type="text" placeholder="Email">
                    <input class="form-control inputRegister" name="password" id="password" type="password" placeholder="Mật khẩu">
                    <input class="form-control inputRegister" name="checkpassword" id="checkpassword" type="password" placeholder="Xác nhận mật khẩu">
                    <input class="register" type="submit" value="ĐĂNG KÝ" onclick="return check();">
                    </form>
                    <a href="/"><div class="titleName" style="margin-top: 35px; font-weight: 500; font-size: 14px"><i class="fa-solid fa-left-long"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quay lại trang chủ</div></a>
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
    </div>
</div>
@endsection