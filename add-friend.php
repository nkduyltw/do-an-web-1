
<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $userId=$_POST['id'];
    $profile=findUserById($userId);
    $nguoidung=findUserById($currentUser['id']);
    $email=$profile['email'];
    sendFriendRequest($currentUser['id'],$profile['id']);
    sendFollowRequest($currentUser['id'],$profile['id']);
    SendEmailAddFriend($nguoidung['displayName'],$profile['displayName'],$email,$currentUser['id']);
    header('Location:/WebSite/BTCN08/profile.php?id='.$userId);
?>


