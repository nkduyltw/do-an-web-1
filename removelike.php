<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $id=$currentUser['id'];
    $id2=$_POST['id'];
    $newfeed=$_POST['idnewfeed'];
    removelike($id,$id2,$newfeed);
    header('Location:/WebSite/BTCN08/index.php');
?>