@extends('client.layout')

@section('content')
<div style="width: 100%; background: #f8f8f8; height: 40px; margin-top: 80px">
    <div style="width: 1250px; margin: auto; height: 100%; line-height: 40px">
        <div style="color: #333; font-size: 13px; float: left;">HoDi</div>
        <div style="color: #333; font-size: 13px; float: left; margin-left: 10px; margin-right: 10px">/</div>
        <div style="color: #333; font-size: 13px; float: left; text-transform: capitalize">Giỏ hàng</div>
    </div>
</div>  
<div class="container" style="height: 550px" id="ctn">
    <div class="content">
        <div style="width: 100%;">
            <?php
                use App\Http\Controllers\ProductController;
                $total = 0;
                $qtyItem = 0;
                if(Session::has('mycart')) {
                    $mycart = Session::get('mycart');
                    $qtyItem = count($mycart);
                    foreach($mycart as $sp){
                        $product = ProductController::getProduct($sp[0]);
                        $total+=($product[0]->price*$sp[2]);
                    } 
                }
            ?>
            <div style="font-size: 30px;color: #252a2b; width: 50%; margin: auto; text-align: center; margin-top: 30px">Giỏ hàng của bạn</div>
            <div style="font-size: 14px;color: #252a2b; width: 50%; margin: auto; text-align: center; margin-top: 5px">Có <?php echo $qtyItem; ?> sản phẩm trong giỏ hàng</div>
            <div style="width: 100%; margin-top: 20px">
                <div style="float: left; width: 65%" id="act">

                @include('client.list_cart')
                    
                </div>
                <div style="float: right; width: 35%">
                    <div style="width: 100%; height: 100%; border: 1px solid #e1e3e4; border-radius: 2px;">
                        <div style="font-size: 18px; font-weight: bold; width: 93%; margin: auto; margin-top: 25px">Thông tin đơn hàng</div>
                        <div style="width: 93%; margin: auto; margin-top: 15px; border-top: 1px dotted #dfe0e1; border-bottom: 1px dotted #dfe0e1; height: 60px; line-height: 60px">
                            <div style="float: left; font-size: 16px; color: #5c5c5c; font-weight: bold">Tổng tiền:</div>
                            <div style="float: right; color: #c80204; font-weight: bold; font-size: 22px;" id="total"><?php echo number_format($total); ?>₫</div>
                        </div>
                        <div style="font-size: 12px; width: 93%; margin: auto; margin-top: 20px">Phí vận chuyển sẽ được tính ở trang thanh toán.</div>
                        <div style="font-size: 12px; width: 93%; margin: auto; margin-top: 5px">Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</div>
                        <a href="/payment"><div class="pay">THANH TOÁN</div></a>
                        <a href="/collections/hang-moi/trang-1"><div style="width: 50%; margin: auto; margin-top: 15px; text-align: center; cursor: pointer; font-size: 12px; margin-bottom: 20px"><img src="/storage/back.png">&nbsp;&nbsp;Tiếp tục mua hàng</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var height = $('#act').height();
    if(height>340){
        height+=180;
        document.getElementById("ctn").style.height=height+"px";
    }
</script>
@endsection