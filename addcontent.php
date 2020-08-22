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
    $content=$_POST['content'];
    deletecontentnull($id,$id2,$idnewfeed,'');
    addcontent($id,$id2,$idnewfeed,$content);
    $outname1=findUserById($id);
    $outname2=findUserById($id2);
    header('Location:/WebSite/BTCN08/index.php');
?>