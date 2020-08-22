
<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $userId=$_POST['id'];
    $profile=findUserById($userId);
    removeFollowRequest($currentUser['id'],$profile['id']);
    header('Location:/WebSite/BTCN08/profile.php?id='.$userId);
?>


