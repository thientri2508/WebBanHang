@extends('client.layout')

@section('content')
<div style="width: 100%; background: #f8f8f8; height: 40px; margin-top: 80px">
    <div style="width: 1250px; margin: auto; height: 100%; line-height: 40px">
        <div style="color: #333; font-size: 13px; float: left;">HoDi</div>
        <div style="color: #333; font-size: 13px; float: left; margin-left: 10px; margin-right: 10px">/</div>
        <div style="color: #333; font-size: 13px; float: left; text-transform: capitalize"><?php if(isset($category[0]->name)) echo $category[0]->name; ?></div>
        <div style="color: #333; font-size: 13px; float: left; margin-left: 10px; margin-right: 10px">/</div>
        <div style="color: #333; font-size: 13px; float: left; text-transform: capitalize"><?php echo $product[0]->name; ?></div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div style="width: 100%; height: 970px; margin-top: 20px">
            <div style="width: 56%; float: left; height: 80%">
                <div style="float: left; width: 14%; height: 100%">
                    <?php 
                    echo '<img src="/storage/'.$product[0]->image.'" class="smallImageProduct" onclick="scrollImg(0)" >';
                    $pos = 1;
                    foreach ($image as $img) {
                        echo '<img src="/storage/'.$img->image.'" class="smallImageProduct" onclick="scrollImg('.$pos.')" >';
                        $pos++;
                    }
                    ?>
                </div>
                <div class="hiddenScroll">
                    <?php 
                    echo '<img src="/storage/'.$product[0]->image.'" class="BigImageProduct" >';
                    foreach ($image as $img) {
                        echo '<img src="/storage/'.$img->image.'" class="BigImageProduct" >';
                    }
                    ?>
                </div>
            </div>
            <div style="width: 41%; float: right; height: 80%">
                <div style="font-size: 22px; text-transform: uppercase; width: 95%; margin-top: 10px"><b><?php echo $product[0]->name ?></b></div>
                <div style="width: 95%; margin-top: 10px">
                    <?php 
                    for($i=1;$i<=5;$i++){
                        echo '<img src="/storage/star.png" style="float:left"> ';
                    }
                    echo '<div style="margin-left: 8px; font-size: 12px; color: #666; float:left">(19 đánh giá / 49 lượt mua)</div>';
                    ?> 
                </div>
                <div style="width: 95%; margin-top: 40px; clear: both">
                    <div style="font-size: 14px; float: left;text-decoration: underline; padding-top: 8px">Giá bán:</div>
                    <div style="font-size: 22px; color: #c80204; float: left; margin-left: 10px"><?php echo number_format($product[0]->price) ?> VNĐ</div>
                </div>
                <div style="width: 95%; margin-top: 100px; clear: both">
                    <div style="width: 47%; float: left; height: 80px">
                        <div style="font-size: 14px; float: left;">SIZE *</div>
                        <div style="font-size: 14px; float: left; color: #b31f2a; font-style: italic; cursor: pointer; margin-left: 10px">Hướng dẫn chọn size</div>
                        <input type="hidden" id="size"  />
                        <div class="dropdown">
                            <button class="btnSize" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i></button>
                            <?php
                            if($product[0]->sizetype=='word'){
                                echo'<div style="width:230px; height:62px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>
                                        <td id="size-s" onclick="selectSize(this.id,'.$product[0]->id.')">S</td>
                                        <td id="size-m" onclick="selectSize(this.id,'.$product[0]->id.')">M</td>
                                        <td id="size-l" onclick="selectSize(this.id,'.$product[0]->id.')">L</td>
                                        <td id="size-xl" onclick="selectSize(this.id,'.$product[0]->id.')">XL</td>
                                    </tr>
                                </table> 
                                </div>';
                            } else if($product[0]->sizetype=='number1'){
                                echo'<div style="width:230px; height:114px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>
                                        <td id="size-29" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">29</td>
                                        <td id="size-30" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">30</td>
                                        <td id="size-31" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">31</td>
                                        <td id="size-32" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">32</td>
                                    </tr>
                                    <tr>
                                        <td id="size-33" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">33</td>
                                        <td id="size-34" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">34</td>
                                        <td id="size-35" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">35</td>
                                        <td id="size-36" style="width:52px; height:51.2px" onclick="selectSize(this.id,'.$product[0]->id.')">36</td>
                                    </tr>
                                </table> 
                                </div>';
                            }else if($product[0]->sizetype=='number2'){
                                 echo'<div style="width:230px; height:62px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>
                                        <td id="size-40" onclick="selectSize(this.id,'.$product[0]->id.')">40</td>
                                        <td id="size-41" onclick="selectSize(this.id,'.$product[0]->id.')">41</td>
                                        <td id="size-42" onclick="selectSize(this.id,'.$product[0]->id.')">42</td>
                                        <td id="size-43" onclick="selectSize(this.id,'.$product[0]->id.')">43</td>
                                    </tr>
                                </table> 
                                </div>';
                            } else{
                                echo '<div style="width:230px; height:65px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table style="height:55px">
						        <tr><td id="size-free" onclick="selectSize(this.id,'.$product[0]->id.')">FreeSize</td></tr></table> </div>';
                            }
                            ?>
                        </div>
                        
                    </div>
                    <div id="CartIcon" style="display: none"></div>
                    <div style="width: 47%; float: right; height: 80px">
                        <div style="font-size: 14px">SỐ LƯỢNG *</div>
                        <input type="hidden" id="qty"  />
                        <div id="btnSLnone"><i class="fas fa-chevron-down" style="float:right; margin-right:12px; margin-top:10px"></i></div>
                        <div class="dropdown" >
                            <button  type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" class="btnSize"><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i></button>
                            <div style="width:230px; height:165px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <table id="HienThiSL">
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="width: 95%; margin-top: 40px; clear: both">
                    <div style="width: 47%; float: left; height: 80px; position: relative;">
                        <div id="bntthemnone"></div>
                        <div class="addMyCart" onclick="addMyCart(<?php echo $product[0]->id; ?>)">Thêm vào giỏ hàng</div>
                    </div>
                    <div style="width: 47%; float: right; height: 80px">
                        <div class="addMyFavorite">Thêm vào yêu thích</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection