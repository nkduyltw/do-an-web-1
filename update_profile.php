<?php
    require_once 'init.php';
    require_once 'functions.php';
    if(!$currentUser){
        header('Location:/BTCN08/index.php');
        exit();
    }
?>
<?php include 'header.php'?>
<h1>Thông tin cá nhân</h1>


<?php if(isset($_POST['displayName']) && isset($_POST['phoneNumber'])) :?>
    
    <?php
        $success=false;
        $avatar=$currentUser['avatar']; 
        if(isset($_FILES['img']) && isset($_FILES['img']['name']) && $_FILES['img']['size']!=0)
        {
           $file=$_FILES['img'];
           $fileName=$file['name'];
           $fileSize=$file['size'];
           $fileTemp=$file['tmp_name'];
           $fileNew=resizeImage($fileTemp,480,480);
            
           ob_start();
           imagejpeg($fileNew);
           $avatar=ob_get_contents();
           ob_end_clean();
        }

        $displayName=$_POST['displayName'];
        $phoneNumber=$_POST['phoneNumber'];
        $liveAt=$_POST['live-at'];
        $schoolLearned=$_POST['school-learned'];
        $story=$_POST['story'];
        if($displayName!=''&&$phoneNumber!='')
        {
            change_info($displayName,$avatar,$phoneNumber,$liveAt,$schoolLearned,$story,$currentUser['id']);
            $success=true;
        }
    ?>
<?php if($success): ?>
    <?php header('Location:/WebSite/BTCN08/profile-user.php');?>
    <?php exit();?>

<?php else: ?>
    <?php include'header.php';?>
    <div class="container"id="sory">
        <h2>Xin lỗi, có gì đó không ổn !</h2>
        <p>Cập nhật thất bại </p>     
        <img src="sorry.gif" alt="">
        <a href="/WebSite/BTCN08/profile-user.php">Quay lại</a>
    </div>
<?php endif; ?>

<?php else: ?>  
    <div class="container" id="update-profile">
    <form class="form-container" action="/WebSite/BTCN08/update_profile.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputPassword" >Họ tên đầy đủ</label>
            <div >
            <input type="text" class="form-control"  value="<?php echo $currentUser['displayName'];?>" name="displayName">
            </div>
            
            
            <label for="inputPassword" >Số di động</label>
            <div >
            <input type="text" class="form-control"  value="<?php echo $currentUser['phoneNumber'];?>" name="phoneNumber">
            </div>


            <label for="inputPassword" >Bạn sống ở đâu ? </label>
            <div >
            <input type="text" class="form-control" value="<?php echo $currentUser['live-at'];?>" name="live-at">
            </div>

            <label for="inputPassword" >Bạn đang đi làm hay đã học tại đâu ?</label>
            <div >
            <input type="text" class="form-control"  value="<?php echo $currentUser['school-learned'];?>" name="school-learned">
            </div>

            <label for="inputPassword" >Tiểu sử</label>
            <div>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="story"><?php echo $currentUser['story']; ?></textarea>
            </div>

            <label for="inputImage" style="margin-top:10px">Ảnh đại diện</label>
            <div>
                <input type="file" name="img">
            </div>
        </div>
        <button type="submit" class="btn btn-primary "style="margin:10px">Cập nhật</button>
    </form>
    </div>
<?php endif; ?>

<?php include 'footer.php'?>