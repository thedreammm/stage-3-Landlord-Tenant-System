<?php session_start();
$_SESSION = array();
session_destroy();
session_start();
header('Location: ../PropertyFinder/login.php')?>