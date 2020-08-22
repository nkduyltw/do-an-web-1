<?php
    require_once 'init.php';
    require_once 'functions.php';
?>
<?php include 'header.php';?>

<div class="container-fluid mt-3">
<h2>Kích hoạt tài khoản</h2>
<?php if(isset($_GET['code'])  ): ?>
<?php
    $code=$_GET['code'];
    // $email=$_POST['email'];
    $success=ativateUser($code);
?>
<?php if($success): ?>
    <p class="alert alert-success" role="alert">Kích hoạt thành công</p>
<?php else: ?>
    <p class="alert alert-danger" role="alert">Kích hoạt thất bại</p>
<?php endif; ?>
<?php else: ?>
<form action="/WebSite/BTCN08/activate.php" method="GET">

<div class="form-group">
    <!-- <label for="email"><strong>Email : </strong> </label>
    <input type="text" class="form-control" placeholder="Email" name="email"> -->
    <label for="code"><strong>Mã xác minh : </strong> </label>
    <input type="text" class="form-control" placeholder="Nhập mã xác minh email" name="code">
    <button type="submit" class="btn btn-primary">Xác nhận</button>
</div>
</form>         
<?php endif; ?>
<?php include 'footer.php';?>