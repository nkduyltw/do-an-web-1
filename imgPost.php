<?php
require_once('init.php');
require_once('functions.php');
$idNewFeed=$_GET['id'];


$img= findImgByNewFeedId($idNewFeed);

header('content-type: image/jpeg');
echo $img['image'];