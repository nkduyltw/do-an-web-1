<?php
    require_once ('init.php');
    require_once ('functions.php');
    if(!$currentUser){
        header('Location:/WebSite/BTCN08/index.php');
        exit();
    }
    $id=$currentUser['id'];
    $id2=$_POST['id'];
    $idnewfeed=$_POST['idnewfeed'];
    addlikestatus($id,$id2,$idnewfeed);
    header('Location:/WebSite/BTCN08/index.php');
?>