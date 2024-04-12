<?php session_start();
 include ('../php_classes/lease_class.php');

$result;
if(isset($_SESSION['tenant_id'])){
    $result = Lease::getTenantLeases($_SESSION['tenant_id']);
} //else if(isset($_SESSION['landlord_id'])){
    //$result = Notification::LoadNotificationLandlord($_SESSION['landlord_id']);
//}

