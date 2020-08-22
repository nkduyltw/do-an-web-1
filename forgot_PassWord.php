<?php
    require_once 'init.php';
    require_once 'functions.php';
?>
<?php include 'header.php'?>
<h1>Quên mật khẩu</h1>
<?php if(isset($_POST['xacnhan'])): ?>
<?php
    $email=$_POST['email'];
    $success=false;

    $user=findUserByEmail($email);


    if($user && $user['status']==1)
    {
        forgotPW($user['email'],$user['displayName'],$user['id']);
        $_SESSION['userEmail']= $user['email'];
        $success=true;
    }
?>
<?php if($success): ?>
    <p class="alert alert-success" role="alert">Kiểm tra email kích hoạt</p>

<?php else: ?>
    <p class="alert alert-danger" role="alert">không tìm thấy người dùng</p>
<?php endif; ?>


<?php else: ?>
    <section class="container" style=" padding : 30px">
        <section class="row justify-content-center">
            <section>
                <form class="form-container" action="/WebSite/BTCN08/forgot_PassWord.php" method="POST">
                    <div class="form-group">
                        <label for="inputPassword" >Email:</label>
                        <div >
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email">
                        </div>
                    </div>
                    <button type="submit" name ="xacnhan"class="btn btn-primary btn-block">Xác nhận</button>
                </form>
            </section>
        </section>
    </section>
<?php endif; ?>
<?php include 'footer.php'?>