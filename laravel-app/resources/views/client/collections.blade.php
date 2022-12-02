@extends('client.layout')

@section('content')
<div style="width: 100%; background: #f8f8f8; height: 40px; margin-top: 80px">
    <div style="width: 1250px; margin: auto; height: 100%; line-height: 40px">
        <div style="color: #333; font-size: 13px; float: left;">HoDi</div>
        <div style="color: #333; font-size: 13px; float: left; margin-left: 10px; margin-right: 10px">/</div>
        <div style="color: #333; font-size: 13px; float: left; text-transform: capitalize"><?php echo $nameCategory; ?></div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div style="width: 100%; margin-top: 10px;  border-bottom: 1px dashed #ccc; padding-bottom: 10px">
            <h2 style="text-transform: uppercase; font-size: 24px; margin-bottom: 10px; font-weight: 700; line-height: 32px"><?php echo $nameCategory; ?></h2>
        </div>
        <div style="width: 100%; height: 2480px">
            <div style="width: 73%; height: 100%; float: left;  border-bottom: 1px dashed #ccc">
                <?php
                $t1=$amount/15;
                $t2=intval($amount/15);
                if($t1==$t2) {
                    $sotrang = $t1;
                }else {
                    $sotrang = $t2 + 1;
                }
                foreach ($list as $l){
                    echo '<div class="item_product" style="margin-right: 10px">
                        <a href="/product/'.$l->id.'"><div style="width: 100%; height: 400px; position: relative; background: #f7f7f7" id="img'.$l->id.'" onmouseover="hoverProduct(this)" onmouseout="overProduct(this)">
                            <img src="/storage/'.$l->image.'" style="cursor: pointer; width: 100%; height: 100%">
                            <div id="sp'.$l->id.'" class="detail">Xem chi tiết</div>
                        </div></a>
                        <a href="/product/'.$l->id.'"><div class="titleName" style="font-size: 14px; width: 100%; text-align: center; margin-top: 10px">'.$l->name.'</div></a>
                        <div style="font-size: 16px; text-transform: uppercase; color: #c80204; width: 100%; text-align: center; margin-top: 5px">'.number_format($l->price).' vnđ</div>
                    </div>';
                }
                
                ?>
            </div>
            <div style="width: 25.5%; height: 100%; float: right; position: relative;">
                <h5 style="font-size: 14px; font-weight: 700; color: #666; margin-top: 50px">GIÁ SẢN PHẨM</h5>
                <hr style="width: 60%; position:absolute; right: 0px; top: 41px; border: 0.5px solid">
                <div class="form-check" style="font-size: 14px">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">Dưới 100.000đ</label>
                </div>
                <div class="form-check" style="font-size: 14px">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">100.000đ - 200.00đ</label>
                </div>
                <div class="form-check" style="font-size: 14px">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">200.000đ - 300.000đ</label>
                </div>
                <div class="form-check" style="font-size: 14px">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">300.000đ - 400.000đ</label>
                </div>
                <div class="form-check" style="font-size: 14px">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">Trên 500.000đ</label>
                </div>
                <h5 style="font-size: 14px; font-weight: 700; color: #666; margin-top: 40px">SẢN PHẨM HOT</h5>
                <hr style="width: 60%; position:absolute; right: 0px; top: 233px; border: 0.5px solid">
                <div style="width: 95%">
                    <?php 
                    foreach ($list_hot_product as $l) {
                        echo '<div style="width: 100%; height: 90px; margin-top: 20px">
                                <div style="width: 25%; float: left; height: 100%; cursor: pointer;">
                                    <img style="width: 100%; height: 100%" src="/storage/'.$l->image.'">
                                </div>
                                <div style="width: 75%; float: right; height: 100%">
                                    <div class="titleName" style="width: 90%; margin-left: 10px; font-size: 13px;">'.$l->name.'</div>
                                    <div style="width: 90%; margin-left: 10px; color: #c80204; font-size: 13px">'.number_format($l->price).'</div>
                                </div>
                            </div>';
                    }
                    ?>
                </div>
                <h5 style="font-size: 14px; font-weight: 700; color: #666; margin-top: 40px">SẢN PHẨM ĐÃ XEM</h5>
                <hr style="width: 52%; position:absolute; right: 0px; top: 840px; border: 0.5px solid">
            </div>
        </div>
        <div style="width: 100%; height: 60px">
            <div class="pagination">
                <?php
                if($sotrang<=3){
                    for($i=$sotrang; $i>0; $i--){
                        if($i==$p) {
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page" style="background: #b31f2a; border: 1px solid #b31f2a; color: #fff" id="trang-'.$i.'">'.$i.'</div></a>';
                        } else{
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page">'.$i.'</div></a>';
                        } 
                    }                 
                } else {
                    if($p<$sotrang) {
                        echo '<a href="/collections/'.$idCategory.'/trang-'.$sotrang.'"><div class="page" style="font-size: 10px">>></div></a>';
                        echo '<a href="/collections/'.$idCategory.'/trang-'.($p+1).'"><div class="page" style="font-size: 10px">></div></a>';
                    }
                    if($p>=3){
                        $c=$p+2;
                        if($c>$sotrang){
                            $c=$sotrang;
                        }
                        for($i=$c; $i>=$p-2; $i--){
                        if($i==$p) {
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page" style="background: #b31f2a; border: 1px solid #b31f2a; color: #fff" id="trang-'.$i.'">'.$i.'</div></a>';
                        } else{
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page">'.$i.'</div></a>';
                        }                  
                        }
                    }else {
                        for($i=3; $i>0; $i--){
                        if($i==$p) {
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page" style="background: #b31f2a; border: 1px solid #b31f2a; color: #fff" id="trang-'.$i.'">'.$i.'</div></a>';
                        } else{
                            echo '<a href="/collections/'.$idCategory.'/trang-'.$i.'"><div class="page">'.$i.'</div></a>';
                        }                  
                        }
                    }
                    
                    if($p>1) {
                        echo '<a href="/collections/'.$idCategory.'/trang-'.($p-1).'"><div class="page" style="font-size: 10px"><</div></a>';
                        echo '<a href="/collections/'.$idCategory.'/trang-1"><div class="page" style="font-size: 10px"><<</div></a>';
                    }
                }
                
                
                ?>
            </div>
        </div>
    </div>
</div>

@endsection