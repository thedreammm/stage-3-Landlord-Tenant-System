<?php
session_start();
require_once("../php_classes/account_class.php");

$account1 = new Account($_SESSION);
$result = $account1->loadAccount();
$result = $account1->updateAccount($_POST);

return $result;