<?php
    require_once("../php_classes/service_provider_class.php");
    session_start();
    if(isset($_SESSION['landlord_id'])){
        $landlord_id = $_SESSION['landlord_id'];
        $_POST['landlord_id'] = $landlord_id;
    }
    $service1 = new ServiceProvider($_POST);
    $result = $service1->createService();
    echo $result;
?>
