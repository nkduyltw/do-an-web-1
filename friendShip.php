<?php
    require_once 'init.php';
    require_once 'functions.php';
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/loginAndRegister.php');
        exit();
    }
?>
<?php include 'header.php'?>
<div class="container" style="margin-top:70px">
<div style="background-color: #fff;padding:50px">
<h2>Danh sách bạn bè</h2>
<?php $list=getFriends($currentUser['id']); ?>
<?php foreach($list as $item):?>
    <div class="friends"style="margin-bottom:10px">
        <?php $user= findUserById($item['id'])?>
        <div class="row">
        <div class="col-1">
            <?php if($user['avatar']): ?>
            <img src="/WebSite/BTCN08/avatar.php?id=<?php echo $user['id']; ?>"class="rounded-circle" alt="Cinque Terre" width="60px" height="60px"style="margin-left:10px">
            <?php else: ?>
            <img src="no-avatar.jpg"class="rounded-circle" alt="Cinque Terre" width="50px" height="50px"style="margin-left:10px">
            <?php endif;?>
        </div>
        <div class="col"style="margin-top:20px">
            <a href="/WebSite/BTCN08/profile.php?id=<?php echo $user['id']; ?>"><strong id="displayName"> <?php echo $user['displayName']; ?> </strong></a> 
        </div>
        </div>
    </div>
<?php endforeach;?>
</div>
</div>
<?php include 'footer.php'?>