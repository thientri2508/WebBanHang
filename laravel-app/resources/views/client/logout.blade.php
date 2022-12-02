<?php
    $userloggin = Session::get('userloggin');
    $fullname = $userloggin['fullname'];
?>
<div id="loggin" style="width: 260px; height: 205px;">
    <div class="title_search" style="border: none; margin-top: 18px">THÔNG TIN TÀI KHOẢN</div>
    <div style="font-size: 15px; margin: auto; margin-top: 20px; width: 86%; text-transform: initial; font-weight: bold"><?php echo $fullname; ?></div>
    <a href="/account"><div class="category_account" style="font-size: 15px; margin: auto; margin-top: 8px; width: 86%">Tài khoản của tôi</div></a>
    <a href="/account/addresses"><div class="category_account" style="font-size: 15px; margin: auto; margin-top: 8px; width: 86%">Danh sách địa chỉ</div></a>
    <a href="/account/logout"><div class="category_account" style="font-size: 15px; margin: auto; margin-top: 8px; width: 86%">Đăng xuất</div></a> 
</div>