<?php
    require_once("../php_classes/service_provider_class.php");
    $service1 = new ServiceProvider($_POST);
    $result = $service1->createService();
    echo $result;
?>
