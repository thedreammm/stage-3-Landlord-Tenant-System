<?php
    require_once("account_class.php");

    $account1 = new Account($_POST);
    $result = $account1->loadAccount();

    session_start();
    $_SESSION['account_id'] = $account1->account_id;
?>
