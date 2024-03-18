<?php
    require_once("account_class.php");

    $account1 = new Account($_POST);
    $result = $account1->createAccount();
    echo $result;
?>
