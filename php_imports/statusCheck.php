<?php require_once("../php_classes/lease_class.php");
require_once("../php_classes/occupancy_class.php");
require_once("../php_classes/notification_class.php");
require_once("../php_classes/rentpayment_class.php");
require_once("../php_classes/property_class.php");


    $lease1 = new Lease(false);
    $lease1->tenant_id = $_SESSION['tenant_id'];
    $lease1->loadLease();

    $occupancy1 = new Occupancy(false);
    $occupancy1->lease_id = $lease1->lease_id;
    $occupancy1->loadOccupancy();

    $property1 = new Property(false);
    $property1->property_id = $lArray[$i]->property_id;
    $pArray[] = $property1->loadPropAsArray();


        


    $account_id = $_SESSION['account_id'];
        

