<?php
    if(Session::has('userloggin')) {
        $userloggin = Session::get('userloggin');
    } else {
        echo '<script>location.replace("/");</script>';
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 100px" id="ctn">
    
    <div class="content">
        <div style="font-family: monospace; width: 50%; text-align: center; margin: auto; font-size: 42px; font-weight: bold">Chi tiết đơn hàng</div>
        <div style="width: 64px; margin: auto; margin-top: 5px"><img src="/storage/line.png"></div>
        <div style="float: left; width: 20%; height: 400px; margin-top: 50px; margin-left: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">tài khoản</div>
            <a href="/account"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Tài khoản của tôi</div></a>
            <a href="/account/addresses"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Danh sách địa chỉ</div></a>
            <a href="/account/orders"><div class="category_account" style="color: #c80204"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đơn đặt hàng</div></a>
            <a href="/account/password"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đổi mật khẩu</div></a>
        </div>
        <div style="float: right; width: 70%; margin-top: 50px; position: relative"> 
            <a href="/account/orders"><i class="fa-solid fa-chevron-left fa-2x back"></i></a>
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">trạng thái đơn hàng</div>
            <div class="progress" style="width: 80%; margin-top: 15px">
            <?php
            if(Session::has('userloggin')) {
                $userloggin = Session::get('userloggin');
                if($order[0]->status=='Unconfimred'||$order[0]->status=='Cancel') {
                echo '<div class="progress-bar" role="progressbar" aria-label="Basic example"></div>';
                } else if($order[0]->status=='Confimred') {
                    echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 33%"></div>';
                } else if($order[0]->status=='Delivering'){
                    echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 66%"></div>';
                } else echo '<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%"></div>'; 
            }
            ?>
            </div>
            <div style="width: 80%; margin-top: 15px; position: relative;; margin-bottom: 70px">
                <?php
                if($order[0]->status=='Unconfimred') {
                    echo '<div style="position: absolute; left: 0px">Chưa xác nhận</div>';
                } else if($order[0]->status=='Cancel') {
                    echo '<div style="position: absolute; left: 0px">Đã hủy</div>';
                } else if($order[0]->status=='Confimred') {
                    echo '<div style="position: absolute; left: 0px">Chưa xác nhận</div>';
                    echo '<div style="position: absolute; left: 27%">Đã xác nhận</div>';
                } else if($order[0]->status=='Delivering'){
                    echo '<div style="position: absolute; left: 0px">Chưa xác nhận</div>';
                    echo '<div style="position: absolute; left: 27%">Đã xác nhận</div>';
                    echo '<div style="position: absolute; left: 58%">Đang giao hàng</div>';
                } else {
                    echo '<div style="position: absolute; left: 0px">Chưa xác nhận</div>';
                    echo '<div style="position: absolute; left: 27%">Đã xác nhận</div>';
                    echo '<div style="position: absolute; left: 58%">Đang giao hàng</div>';
                    echo '<div style="position: absolute; right: -40px">Hoàn thành</div>';  
                }
                ?>
            </div>
                <?php
                if($order[0]->status=='Unconfimred'||$order[0]->status=='Confimred') {
                    echo '<button type="button" class="btn btn-danger" style="width: 140px; font-weight: bold" onclick="cancelOrder('.$order[0]->OrderID.')">Hủy đơn hàng</button>';
                } 
                ?>
            <div style="text-transform: uppercase; margin-bottom: 20px; font-size: 15px; letter-spacing: 1px; font-weight: bold; margin-top: 60px">thông tin đơn hàng</div>
            <div style="margin-top: 10px"><b>Tên khách hàng:</b> <?php echo $userloggin['fullname'] ?></div>
            <div style="margin-top: 10px"><b>Địa chỉ giao hàng:</b>  <?php echo $order[0]->delivery_address; ?></div>
            <div style="margin-top: 10px"><b>Ngày đặt hàng:</b> <?php echo $order[0]->DateOrder ?></div>
            <div style="width: 100%; margin-top: 10px" id="item">
                <?php
                for($i=0;$i<count($detail_order);$i++){
                    echo '<div style="width: 100%; height: 100px; background: #f7f7f7; margin-top: 30px">
                            <div style="width: 10%; float: left; height: 100%">
                                <img src="/storage/'.$list_product_order[$i]->image.'" style="width: 100%; height: 100%">
                            </div>
                            <div style="width: 40%; float: left; height: 100%; margin-left: 20px">
                                <div style="margin-top: 20px"><i>'.$list_product_order[$i]->name.'</i></div>
                                <div style="margin-top: 10px"><i>'.$detail_order[$i]->price.' ₫</i></div>
                            </div>
                            <div style="width: 12%; float: left; height: 100%; margin-left: 30px">
                                <div style="margin-top: 20px; text-transform: uppercase"><i>Size: '.$detail_order[$i]->size.'</i></div>
                                <div style="margin-top: 10px"><i>Số lượng: '.$detail_order[$i]->amount.'</i></div>
                            </div>
                            <div style="width: 29%; float: right; height: 100%; margin-right:15px">
                                <div style="margin-top: 40px; float: right"><b>Tổng tiền: '.number_format($detail_order[$i]->total).'₫</b></div>
                            </div>
                        </div>';
                }
                ?>
            </div>
            <div style="margin-top: 50px; float: right;"><b>Thành tiền:</b> <?php echo number_format($order[0]->total) ?> ₫</div>
        </div>
    </div>
</div>
<script>
    var height = $('#item').height();
    height+=770;    
    document.getElementById("ctn").style.height=height+"px";
</script>
@endsection