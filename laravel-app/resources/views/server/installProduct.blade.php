@extends('server.layout')

@section('content')

<div style="width: 100%; color: #fff; position: relative;">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px; font-weight: bold">View Product Details and Settings</h1>
    <div class="titleSettingProduct">General Information</div>
    <form role="form" method="POST" action="/install_product1">
        {{ csrf_field() }}
    <div style="width: 90%; margin-left: 50px; margin-top: 30px" id="form1">
        <div style="width: 70%; float: left;" id="form1-left">
            <div style="font-size: 1rem"><b>Product Name</b></div>
            <input class="form-control" type="text" aria-label="default input example" id="productName" name="productName" value="<?php echo $product[0]->name ?>" style="width: 75%; margin-top: 10px">
            <div style="position: absolute; top:540px; left:50px; color: red; font-size: 14px; font-weight: bold" id="kt"></div>
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Price</b></div>
            <input class="form-control" type="text" aria-label="default input example" id="productPrice" name="productPrice" value="<?php echo $product[0]->price ?>" style="width: 75%; margin-top: 10px">
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Status</b></div>
            <select class="form-select" aria-label="Default select example" style="width: 75%; margin-top: 10px" name="status">
            <?php
            $status = ['New Arrival', 'Best Seller', 'Hot', 'Sale Off'];
            for($i=0;$i<count($status);$i++){
                $t = strtolower($status[$i]);
                $t = str_replace( ' ', '-', $t);
                if($t==$product[0]->status) {
                    echo '<option value="'.$t.'" selected>'.$status[$i].'</option>';
                }else {
                    echo '<option value="'.$t.'">'.$status[$i].'</option>';
                }
            }
            ?>
            </select>
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Sizetype</b></div>
            <select class="form-select" aria-label="Default select example" style="width: 75%; margin-top: 10px" name="sizetype">
                <option value="word" <?php if($product[0]->sizetype=='word') echo 'selected' ?> >Size Áo</option>
                <option value="number1" <?php if($product[0]->sizetype=='number1') echo 'selected' ?> >Size Quần</option>
                <option value="number2" <?php if($product[0]->sizetype=='number2') echo 'selected' ?> >Size Giày</option>
                <option value="free" <?php if($product[0]->sizetype=='free') echo 'selected' ?> >Size Phụ Kiện</option>
            </select>
        </div>
        <div style="width: 30%; float: right;" id="form1-right">
            <div style="font-size: 1rem; margin-left: 30px"><b>Category</b></div>
            <input type="hidden" name="idProduct" value="<?php echo $product[0]->id; ?>">
            <input type="hidden" name="amountCategory" value="<?php echo count($list_all_category); ?>">
            <?php
            $i = 1;
            foreach ($list_all_category as $l) {
                $check = false;
                echo '<div class="form-check" style="margin-top: 20px; float: left; margin-left: 30px">';
                foreach ($list_CategoryOfProduct as $l1){
                    if($l[0]==$l1->idCategory) {
                        $check = true;
                        break;
                    }
                }
                if($check) {
                    echo '<input class="form-check-input" type="checkbox" value="'.$l[0].'" name="category[]" id="flexCheckDefault" checked>';
                }else {
                    echo '<input class="form-check-input" type="checkbox" value="'.$l[0].'" name="category[]" id="flexCheckDefault">';
                }
                    echo '<label class="form-check-label" for="flexCheckDefault">'.$l[1].'</label>
                    </div>';
                $i++;                    
            }
            ?>
        </div>
    </div>
    <input type="submit" class="btn btn-info" value="Update" style="font-weight: bold; margin-left: 50px; width: 100px; margin-top: 50px" onclick="return checkInforProduct();">
    </form>
    <div class="titleSettingProduct">Image Product</div>
    <div style="width: 90%; margin-left: 50px; margin-top: 30px; height: 900px;" id="form2">
        <div style="font-size: 1rem"><b>Image List</b></div>
        <div class="image_list">
            <?php 
            if($product[0]->image!=''){
                echo '<div class="image_item" id="img-'.$product[0]->image.'" onmouseover="hoverImage(this)" onmouseout="overImage(this)">
                    <img src="/storage/'.$product[0]->image.'" style="width:200px; height:250px">
                    <h6 class="note_image_item">Main Image</h6>
                    <div id="setting-'.$product[0]->image.'" class="setting">
                        <a href="/MainSub/'.$product[0]->id.'/'.$product[0]->image.'"><button type="button" class="btn btn-info" style="margin-left:32px; margin-top: 30px">Set Sub Image</button></a>
                        <a href="/TurnOffMain/'.$product[0]->id.'/'.$product[0]->image.'"><button type="button" class="btn btn-warning" style="width: 132px; margin-left:32px; margin-top: 30px">Turn Off</button></a>
                        <a href="/DeleteMain/'.$product[0]->id.'"><button type="button" class="btn btn-danger" style="width: 132px; margin-left:32px; margin-top: 30px">Delete</button></a>
                    </div>
                </div>';
            }
            foreach ($list_image_product as $l) {
                echo '<div class="image_item" id="img-'.$l->image.'" onmouseover="hoverImage(this)" onmouseout="overImage(this)">
                    <img src="/storage/'.$l->image.'" style="width:200px; height:250px">';
                if($l->status=="on") echo '<h6 class="note_image_item">Sub Image</h6>'; 
                echo '<div id="setting-'.$l->image.'" class="setting">
                        <a href="/SubMain/'.$l->idProduct.'/'.$l->image.'"><button type="button" class="btn btn-primary" style="margin-left:32px; margin-top: 30px">Set Main Image</button></a>';
                        if($l->status=="on") echo '<a href="/TurnOffSub/'.$l->idProduct.'/'.$l->image.'"><button type="button" class="btn btn-warning" style="width: 132px; margin-left:32px; margin-top: 30px">Turn Off</button></a>';
                        else echo '<a href="/TurnOnSub/'.$l->idProduct.'/'.$l->image.'"><button type="button" class="btn btn-info" style="margin-left:32px; margin-top: 30px">Set Sub Image</button></a>';
                        echo '<a href="/DeleteSub/'.$l->idProduct.'/'.$l->image.'"><button type="button" class="btn btn-danger" style="width: 132px; margin-left:32px; margin-top: 30px">Delete</button></a>
                    </div>';
                echo '</div>';
            }
            ?>
        </div>
        <form role="form" method="POST" action="/install_product2" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div style="font-size: 1rem; margin-top: 50px"><b>Add Image (.jpg, .png, .jpeg)</b></div>
        <input type="hidden" name="idProduct" value="<?php echo $product[0]->id; ?>">
        <input class="form-control" type="file" name="file[]"  multiple style="margin-top:40px; width:52%">
        <input type="submit" class="btn btn-info" value="Upload" style="font-weight: bold; width: 100px; margin-top: 50px;">
        </form>
    </div>
    <div class="titleSettingProduct">Amount Product</div>
    <form role="form" method="POST" action="/install_product3">
        {{ csrf_field() }}
    <div style="width: 90%; margin-left: 50px; margin-top: 50px; height: 140px;" id="form3">
        <?php
        foreach ($amount as $a) {
            echo '<div class="amountProduct">
                    <div style="width:100%; margin:auto; margin-top:15px; text-align:center; text-transform: uppercase;">
                        <div><b>Size: '.$a->size.'</b></div>
                        <div style="margin-top:10px"><input type="number" value="'.$a->amount.'" name="size'.$a->size.'" min="0" max="1000" style="width:70px"></div>
                    </div>
                </div>';
        }
        ?>  
    </div>
    <input type="hidden" name="idProduct" value="<?php echo $product[0]->id; ?>">
    <input type="submit" class="btn btn-info" value="Update" style="font-weight: bold; width: 100px; margin-top: 50px; margin-bottom: 50px; margin-left: 50px">
    </form>
</div>
<script>
    window.onload = loadView_installProduct();
</script>
@endsection
