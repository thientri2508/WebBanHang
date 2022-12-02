<?php
use App\Http\Controllers\ProductController;
if(Session::has('mycart')) {
$mycart = Session::get('mycart');
$i = 1;
if(count($mycart)>0){
    foreach($mycart as $sp){
    $product = ProductController::getProduct($sp[0]);
    echo '<div class="itemCart">
            <div style="width: 15%; height: 80%; float: left; margin-top: 15px">
                <img src="/storage/'.$product[0]->image.'" style="width: 100%; height: 100%; cursor: pointer;">
            </div>
            <div style="width: 60%; height: 80%; float: left; margin-top: 15px">
                <div style="color: #252a2b; font-size: 16px; margin-left: 20px; cursor: pointer;">'.$product[0]->name.'</div>
                <div style="font-size: 14px; margin-left: 20px; margin-top: 5px; color: #c80204">'.number_format($product[0]->price).'đ</div>
                <input type="hidden" id="priceSP-'.$i.'" value='.$product[0]->price.' />
                <div style="width: 70%; margin-top: 10px; clear: both; margin-left: 20px">
                    <div style="width: 47%; float: left; height: 80px">
                        <div style="font-size: 14px">SIZE</div>
                        <input type="hidden" id="size"  />
                        <div class="dropdown">
                            <button class="btnSize" id="'.$i.'-dropdownMenuButton3" type="button" data-bs-toggle="dropdown" aria-expanded="false"><h6 style="position:absolute; left:10px; top:8px; text-transform: uppercase"><b>'.$sp[1].'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i></button>';

                            if($product[0]->sizetype=='word'){
                                echo'<div style="width:230px; height:62px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>';
                                        echo ProductController::checkAmount($sp[0], 's',$i,'word');
                                        echo ProductController::checkAmount($sp[0], 'm',$i,'word');
                                        echo ProductController::checkAmount($sp[0], 'l',$i,'word');
                                        echo ProductController::checkAmount($sp[0], 'xl',$i,'word');
                                echo'</tr>
                                </table> 
                                </div>';
                            } else if($product[0]->sizetype=='number1'){
                                echo'<div style="width:230px; height:114px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>';
                                        echo ProductController::checkAmount($sp[0], '29',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '30',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '31',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '32',$i,'number1');
                                echo'</tr>
                                    <tr>';
                                        echo ProductController::checkAmount($sp[0], '33',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '34',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '35',$i,'number1');
                                        echo ProductController::checkAmount($sp[0], '36',$i,'number1');
                                echo'</tr>
                                </table> 
                                </div>';
                            }else if($product[0]->sizetype=='number2'){
                                 echo'<div style="width:230px; height:62px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table>
                                    <tr>';
                                        echo ProductController::checkAmount($sp[0], '40',$i,'number2');
                                        echo ProductController::checkAmount($sp[0], '41',$i,'number2');
                                        echo ProductController::checkAmount($sp[0], '42',$i,'number2');
                                        echo ProductController::checkAmount($sp[0], '43',$i,'number2');
                                echo'</tr>
                                </table> 
                                </div>';
                            } else{
                                echo '<div style="width:230px; height:65px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      			<table style="height:55px">
						        <tr><td id="size-free" onclick="selectSizeCart(this.id)">FreeSize</td></tr></table> </div>';
                            }
                            echo '<script>document.getElementById("sizeCart-'.$i.'-'.$sp[1].'-'.$product[0]->sizetype.'").style.background="#E8E8E8"</script>';

                    echo '</div>
                    </div>

                    <div style="width: 47%; float: right; height: 80px">
                        <div style="font-size: 14px">SỐ LƯỢNG</div>
                        <input type="hidden" id="qty"  />
                        <div class="dropdown" >
                            <button  type="button" id="'.$i.'-dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false" class="btnSize"><h6 style="position:absolute; left:10px; top:8px"><b>'.$sp[2].'</b></h6><i class="fas fa-chevron-down" style="float:right; margin-right:5px"></i></button>
                            <div style="width:230px; height:165px;border:#a5a5a5 1px solid" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <table id="HienThiSL-'.$i.'">';
                                $amount = ProductController::getAmount($sp[0], $sp[1]);
                                $count = 0;
                                echo '<tr>';
                                for($j=1;$j<=12;$j++)
                                {
                                    $count++;
                                    if($amount>0) {echo '<td style="width:52px; height:51.2px" id="slCart-'.$i.'-'.$j.'" onclick="selectSoLuongCart(this.id)">'.$j.'</td>';}
                                    else {echo '<td style="width:52px; height:51.2px; opacity:0.2" id="slCart-'.$i.'-'.$j.'" >'.$j.'</td>';}
                                    if($j==12) { echo '</tr>';
                                        break;}
                                    if($count==4) { echo '</tr><tr>';
                                        $count=0;}
                                    $amount--;
                                }
                                echo '<script>document.getElementById("slCart-'.$i.'-'.$sp[2].'").style.background="#E8E8E8"</script>';
                            echo '</table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div style="width: 25%; height: 80%; float: right; margin-top: 15px">
                <i class="fa-solid fa-xmark fa-2x" style="margin-left: 90%; margin-top: 10px; cursor: pointer;" onclick="delCart(this.id)" id="del-'.$i.'"></i>
                <div style="font-size: 16px; float: right; color: #c80204; margin-top: 50px" id="priceTT-'.$i.'">'.number_format(($product[0]->price*$sp[2])).'₫</div>
            </div>
            </div>';
            $i++;
    } 
} else {
    echo '<p style="font-size: 20px; margin-top:23px; color: #252a2b;">Giỏ hàng của bạn đang trống</p>';
    //echo '<script>document.getElementById("ctn").style.height="500px"</script>';
}
}else {
    echo '<p style="font-size: 20px; margin-top:23px; color: #252a2b;">Giỏ hàng của bạn đang trống</p>';
    //echo '<script>document.getElementById("ctn").style.height="800px"</script>';
}         
?>