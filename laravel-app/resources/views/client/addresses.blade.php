<?php
    use App\Http\Controllers\AccountController;
    
    if(!Session::has('userloggin')) {
        echo '<script>location.replace("/");</script>';
    } else {
        $userloggin = Session::get('userloggin');
        $list_address = AccountController::getListAddress($userloggin['email']);
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 100px; height: 800px;">
    <div class="content">
        <div style="font-family: monospace; width: 50%; text-align: center; margin: auto; font-size: 42px; font-weight: bold">Thông tin địa chỉ</div>
        <div style="width: 64px; margin: auto; margin-top: 5px"><img src="/storage/line.png"></div>
        <div style="float: left; width: 20%; height: 100%; margin-top: 50px; margin-left: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">tài khoản</div>
            <a href="/account"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Tài khoản của tôi</div></a>
            <a href="/account/addresses"><div class="category_account" style="color: #c80204"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Danh sách địa chỉ</div></a>
            <a href="/account/orders"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đơn đặt hàng</div></a>
            <a href="/account/password"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đổi mật khẩu</div></a>
        </div>
        <div style="float: right; width: 70%; height: 100%; margin-top: 50px">
            <div style="width: 55%; height: 500px; float: left">
                <div style="font-size: 15px; margin-bottom: 5px; letter-spacing: 1px; font-weight: bold">Địa chỉ giao hàng mặc định</div>
                <div style="font-size: 14px; margin-bottom: 30px; width: 85%">
                <?php if(Session::has('userloggin')) {
                    if($userloggin['address']=="") echo '<i style="color: gray">Bạn chưa thiết lập địa chỉ giao hàng mặc định</i>';
                    else echo 'Tỉnh/Thành Phố: '.$userloggin["city"].', Quận/Huyện: '.$userloggin["district"].', Phường/Xã: '.$userloggin["ward"].', Địa Chỉ: '.str_replace('-','/',$userloggin["address"]).', Số Điện Thoại: '.$userloggin["phone"];
                 } ?>
                </div>
                <div style="font-size: 15px; letter-spacing: 1px; font-weight: bold">Địa chỉ giao hàng của tôi</div>
                <div style="width: 85%; height: 400px; overflow-y:scroll; margin-top: 10px">
                    <?php
                    if(Session::has('userloggin')) {
                        if(count($list_address)==0) echo '<i style="color: gray; font-size: 14px">Bạn chưa thêm địa chỉ giao hàng nào</i>';
                        else{   
                            foreach($list_address as $l)
                            {
                                echo '<div style="width:100%">
                                        <p style="font-size:14px; width:70%; float:left">';
                                            echo 'Tỉnh/Thành Phố: '.$l->city.'</br>';
                                            echo 'Quận/Huyện: '.$l->district.'</br>';
                                            echo 'Phường/Xã: '.$l->ward.'</br>';
                                            echo 'Địa Chỉ: '.str_replace('-','/',$l->address).'</br>';
                                            echo 'Số Điện Thoại: '.$l->phone.'</br>';
                                        echo '</p>
                                        <div style="width:30%; float:right">
                                            <a href="/select_address/'.$l->city.'/'.$l->district.'/'.$l->ward.'/'.$l->address.'/'.$l->phone.'"><p class="addr"><i>Đặt làm mặc định</i></p></a>
                                            <a href="/delete_address/'.$l->city.'/'.$l->district.'/'.$l->ward.'/'.$l->address.'/'.$l->phone.'"><p class="addr"><i>Xóa địa chỉ</i></p></a>
                                        </div>
                                </div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div style="width: 45%; height: 500px; float: right; position: relative;">
                <div style="font-size: 15px; margin-bottom: 5px; letter-spacing: 1px; font-weight: bold">Thêm địa chỉ giao hàng</div>
                <form method="post" action="/save_address" role="form">
                {{ csrf_field() }}
                <select class="form-select" aria-label="Default select example" style="width:85%; margin-top:35px" id="city" name="city" onchange="selectCity()">
                    <option selected>Tỉnh/Thành Phố</option>
                    <?php
                    $province = AccountController::getProvince();
                    foreach($province as $t){
			            echo '<option>'.$t->_name.'</option>';
			        }
                    ?>
                </select>
                <div id="kt" style="position:absolute; width:85%; height:20px; top:410px; left:0px; color: gray; font-style: italic; font-size: 14px"></div>	
                <select class="form-select" aria-label="Default select example" id="district" name="district" onchange="selectDistrict()" style="width:85%; margin-top:35px">
                    <option selected>Quận/Huyện</option>
                </select>
                <select class="form-select" aria-label="Default select example" id="ward" name="ward" style="width:85%; margin-top:35px">
                    <option selected>Phường/Xã</option>
                </select>
                <div class="input-group mb-3" style="width:85%; margin-top:35px">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="txtaddress" id="txtaddress" placeholder="Địa chỉ"   /> 
                </div>
                <div class="input-group mb-3" style="width:85%; margin-top:35px">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="phone" id="phone" placeholder="Số điện thoại"   /> 
                </div>
                <input type="submit" class="register" style="width:100px; height:40px; font-size:17px; margin-top:70px" value="Lưu Lại" onclick="return checkAddr();">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection