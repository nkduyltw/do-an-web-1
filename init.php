<?php
require_once ('config.php');
require_once ('functions.php');
if (!session_id() && !headers_sent()) {
    session_start();
 }
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page=getPage();
$currentUser=null;

$temp=null;
$db=new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);

if(isset($_SESSION['userID'])) {
    $currentUser=findUserById($_SESSION['userID']);
}
$currentEmail=null;
if(isset($_SESSION['userEmail']))
{
    $currentEmail=findUserByEmail($_SESSION['userEmail']);
}
$currentidUser =null;
if(isset($_SESSION['idUser']))
{
    $currentidUser=findUserByidUSer($_SESSION['idUser']);
}


