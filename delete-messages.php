<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');   
        exit();
    }
    $userid=$_POST['userId2'];
    $id=$_POST['id'];
    deletemessages($id);
    header('Location:/WebSite/BTCN08/conversation.php?id='.$userid); 
?>