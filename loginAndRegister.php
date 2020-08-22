<?php
require_once 'init.php';
require_once 'functions.php';

if ($currentUser) {
    header('Location:/WebSite/BTCN08/index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" type="image/png" href="/WebSite/BTCN08/facebook-new.png"/>
    <title>facebook</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        </head>
  <body>
<div class = "custom">
    <div class="brz-welome-padd-in2">
            <div class="row">
                <div class="col-lg-6" margin="0 auto" >
                <h1 class="faLogin" > 
                    facebook
                </h1>
                </div>
                <div class="col-lg-6" style = "font-family: Times New Roman"font-size="6px">
                    <form action="/WebSite/BTCN08/login.php" method="post">
                    <div class="row" >
                    <div class="col-lg-5"size="6px">
                        <label class="lableLogin">Email:</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="username">
                    </div>
                    <div class="col-lg-5">
                        <label class="lableLogin">Password:</label>
                        <input type="password" class="form-control" id="exampleInputEmail1"  placeholder="Password"name="password">
                        <a href="/WebSite/BTCN08/forgot_PassWord.php"style="size:10px;color:black;margin-left:5px;opacity: 0.6">Quên mật khẩu?</a>
                    </div>
                    <div class="row"> 
                    <div class="col-lg-16" >
                    <div style="margin-top:-4px; margin-left:6px" class="brz-row-padding brz-container">
                    <button type="submit" class="btn btn-primary btn-sm"id="loginButton" >Đăng nhập</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    </div>
    <div class="bodyLogin">
    <div class="container">
    <div class="row">
        <div class="col-lg-6">
        <h5 style="margin-top: 50px;margin-right:20px">
        Facebook giúp bạn kết nối và chia sẻ với mọi người trong cuộc sống của bạn.
        </h5>
        <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yi/r/OBaVg52wtTZ.png">
        </div>
        <div class="col-lg-6">
            <h2 style="margin-top: 30px;">
                Đăng ký
            </h2>
            <h5>Nhanh chóng dễ dàng</h5>
            <form action="/WebSite/BTCN08/register.php" method="post"style="margin-top :60px">
                <input name="displayName" style="margin-bottom: 15px;width:400px" type="text" class="form-control" placeholder="Họ và tên">
                <input name="email" style="margin-bottom: 15px;width:400px" type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                <input name="password" style="margin-bottom: 15px;width:400px" type="password" class="form-control"  placeholder="Password">
                <input name="phoneNumber" style="margin-bottom: 15px;width:400px" type="number" class="form-control" placeholder="Số điện thoại" minlength="10" maxlength="16" pattern=".{10,}" title="Số Điện Thoại có ít nhất 10 số">
                <label style="font-size:10px;margin-right:200px" >Bằng cách nhấp vào Đăng ký, bạn đồng ý với Điều khoản, Chính sách dữ liệu và Chính sách cookie của chúng tôi. Bạn có thể nhận được thông báo của chúng tôi qua SMS và hủy nhận bất kỳ lúc nào.</label>
                <button style="font-size:20px;width:200px;margin-top:20px;margin-left:200px" type="submit" class="btn btn-primary">Đăng kí</button>
                <label style="margin-top:40px" >Tạo Trang dành cho người nổi tiếng, nhãn hiệu hoặc doanh nghiệp.</label>
            </form>
        </div>
    </div>
    </div>

    </div>
</body>
</html>

