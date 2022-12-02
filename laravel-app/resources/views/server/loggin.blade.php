<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('cssServer/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="/jsServer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="serverLogin">

		<h1 class="titleServer">Hodi Admin Server</h1>

    <div class="main-w3layouts-agileinfo">
            <h2 class="ServerForm">Fill out the form below to login</h2>
            <form role="form" method="POST" action="/logginAdmin">
                {{ csrf_field() }}
            <div class="form-sub-w3">
                <input type="text" name="Username" id="Username" placeholder="Username " class="form-sub-w3-text" />
                <div class="icon-w3">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-sub-w3">
                <input type="password" name="Password" id="Password" placeholder="Password" class="form-sub-w3-text" />
                <div class="icon-w3">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                </div>
            </div>
            <div class="submit-agileits">
                <input type="submit" value="Login" class="submit-agileits-submit" onclick="return ktDN();" name="login">
            </div>
            </form>
            <h3 style="width:90%; text-align:center; color:#FF0000; margin:auto; margin-top:40px" id="kt"></h3>
        </div>
    </div>
    <?php
    if(Session::has('message')) {
        $message = Session::get('message');
        echo '<script>document.getElementById("kt").innerHTML="'.$message.'"</script>';
        Session::forget('message');
    }
    ?>
</body>
</html>