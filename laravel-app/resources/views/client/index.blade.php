@extends('client.layout')

@section('content')
<div class="img_adv"><img src="{{ asset('storage/adv.jpg') }}" style="width: 100%; height: 100%;"></div>
<div class="container">
    <div class="content">
        <div style="font-size: 23px; font-weight: 700; color: #333; text-align: center; margin-top: 35px">THỜI TRANG HOT NHẤT</div>
        <div style="width: 100%; height: 1000px; margin-top: -10px">
            <?php
            foreach ($list_hot_product as $l) {
              echo '<div class="item_product">
                <a href="/product/'.$l->id.'"><div style="width: 100%; height: 400px; position: relative; background: #f7f7f7" id="img'.$l->id.'" onmouseover="hoverProduct(this)" onmouseout="overProduct(this)">
                        <img src="/storage/'.$l->image.'" style="cursor: pointer; width: 100%; height: 100%;">
                        <div id="sp'.$l->id.'" class="detail">Xem chi tiết</div>
                      </div></a>
                      <a href="/product/'.$l->id.'"><div style="font-size: 14px; color: #333; text-transform: capitalize; width: 100%; text-align: center; margin-top: 10px; cursor: pointer;">'.$l->name.'</div></a>
                      <div style="font-size: 16px; color: #c80204; text-transform: uppercase; width: 100%; text-align: center; margin-top: 5px">'.number_format($l->price).' vnđ</div>
                    </div>';
            }
            ?>
        </div>

        <div style="width: 100%; height: 430px; background: #fafafa; margin-top: 10px">
            <div class="img-hover-zoom" style="width: 23%; float: left"><img src="{{ asset('storage/adv1.jpg') }}" style="width: 100%; height: 100%"></div>
            <div class="img-hover-zoom" style="width: 50%; float: left; margin-left: 26px"><img src="{{ asset('storage/adv2.jpg') }}" style="width: 100%; height: 100%"></div>
            <div class="img-hover-zoom" style="width: 23%; float: right"><img src="{{ asset('storage/adv3.jpg') }}" style="width: 100%; height: 100%"></div>
        </div>

        <div style="font-size: 23px; font-weight: 700; color: #333; text-align: center; margin-top: 35px">THỜI TRANG MỚI NHẤT</div>
        <div style="width: 100%; height: 1000px; margin-top: -10px">
          <?php
          foreach ($list_new_product as $l) {
            echo '<div class="item_product">
              <a href="/product/'.$l->id.'"><div style="width: 100%; height: 400px; position: relative; background: #f7f7f7" id="img'.$l->id.'" onmouseover="hoverProduct(this)" onmouseout="overProduct(this)">
                      <img src="/storage/'.$l->image.'" style="cursor: pointer; width: 100%; height: 100%;">
                      <div id="sp'.$l->id.'" class="detail">Xem chi tiết</div>
                    </div></a>
                    <a href="/product/'.$l->id.'"><div style="font-size: 14px; color: #333; text-transform: capitalize; width: 100%; text-align: center; margin-top: 10px; cursor: pointer;">'.$l->name.'</div></a>
                    <div style="font-size: 16px; color: #c80204; text-transform: uppercase; width: 100%; text-align: center; margin-top: 5px">'.number_format($l->price).' vnđ</div>
                  </div>';
          }
          ?>
        </div>

        <div style="font-size: 23px; font-weight: 700; color: #333; text-align: center; margin-top: 35px; margin-bottom: 0px">THỜI TRANG BÁN CHẠY</div>
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="d-block w-100" style="width: 1350px; height: 520px">
                  
                  <?php
                  $i=1;
                  foreach ($list_best_product as $l) {
                    if($i<=4){
                      echo '<div class="item_product">
                      <a href="/product/'.$l->id.'"><div style="width: 100%; height: 400px; position: relative; background: #f7f7f7" id="img'.$l->id.'" onmouseover="hoverProduct(this)" onmouseout="overProduct(this)">
                          <img src="/storage/'.$l->image.'" style="cursor: pointer; width: 100%; height: 100%;">
                          <div id="sp'.$l->id.'" class="detail">Xem chi tiết</div>
                        </div></a>
                        <a href="/product/'.$l->id.'"><div style="font-size: 14px; color: #333; text-transform: capitalize; width: 100%; text-align: center; margin-top: 10px; cursor: pointer;">'.$l->name.'</div></a>
                        <div style="font-size: 16px; color: #c80204; text-transform: uppercase; width: 100%; text-align: center; margin-top: 5px">'.number_format($l->price).' vnđ</div>
                      </div>';
                    }
                      $i++;
                  }
                  ?>

                </div>
              </div>
              <div class="carousel-item">
                <div class="d-block w-100" style="width: 1350px; height: 520px">
                  <?php
                  $i=1;
                  foreach ($list_best_product as $l) {
                    if($i>4){
                      echo '<div class="item_product">
                      <a href="/product/'.$l->id.'"><div style="width: 100%; height: 400px; position: relative; background: #f7f7f7" id="img'.$l->id.'" onmouseover="hoverProduct(this)" onmouseout="overProduct(this)">
                          <img src="/storage/'.$l->image.'" style="cursor: pointer; width: 100%; height: 100%;">
                          <div id="sp'.$l->id.'" class="detail">Xem chi tiết</div>
                        </div></a>
                        <a href="/product/'.$l->id.'"><div style="font-size: 14px; color: #333; text-transform: capitalize; width: 100%; text-align: center; margin-top: 10px; cursor: pointer;">'.$l->name.'</div></a>
                        <div style="font-size: 16px; color: #c80204; text-transform: uppercase; width: 100%; text-align: center; margin-top: 5px">'.number_format($l->price).' vnđ</div>
                      </div>';
                    }
                      $i++;
                  }
                  ?>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev" style="margin-left: -73px; margin-top: -70px">
              <i class="fa-solid fa-chevron-left fa-3x" style="margin-left: -60px; color: black"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" style="margin-right: -33px; margin-top: -70px">
              <i class="fa-solid fa-chevron-right fa-3x" style="margin-right: -95px; color: black"></i>
            </button>
          </div>

    </div>
</div>

@endsection