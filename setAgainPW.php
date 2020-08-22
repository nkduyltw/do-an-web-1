<?php
    require_once 'init.php';
    require_once 'functions.php';
?>
<?php include 'header.php';?>

<div class="container-fluid mt-3">
<h2>Lấy lại mật khẩu</h2>
<?php if (isset($_POST['passwordlan1']) && isset($_POST['passwordlan2'])): ?>
<?php
    $passlan1= $_POST['passwordlan1'];
    $passlan2 = $_POST['passwordlan2'];
    $success = false;
    $user = $currentEmail['email'];
    $row=findUserByEmail($user);
    if($passlan1!=$passlan2)
    {
        echo '<h2> nhập lại mật khẩu không đúng </h2>';
    }
    else{
    setAgainPW($row['id'],$passlan1);
    $success=true;
    }
?>
<?php if($success): ?>
    <p class="alert alert-success" role="alert">Thành công</p>
<?php else: ?>
<p class="alert alert-danger" role="alert">Thất bại</p>
<?php endif; ?>
<?php else: ?>
    <section class="container-fluid" style=" padding : 30px">
    <section class="row justify-content-center">
        <section>
            <form class="form-container" action="/WebSite/BTCN08/setAgainPW.php" method="POST">
                <div class="form-group">
                    <label for="inputPassword" >Nhập Mât Khẩu Mới:</label>
                    <div >
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="passwordlan1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" >Nhập Lại Mật Khẩu:</label>
                    <div >
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="passwordlan2">
                    </div>
                </div>
                <button name="xacnhandoimatkhau" type="submit" class="btn btn-primary btn-block">Xác Nhận Đổi</button>
            </form>
        </section>
    </section>
</section>        
<?php endif; ?>