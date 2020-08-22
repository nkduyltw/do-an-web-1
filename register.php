<?php
    require_once 'init.php';
    require_once 'functions.php'
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
 
<?php if(isset($_POST['displayName']) && isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['phoneNumber'])): ?>
<?php
    $displayName=$_POST['displayName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phoneNumber=$_POST['phoneNumber'];
    $success = false;
    $user1 = findUserByEmail($email);
    $user2 = findUserByPhoneNumber($phoneNumber);
    if (!$user1&&!$user2) {
        $newUserId=register($displayName,$email,$password,$phoneNumber);
        $success=true;
    }
?>
<?php if ($success): ?>
    <body>
    <div class="custom">
            <div class="row">
                <div class="col-lg-5">
                <h1 class="faLogin">
                    facebook
                </h1>
                </div>
                <div class="col-lg-7">
                    <form action="/WebSite/BTCN08/login.php" method="POST">
                    <div class="row">
                    <div class="col-lg-5">
                        <label class="lableLogin">Email:</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="username">
                    </div>
                    <div class="col-lg-5">
                        <label class="lableLogin">Mật khẩu:</label>
                        <input type="password" class="form-control" id="exampleInputEmail1"  placeholder="Password"name="password">
                        <a href=""style="size:10px;color:black;margin-left:5px;opacity: 0.6">Quên mật khẩu?</a>
                    </div>
                    <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary btn-sm"id="loginButton">Đăng nhập</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    <div class="container">
    <div style="background: #fff;padding:30px">
    <div class="alert alert-secondary" role="alert">
            Vui lòng kiểm tra email để kích hoạt tài khoản
    </div>
    <form action="/BTCN08/activate.php" method="GET">
        <div class="form-group">
            <!-- <label for="email"><strong>Email : </strong> </label>
            <input type="text" class="form-control" placeholder="Email" name="email"> -->
            <label for="code"><strong>Mã xác minh : </strong> </label>
            <input type="text" class="form-control" placeholder="Nhập mã xác minh email" name="code">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </form>
    </div>
    </div>
    </body>
<?php else: ?>
    <body>
    <div class="custom">
            <div class="row">
                <div class="col-lg-5">
                <h1 class="faLogin">
                    facebook
                </h1>
                </div>
                <div class="col-lg-7">
                    <form action="/WebSite/BTCN08/login.php" method="POST">
                    <div class="row">
                    <div class="col-lg-5">
                        <label class="lableLogin">Email:</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="username">
                    </div>
                    <div class="col-lg-5">
                        <label class="lableLogin">Mật khẩu:</label>
                        <input type="password" class="form-control" id="exampleInputEmail1"  placeholder="Password"name="password">
                        <a href=""style="size:10px;color:black;margin-left:5px;opacity: 0.6">Quên mật khẩu?</a>
                    </div>
                    <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary btn-sm"id="loginButton">Đăng nhập</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    <div class="container">
    <div class="alert alert-danger" role="alert">
    Đăng kí thất bại. Hãy kiểm tra lại thông tin đăng kí.
    </div>
    <div style="background: #fff;padding:30px">
    <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <form action="/WebSite/BTCN08/register.php" method="post"style="margin-top :60px">
            <input name="displayName" style="margin-bottom: 15px;width:400px" type="text" class="form-control" placeholder="Họ và tên">
            <input name="email" style="margin-bottom: 15px;width:400px" type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
            <input name="password" style="margin-bottom: 15px;width:400px" type="password" class="form-control"  placeholder="Password">
            <input name="phoneNumber" style="margin-bottom: 15px;width:400px" type="text" class="form-control" placeholder="Số điện thoại">
            <button style="font-size:20px;width:400px;margin-top:20px" type="submit" class="btn btn-primary">Đăng kí</button>
        </form>
        </div>
    <div class="col-3"></div>
    </div>
    </div>
    </div>
    </body>
<?php endif; ?>

<?php endif; ?>
