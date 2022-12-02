@extends('client.layout')

@section('content')
<div class="container" style="margin-top: 130px">
    <div class="content">
        <div style="width:100%; height:950px; margin-bottom: 80px">
            <div style="height:100%; width:60%; float:left">
                <div style="background:#f3f3f3; width:95%; height:47px; font-size:18px; line-height:47px; padding-left:20px"><b>THÔNG TIN GIAO HÀNG</b></div>
                <?php
                if(Session::has('userloggin')) {
                    $userloggin = Session::get('userloggin');
                    echo '
                    <p style="margin-top:30px; margin-left:20px; font-size:16px"><b>HỌ TÊN</b></p>
                    <div class="textinfor">'.$userloggin["fullname"].'</div>
                    <p style="margin-top:30px; margin-left:20px; font-size:16px"><b>Số điện Thoại</b></p>
                    <div class="textinfor">'.$userloggin["phone"].'</div>
                    <p style="margin-top:30px; margin-left:20px; font-size:16px"><b>Email</b></p>
                    <div class="textinfor">'.$userloggin["email"].'</div>
                    <p style="margin-top:30px; margin-left:20px; font-size:16px"><b>Địa chỉ</b></p>
                    <div class="textinfor">Tỉnh/Thành Phố: '.$userloggin["city"].', Quận/Huyện: '.$userloggin["district"].', Phường/Xã: '.$userloggin["ward"].', Địa Chỉ: '.str_replace('-','/',$userloggin["address"]).', Số Điện Thoại: '.$userloggin["phone"].'</div>
                    <a href="/account"><div class="setInfor"><i class="far fa-2x fa-edit"></i>&nbsp;&nbsp;Chỉnh Sửa Thông Tin</div></a>';
                } else {
                    echo '<div style="color:red; margin-left: 25px; margin-top: 30px">Vui lòng đăng nhập tài khoản!</div>';
                }
                ?>
                <div style="background:#f3f3f3; width:95%; height:47px; margin-top:40px; font-feature-settings: 'kern'; font-size:22px; line-height:47px; padding-left:20px"><b>PHƯƠNG THỨC GIAO HÀNG</b></div>
                <div style="margin-top:40px; width:95%; height:40px">
                    <i class="far fa-2x fa-check-square" style="margin-left:20px; float:left"></i>
                    <p style="margin-left:40px; float:left; margin-top:4px">Tốc độ tiêu chuẩn (từ 2 - 5 ngày làm việc)</p>
                    <p style="float:right; margin-top:4px"><b>Miễn Phí</b></p>
                </div>
                <div style="background:#f3f3f3; width:95%; height:47px; margin-top:40px; font-feature-settings: 'kern'; font-size:22px; line-height:47px; padding-left:20px"><b>PHƯƠNG THỨC THANH TOÁN</b></div>
                <div style="margin-top:40px; width:95%; height:40px">
                    <i class="far fa-2x fa-check-square" style="margin-left:20px; float:left"></i>
                    <p style="margin-left:40px; float:left; margin-top:4px">Thanh toán trực tiếp khi giao hàng</p>
                    <img src="https://ananas.vn/wp-content/themes/ananas/fe-assets/images/svg/icon_COD.svg" style="margin-left:30px; margin-top:8px">
                </div>
            </div>
            <div style="height:100%; width:40%; float:right; background:#f3f3f3; position: relative;" >
                <div style="font-size:18px; margin-left:20px; margin-top:15px"><b>ĐƠN HÀNG</b></div>
                <div style="margin-left:20px; width:92%; border-top:solid 2px; margin-top:10px"></div>
                <div style="margin-left:20px; width:89%; height:400px; overflow-y:scroll; margin-top:20px">
                <?php
                use App\Http\Controllers\ProductController;
                $tt=0;
                if(Session::has('mycart')) {
                    $mycart = Session::get('mycart');
                    foreach($mycart as $sp)
                    {
                        $product = ProductController::getProduct($sp[0]);
                        $tt+=($product[0]->price*$sp[2]);
                        echo '<div style="width:100%">
                            <div style="width:100%; height:auto">
                                <div style="float:left; width:60%; font-size:18px; color:#808080"><b>'.$product[0]->name.'</b></div>
                                <div style="float:right; width:40%; font-size:17px; color:#808080"> 
                                    <div style="float:right">'.number_format($product[0]->price).' VND</div>
                                </div>
                            </div>
                            <div style="width:100%">
                                <div style="float:left; width:60%; margin-bottom:20px; font-size:17px; color:#808080; text-transform: uppercase">Size: '.$sp[1].'</div>
                                <div style="float:right; width:40%; margin-bottom:20px; font-size:17px; color:#808080">x '.$sp[2].'</div>
                            </div>
                        </div>';
                    }
                }
                ?>
                </div>
                <div style="width:89%; border-top:dashed 2px; opacity:0.5; margin-top:23px; margin-left:20px"></div>
                <div style="width:89%; margin-left:20px; margin-top:35px; height:30px">
                    <div style="float:left; width:20%; font-size:18px; color:#808080"><b>Đơn hàng</b></div>
                    <div style="float:right; width:80%; font-size:18px; color:#808080">
                        <div style="float:right"><b><?php echo number_format($tt) ?> VND</b></div>
                    </div>
                </div>
                <div style="width:89%; margin-left:20px; height:30px">
                    <div style="float:left; width:60%; font-size:18px; color:#808080"><b>Chương Trình Khuyến Mãi</b></div>
                    <div style="float:right; width:40%; font-size:18px; color:#808080">
                        <div style="float:right"><i></i></div>
                    </div>
                </div>
                <div style="width:89%; margin-left:20px; height:40px">
                    <div style="float:left; width:20%; font-size:18px; color:#808080"><b>Giảm</b></div>
                    <div style="float:right; width:80%; font-size:18px; color:#808080">
                        <div style="float:right">- 0 VND</div>
                    </div>
                </div>
                 <div style="width:89%; margin-left:20px; height:30px">
                    <div style="float:left; width:80%; font-size:18px"><b>Phí vận chuyển</b></div>
                    <div style="float:right; width:20%; font-size:18px">
                        <div style="float:right">0 VND</div>
                    </div>
                </div>
                <div style="width:89%; border-top:dashed 2px; opacity:0.5; margin-top:30px; margin-left:20px"></div>
                <div style="width:89%; margin-left:20px; margin-top:30px; height:30px">
                    <div style="float:left; width:30%; font-size:18px"><b>TỔNG CỘNG</b></div>
                    <div style="float:right; width:70%; font-size:18px; color:#c80204">
                        <div style="float:right"><b><?php echo number_format($tt) ?> VND</b></div>
                    </div>
                </div>
                <a href="/order"><div class="pay">HOÀN TẤT ĐẶT HÀNG</div></a>
                <?php
                if(!Session::has('userloggin')||!Session::has('mycart')) {
                    echo '<div class="hiddenPayment"></div>';
                } 
                if(Session::has('mycart')){
                    $mycart = Session::get('mycart');
                    if(count($mycart)==0) echo '<div class="hiddenPayment"></div>';
                }
                ?>
            </div>
       </div>
    </div>
</div>
@endsection