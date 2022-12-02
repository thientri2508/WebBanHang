<?php
    if(Session::has('userloggin')) {
        $userloggin = Session::get('userloggin');
    } else {
        echo '<script>location.replace("/");</script>';
    }
?>
@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 100px; height: 660px;">
    <div class="content">
        <div style="font-family: monospace; width: 50%; text-align: center; margin: auto; font-size: 42px; font-weight: bold">Danh sách đơn hàng</div>
        <div style="width: 64px; margin: auto; margin-top: 5px"><img src="/storage/line.png"></div>
        <div style="float: left; width: 20%; height: 400px; margin-top: 50px; margin-left: 50px">
            <div style="text-transform: uppercase; margin-bottom: 30px; font-size: 15px; letter-spacing: 1px; font-weight: bold">tài khoản</div>
            <a href="/account"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Tài khoản của tôi</div></a>
            <a href="/account/addresses"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Danh sách địa chỉ</div></a>
            <a href="/account/orders"><div class="category_account" style="color: #c80204"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đơn đặt hàng</div></a>
            <a href="/account/password"><div class="category_account"><i class="fa-regular fa-circle-dot"></i>&nbsp;&nbsp;&nbsp;Đổi mật khẩu</div></a>
        </div>
        <div style="float: right; width: 70%; margin-top: 50px; height: 400px; overflow-y: scroll">
            <?php
            use App\Http\Controllers\OrderController;
            if(Session::has('userloggin')) {
                $list = OrderController::getOrderByEmail($userloggin['email']);
                if (count($list)==0) {
                    echo '<div style="font-size: 14px">Bạn chưa đặt mua sản phẩm.</div>';
                }else{
                    foreach ($list as $l) {
                    $status = '';
                    echo '<div style="width: 100%; height: 80px; background: #f7f7f7; margin-bottom: 30px">
                            <div style="width: 28%; float: left; margin-top: 20px; margin-left: 30px">
                                <div style="font-size: 14px">Ngày đặt hàng</div>
                                <div style="font-size: 14px"><b>'.$l->DateOrder.'</b></div>
                            </div>
                            <div style="width: 28%; float: left; margin-top: 20px">
                                <div style="font-size: 14px">Thành tiền</div>
                                <div style="font-size: 14px"><b>'.number_format($l->total).' ₫</b></div>
                            </div>
                            <div style="width: 20%; float: left; margin-top: 20px">
                                <div style="font-size: 14px">Trạng thái đơn hàng</div>';
                    if($l->status=='Unconfimred') $status = 'Chưa xác nhận';
                    else if ($l->status=='Confimred') $status = 'Đã xác nhận';    
                    else if ($l->status=='Delivering') $status = 'Đang giao hàng'; 
                    else if ($l->status=='Complete') $status = 'Hoàn thành';     
                    else if ($l->status=='Cancel') $status = 'Đã hủy';   
                    echo '      <div style="font-size: 14px"><b>'.$status.'</b></div>
                            </div>
                            <div style="width: 15%; float: right; margin-top: 30px">
                                <a href="/account/order_detail/'.$l->OrderID.'"><div class="detailOrder">Xem chi tiết</div></a>
                            </div>
                        </div>';
                    }
                }
            }
            ?>
            
        </div>
    </div>
</div>
@endsection