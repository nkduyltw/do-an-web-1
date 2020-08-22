<?php
    require_once 'init.php';
    require_once 'functions.php';
    if($currentUser){
        header('Location:WebSite/BTCN08/index.php');
        exit();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="/WebSite/BTCN08/facebook-new.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="style.css" />

    <title>facebook</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        </head>
  <body>

<?php if(isset($_POST['username']) && isset($_POST['password'])): ?>
<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $success=false;

     $user=findUserByEmail($username);


    if($user && $user['status']==1 && password_verify($password,$user['password'])){
        $success=true;
        $_SESSION['userID']=$user['id'];
    }
?>
<?php if($success): ?>
<?php header('Location:/WebSite/BTCN08/index.php');?>

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
                        <a href="/WebSite/BTCN08/forgot_PassWord.php"style="size:10px;color:black;margin-left:5px;opacity: 0.6">Quên mật khẩu?</a>
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
    <p class="alert alert-danger" role="alert">Đăng nhập thất bại</p>
        <div class="row" style="background: #fff !important;padding:100px">
            <div class="col-3"></div>
            <div class="col-6">
            <form action="/WebSite/BTCN08/login.php" method="POST">
                <label class="">Email:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="username"style="margin-bottom:20px">
                <label class="">Mật khẩu:</label>
                <input type="password" class="form-control" id="exampleInputEmail1"  placeholder="Password"name="password"style="margin-bottom:20px">
                <a href="/WebSite/BTCN08/forgot_PassWord.php"style="size:10px;color:black;margin-left:5px;opacity: 0.6">Quên mật khẩu?</a>
                <button type="submit" class="btn btn-primary btn-sm"style="margin-top:20px;margin-left:300px">Đăng nhập</button>
            </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    
        </body>
<?php endif; ?>

<?php endif; ?>
