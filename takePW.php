<?php
    require_once 'init.php';
    require_once 'functions.php';
?>
<?php include 'header.php';?>

<div class="container-fluid mt-3">
<h2>Lấy lại mật khẩu</h2>
<?php if(isset($_GET['code'])): ?>
<?php
    $code=$_GET['code'];
    // $email=$_POST['email'];
    $success = false;
    $success=takePW($code);
?>
<?php if(!$success): ?>
    <?php header('Location:/WebSite/BTCN08/setAgainPW.php');?>
<?php else: ?>
<p class="alert alert-danger" role="alert">Thất bại</p>
<?php endif; ?>
<?php else: ?>
    <section class="container-fluid" style=" padding : 30px">
    <section class="row justify-content-center">
        <section>
        <form method="GET">
            <div class="form-group">
                <label for="code">mã code</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="Mã kích hoạt">
            </div>
            <button type="submit" class="btn btn-primary">xác nhận code</button>
        </form>
        </section>
    </section>
</section>       
<?php endif; ?>
<?php include 'footer.php';?>