<?php
    require_once 'init.php';
    require_once 'functions.php';
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
?>

<?php if(isset($_POST['content'])): ?>
<?php 
    $success=false;
    $status=$_POST['content'];
    $type=$_POST['id_privacy'];
    if($status!="")
    {
        $success=false;
        $img=null;
        if(isset($_FILES['img'])&& isset($_FILES['img']['name']))
        {
           $file=$_FILES['img'];
           $fileName=$file['name'];
           $fileSize=$file['size'];
           $fileTemp=$file['tmp_name'];
           $fileNew=resizeImage($fileTemp,480,480);
            
           ob_start();
           imagejpeg($fileNew);
           $img=ob_get_contents();
           ob_end_clean();
        }
        addStatus($currentUser['id'],$status,$img,$type);
        $success=true;
    }
?>
<?php if($success): ?>
    <?php header('Location:/WebSite/BTCN08/profile-user.php');?>
    <?php exit();?>
<?php else: ?>
    <?php include'header.php';?>
    <div class="container"id="sory">
        <h2>Xin lỗi, có gì đó không ổn</h2>
        <p>Đăng trạng thái thất bại</p>     
        <img src="sorry.gif" alt="">
        <a href="/WebSite/BTCN08/profile-user.php">Quay lại</a>
    </div>
    <?php include'footer.php';?>
<?php endif; ?>

<?php else: ?>

        
<?php endif; ?>
