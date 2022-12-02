@extends('server.layout')

@section('content')

<div style="width: 100%; height: 700px; color: #fff; position: relative;">
    <h1 style="font-size: 1.8rem; margin-left: 50px; margin-top: 20px">Create New Category</h1>
    <form role="form" method="POST" action="/create_category">
        {{ csrf_field() }}
    <div style="font-size: 1rem; margin-left: 50px; margin-top: 30px"><b>Category Name</b></div>
    <input class="form-control" type="text" aria-label="default input example" id="categoryName" name="categoryName" style="margin-left: 50px; margin-top: 10px; width: 300px">
    <div style="position: absolute; top:110px; left:370px; color: red; font-size: 14px; font-weight: bold" id="kt"></div>
    <div style="margin-left: 50px; margin-top: 20px; width: 80%">
        <div style="font-size: 1rem; float: left;  margin-top: 10px"><b>Detail Category</b></div>
        <button type="button" class="btn btn-dark" style="width: 80px; margin-top: 5px; margin-left: 20px" onclick="addDetail()">Add</button>
        <input type="hidden" value="0" id="amount_detail" name="amount_detail">
    </div>
    <div class="detail_category">
    </div>  
    <input type="submit" class="btn btn-info" value="Create" style="font-weight: bold; margin-left: 50px; margin-top: 35px; width: 100px" onclick="return checkCreateCategory();">
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
    document.getElementById("create_category").style.background="#007bff";
    document.getElementById("create_category").style.color="#fff";
</script>
@endsection
