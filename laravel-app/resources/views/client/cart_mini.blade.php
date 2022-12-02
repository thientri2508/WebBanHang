<?php
use App\Http\Controllers\ProductController;
$tt = 0;
echo '<div class="title_cart">Giỏ hàng</div>
        <div id="cart_content">';
if(Session::has('mycart')) {
    $mycart = Session::get('mycart');
    if(count($mycart)>0){
        foreach($mycart as $sp){
        $product = ProductController::getProduct($sp[0]);
        $tt+=($product[0]->price*$sp[2]);
        echo '<div class="ItemCartMini">
                <div style="width: 18%; height: 82%; float: left; margin-left: 5px">
                    <img src="/storage/'.$product[0]->image.'" style="width:100%; height:100%" >    
                </div>
                <div style="width: 50%; height: 82%; float: left; margin-left: 20px">
                    <div style="font-size: 12px">'.$product[0]->name.'</div>
                    <div style="color: #677279; font-size: 12px; margin-top: 3px; text-transform: uppercase">'.$sp[1].'</div>
                    <div class="box">'.$sp[2].'</div>
                </div>
                <div style="width: 20%; height: 82%; float: right; margin-right: 5px">
                    <div style="clear:both; float: right; font-size: 13px; margin-top: 30px"><b>'.number_format($product[0]->price).'₫</b></div>
                </div>
            </div>';
        }
        if(count($mycart)==2) {
            echo '<script>document.getElementById("cart_content").style.height="255px"</script>';
        } else if(count($mycart)>=3) {
            echo '<script>document.getElementById("cart_content").style.height="380px"</script>';
        }
    }else{
        echo '<div style="width: 50px; height: 50px; margin: auto; margin-top: 20px">
                <img src="/storage/shopping-cart.png" style="width: 100%; height: 100%;">
            </div>
            <div style="width: 50%; margin: auto; text-align: center; font-size: 11px; color: #677279; margin-top: 20px">Hiện chưa có sản phẩm</div>';
    }
}else {
    echo '<div style="width: 50px; height: 50px; margin: auto; margin-top: 20px">
            <img src="/storage/shopping-cart.png" style="width: 100%; height: 100%;">
        </div>
        <div style="width: 50%; margin: auto; text-align: center; font-size: 11px; color: #677279; margin-top: 20px">Hiện chưa có sản phẩm</div>';
}
echo '</div>
<div style="width: 92%; margin: auto; height: 40px; margin-top: 20px">
    <div style="float: left; color: #677279; font-size: 12px;">TỔNG TIỀN:</div>
    <div style="float: right; font-weight: 600; font-size: 16px; color: red;">'.number_format($tt).'₫</div>
</div>
<div style="width: 92%; margin: auto; height: 45px; margin-bottom:20px">
    <a href="/cart"><div class="view_cart" style="float: left">XEM GIỎ HÀNG</div></a>
    <a href="/payment"><div class="view_cart" style="float: right">THANH TOÁN</div></a>
</div>';
?>