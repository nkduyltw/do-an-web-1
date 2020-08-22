<?php
    require_once 'init.php';
    require_once 'functions.php';

    unset($_SESSION['userID']);
    header('Location:/WebSite/BTCN08/index.php');
    exit();
?>