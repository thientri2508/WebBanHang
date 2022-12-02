<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="{{ asset('cssServer/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="/jsServer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php 
  if(!Session::has('adminloggin')) {
    echo '<script>location.replace("/admin");</script>';
  }
?>
<body style="position: relative">
    <div id="delete"></div>
    <div class="left">
      <a href="/admin_home"><div style="font-weight: bold; font-size: 22px; margin-left: 25px; margin-top: 10px; cursor: pointer;">Hodi Administrator</div></a>
      
      <div class="accordion" id="profile" style="margin-top: 10px; margin-bottom: 20px; position: relative;">
        <div style="position: absolute; width: 20px; height: 20px; top:0px; right: 10px"><img src="/storage/chat.png"></div>
        <img src="/storage/profile.png">&nbsp;&nbsp;
          <?php 
          if(Session::has('adminloggin')) {
            $userloggin = Session::get('adminloggin');
            echo $userloggin['fullname'];
          }
          ?>
      </div>
      <div class="panel" id="p0">
        <a href="/admin/profile"><div class="item_panel" id="admin_profile">Profile</div></a>
        <a href="/admin/loggout"><div class="item_panel">Logout</div></a>
      </div>

      <div class="accordion" id="category">Category Management</div>
      <div class="panel" id="p1">
        <a href="/admin/list_category"><div class="item_panel" id="list_category">List</div></a>
        <a href="/admin/create_category"><div class="item_panel" id="create_category">Create New</div></a>
      </div>

      <div class="accordion" id="product">Product Management</div>
      <div class="panel" id="p2">
        <a href="/admin/list_product"><div class="item_panel" id="list_product">List</div></a>
        <a href="/admin/create_product"><div class="item_panel" id="create_product">Create New</div></a>
      </div>

      <a href="/admin/order"><div class="accordion" id="order">Orders Management</div></a>

    </div>
    <div class="right">
      @yield('content')
    </div>
</body>
</html>
<script>
  var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
//document.getElementById("p1").style.display="block";
</script>