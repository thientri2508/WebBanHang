@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff; position: relative;">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Category Install</h1>
    <form role="form" method="POST" action="/install_category">
        {{ csrf_field() }}
    <div style="width: 90%; height: 100px; margin-left: 50px; margin-top: 30px">
        <div style="width: 50%; float: left;">
            <div style="font-size: 1rem"><b>Category Name</b></div>
            <input class="form-control" type="text" aria-label="default input example" id="categoryName" name="categoryName" value="<?php echo $category->name ?>" style="width: 300px; margin-top: 10px">
        </div>
        <div style="width: 50%; float: right;">
            <div style="font-size: 1rem; margin-left: 40px"><b>Sort Number</b></div>
            <select class="form-select" aria-label="Default select example" style="width: 300px; margin-left: 40px; margin-top: 10px" name="sort">
                <?php
                if($category->sort==0) {
                    echo '<option value="appear">Appear</option>';
                    echo '<option value="0" selected>0</option>';
                }else {
                    echo '<option value="0">Hide</option>';
                }
                for($i=1;$i<=$amountCategory;$i++){
                    if($i==$category->sort) {
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    }else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
                ?>
              </select>
        </div>
    </div>
    
    <div style="position: absolute; top:110px; left:370px; color: red; font-size: 14px; font-weight: bold" id="kt"></div>
    <div style="margin-left: 50px; margin-top: 20px; width: 80%">
        <div style="font-size: 1rem; float: left;  margin-top: 10px"><b>Detail Category</b></div>
        <button type="button" class="btn btn-dark" style="width: 80px; margin-top: 5px; margin-left: 20px" onclick="addDetail_install()">Add</button>
        <input type="hidden" value="<?php echo $category->id; ?>" name="idCategory">
        <input type="hidden" value="<?php echo count($list_detail_category); ?>" id="amount_detail" name="amount_detail">
    </div>
    <div style="width: 92%; margin-left: 50px; margin-top: 20px">
        <div style="float: left; width: 47%">
            <?php
            if(count($list_detail_category)>0){
                $i = 1;
                foreach ($list_detail_category as $l) {
                    echo '<div style="width: 380px; height: 120px; position: relative">
                            <div style="font-size: 1rem; #212529"><b>Detail Category Name '.$i.'</b></div>
                            <input class="form-control" type="text" id="detail-'.$i.'" name="detail-'.$i.'" value="'.$l->name.'" aria-label="default input example" style="margin-top: 10px; width: 300px">
                            <div style="position: absolute; top:80px; color: red; font-size: 14px; font-weight: bold" id="kt-'.$i.'"></div>
                            <a href="/delDetailCategory/'.$category->id.'/'.$l->id.'"><button type="button" class="btn btn-danger" style="position: absolute; top:35px; left:400px">Delete</button></a>
                        </div>';
                    $i++;
                }
            }else{

            }
            ?>
        </div>  
        <div style="float: right; width: 47%" id="addDetail">
        </div>
    </div>
    <input type="submit" class="btn btn-info" value="Update" style="font-weight: bold; margin-left: 50px; margin-top: 35px; width: 100px" onclick="return checkUpdateCategory();">
    </form> 
    <?php
    if(Session::has('message')) {
        $message = Session::get('message');
        echo '<script>document.getElementById("kt").innerHTML="'.$message.'"</script>';
        Session::forget('message');
    }
    ?>
</div>
<script>
    document.getElementById("category").style.background="#ccc";
    document.getElementById("p1").style.display="block";
    document.getElementById("list_category").style.background="#007bff";
    document.getElementById("list_category").style.color="#fff";
</script>
@endsection
