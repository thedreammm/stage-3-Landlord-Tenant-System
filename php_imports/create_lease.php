<?php require_once("../php_classes/lease_class.php");

session_start();
$_POST['tenant_id'] = $_SESSION['tenant_id'];

$lease1 = new Lease($_POST); 
$result = $lease1->CreateLease();


