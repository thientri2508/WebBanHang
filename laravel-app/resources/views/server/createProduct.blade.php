@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff; position: relative;">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Create New Product</h1>
    <form role="form" method="POST" action="/create_product" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div style="width: 90%; margin-left: 50px; margin-top: 30px" id="form">
        <div style="width: 70%; float: left;" id="form-left">
            <div style="font-size: 1rem"><b>Product Name</b></div>
            <input class="form-control" type="text" aria-label="default input example" id="productName" name="productName" style="width: 75%; margin-top: 10px">
            <div style="position: absolute; top:560px; left:50px; color: red; font-size: 14px; font-weight: bold" id="kt"></div>
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Price</b></div>
            <input class="form-control" type="text" aria-label="default input example" id="productPrice" name="productPrice" style="width: 75%; margin-top: 10px">
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Status</b></div>
            <select class="form-select" aria-label="Default select example" style="width: 75%; margin-top: 10px" name="status">
            <?php
            $status = ['New Arrival', 'Best Seller', 'Hot', 'Sale Off'];
            for($i=0;$i<count($status);$i++){
                $t = strtolower($status[$i]);
                $t = str_replace( ' ', '-', $t);
                echo '<option value="'.$t.'">'.$status[$i].'</option>';
            }
            ?>
            </select>
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Sizetype</b></div>
            <select class="form-select" aria-label="Default select example" style="width: 75%; margin-top: 10px" name="sizetype">
                <option value="word">Size Áo</option>
                <option value="number1">Size Quần</option>
                <option value="number2">Size Giày</option>
                <option value="free">Size Phụ Kiện</option>
            </select>
            <div style="font-size: 1rem; margin-top: 30px"><b>Product Image</b></div>
            <input class="form-control" type="file" name="file[]"  multiple style="margin-top:10px; width:75%">
        </div>
        <div style="width: 30%; float: right;" id="form-right">
            <div style="font-size: 1rem; margin-left: 30px"><b>Category</b></div>
            <input type="hidden" name="amountCategory" value="<?php echo count($list_all_category); ?>">
            <?php
            
            foreach ($list_all_category as $l) {
                echo '<div class="form-check" style="margin-top: 20px; float: left; margin-left: 30px">';
                echo '<input class="form-check-input" type="checkbox" value="'.$l[0].'" name="category[]" id="flexCheckDefault">';
                echo '<label class="form-check-label" for="flexCheckDefault">'.$l[1].'</label>
                    </div>';   
            }        
            ?>
        </div>
    </div>
    <input type="submit" class="btn btn-info" value="Create" style="font-weight: bold; margin-left: 50px; width: 100px; margin-top: 70px" onclick="return checkInforProduct();">
    </form>
</div>
<script>
    window.onload = loadView_createProduct();
</script>
@endsection
