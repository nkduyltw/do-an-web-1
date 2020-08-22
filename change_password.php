<?php
    require_once 'init.php';
    require_once 'functions.php';
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
?>
<?php include 'header.php'?>

<?php if(isset($_POST['oldPassword']) && isset($_POST['newPassword'])) :?>

<?php
    $oldPassword=$_POST['oldPassword'];
    $newPassword=$_POST['newPassword'];
    
    $success=false;
    if(password_verify($oldPassword,$currentUser['password']))
    {
        if(!password_verify($newPassword,$currentUser['password']))
        {
            change_password($newPassword,$currentUser['id']);
            $success=true;
        }
    }
?>
<?php if($success): ?>
    <div class="container"style="margin-top:70px"><p class="alert alert-success" role="alert">Đổi mât khẩu thành công</p></div>

<?php else: ?>
    <div class="container"style="margin-top:70px"><p class="alert alert-danger" role="alert">Đổi mât khẩu thất bại</p></div>

<?php endif; ?>
<?php else: ?>
    <section class="container" style=" padding : 70px;margin-top:70px; background-color:  #fff">
        <section class="row justify-content-center">
            <section>
                <form class="form-container" action="/WebSite/BTCN08/change_password.php" method="POST">
                    <div class="form-group">
                        <label for="inputPassword" >Nhập mật khẩu cũ:</label>
                        <div >
                        <input type="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu cũ" name="oldPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" >Nhập mật khẩu mới:</label>
                        <div >
                        <input type="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu mới" name="newPassword">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Thay đổi</button>
                </form>
            </section>
        </section>
    </section>
<?php endif; ?>
<?php include 'footer.php'?>