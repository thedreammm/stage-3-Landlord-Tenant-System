<?php
session_start();
require_once("../php_classes/account_class.php");
require_once("../php_classes/onetime_code_class.php");
$account1 = new Account($_SESSION);
$result = $account1->loadAccount();
if($result){
    $code = new OnetimeCode($_SESSION);
    $code->loadCode();
    if($_POST['verificationcode'] == $code->code){
        $account1->verified = 1;
        $params = array('verified'=>1);
        $result = $account1->updateAccount($params);
    }
    else{
        $result = false;
    }
}
return $result;
?>