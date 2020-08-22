<?php
require_once('init.php');
require_once('functions.php');
$userId=$_GET['id'];


$user= findUserById($userId);

header('content-type: image/jpeg');
echo $user['avatar'];