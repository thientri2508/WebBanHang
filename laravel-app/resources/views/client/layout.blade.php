<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HoDi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="{{ asset('cssClient/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('cssClient/animate.css') }}" rel="stylesheet" type="text/css" />
    <script src="/jsClient.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="position: relative">
    <div id="delete"></div>
    <div class="intro">
        <div>
            <div class="intro_item" style="width: 71%">Hotline: 0868.444.644</div>
            <div class="intro_item" style="width: 11%"><a>Cách chọn Size</a></div>
            <div class="intro_item" style="width: 13%"><a>Chính sách khách vip</a></div>
            <div class="intro_item" style="width: 5%"><a>Giới thiệu</a></div>
        </div>
    </div>
    <div class="header">
        <div class="header_main">
            <div class="header_item" style="width: 9%; float: left">
                <a href="/"><img src="{{ asset('storage/hodi.png') }}" style="width: 100%; height: 100%; margin-left: -10px"></a>
            </div>
            <div class="header_item" id="menu" style="width: 70%; float: left; margin-left: 8%; margin-top: 18px">
                <ul>
                    <?php
                    use App\Http\Controllers\CategoryController;
                    use App\Http\Controllers\DetailCategoryController;

                    $category = CategoryController::getListAll();
                    $detail_category = DetailCategoryController::getListAll();

                    foreach ($category as $c1)
                    {
                        $flag = false;
                        echo '<li>';
                        echo '<a href="/collections/'.$c1->id.'/trang-1">'.$c1->name.'</a>';
                        foreach ($detail_category as $c2)
                        {
                            if ($c1->id == $c2->idCategory){
                                $flag = true;
                                break;
                            }
                        }
                        if ($flag){
                            echo '<ul class="sub-menu">';
                            foreach ($detail_category as $c2){
                                if ($c1->id == $c2->idCategory){
                                    echo '<li style="width: 180px; font-size: 13px;"><a href="/collections/'.$c2->id.'/trang-1" style="text-transform: none;">'.$c2->name.'</a></li>';
                                }
                            }
                            echo '</ul>';
                        }
                       echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="header_item" style="width: 2%; float: right">
                <img onclick="btnCart()" src="{{ asset('storage/shopping-bag.png') }}" style="margin-top: 24px; cursor: pointer; width: 25px; height: 25px;">
            </div>

            <div id="cart">
                @include('client.cart_mini')
            </div>

            <div class="header_item" style="width: 2%; float: right; margin-right:23px">
                <i onclick="btnLoggin()" class="fa-solid fa-circle-user" style="font-size: 1.5em; margin-top: 25px; cursor: pointer"></i>
            </div>    

            @if (Session::has('userloggin'))
            @include('client.logout')
            @endif

            @if (!Session::has('userloggin'))
            @include('client.loggin_form')
            @endif

            <div class="header_item" style="width: 2%; float: right; margin-right: 23px">
                <i onclick="btnSearch()" class="fa-solid fa-magnifying-glass" style="font-size: 1.5em; margin-top: 25px; cursor: pointer"></i>
            </div>

            <div id="div_search_inp">
                <div class="title_search">TÌM KIẾM</div>
                <div class="search_inp">
                    <input type="search" placeholder="Tìm kiếm sản phẩm..." class="se">
                </div>
                
            </div>

        </div>
    </div>
    <div class="gotoTop">
        <i class="fa-sharp fa-solid fa-angle-up fa-2x" style="color: white; position: absolute; top:8px; left: 11px"></i>
    </div>
    @yield('content')
    <div class="footer">
        <div style="width: 1250px; height: 100%; margin: auto;">
            <div style="width: 35%; height: 72%; float: left; margin-top: 45px">
                <div style="font-size: 20px; letter-spacing: 0.02em; color: #252a2b;">HODI STORE</div>
                <div style="font-size: 14px; margin-top: 22px">Basic & Streetwear fashion // GPDKKD: 41P8018179</div>
                <img src="/storage/footer1.png" style="width: 230px; height: 85px; margin-top: -15px" >
            </div>
            <div style="width: 19%; height: 72%; float: left; margin-top: 45px">
                <div style="font-size: 20px; letter-spacing: 0.02em; color: #252a2b;">Hỗ Trợ Khách Hàng</div>
                <div style="font-size: 14px; margin-top: 22px">Khách hàng VIP</div>
                <div style="font-size: 14px; margin-top: 10px">Hướng dẫn chọn size</div>
                <div style="font-size: 14px; margin-top: 10px">Chính Sách Đổi Trả</div>
                <div style="font-size: 14px; margin-top: 10px">Thanh Toán & giao nhận</div>
            </div>
            <div style="width: 27%; height: 72%; float: left; margin-top: 45px">
                <div style="font-size: 20px; letter-spacing: 0.02em; color: #252a2b;">Thông tin liên hệ</div>
                <div style="font-size: 14px; margin-top: 22px"><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;159/37 Hoàng Văn Thụ, p8, Q phú nhuận</div>
                <div style="font-size: 14px; margin-top: 10px"><i class="fa-sharp fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;0906 773 705</div>
                <div style="font-size: 14px; margin-top: 10px"><i class="fa-sharp fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;hodifashion@gmail.com</div>
            </div>
            <div style="width: 19%; height: 72%; float: right; margin-top: 45px">
                <div style="font-size: 20px; letter-spacing: 0.02em; color: #252a2b;">Fanpage</div>
            </div>
            <div style="width: 50%; margin: auto; text-align: center; font-size: 14px; clear: both;">Copyright © 2022 HODI STORE</div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function() {
   $(window).scroll(function(event) {
      var pos_body = $('html,body').scrollTop();
      if(pos_body>0){
         //$('.header').addClass('menu');
         $(".header").css("top", "0px");
      } else {
         $(".header").css("top", "40px");
      }
      if(pos_body>250){
         //$('.header').addClass('menu');
         $(".gotoTop").css("display", "block");
      } else {
        $(".gotoTop").css("display", "none");
      }
   });
   $('.gotoTop').click(function(event) {
      $('html,body').animate({scrollTop: 0},500);
   });
});
</script>
