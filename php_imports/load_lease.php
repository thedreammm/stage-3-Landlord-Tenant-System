<?php 
require_once('../php_classes/lease_class.php');
require_once('../php_classes/property_class.php');
$lease_array=[];
$summaryText = "All registered leases:";

if(isset($_SESSION['tenant_id'])){
    $lease1 = new Lease(array('tenant_id'=>$_SESSION['tenant_id']));
    $lease_array = $lease1->loadLease();
    $summaryText = "Tenant ".$_SESSION['tenant_id']."'s leases: (Clear session to see all on site)";
} else if(isset($_SESSION['landlord_id'])){
    $properties = Property::loadProperties($_SESSION);
    $i=0;
    foreach($properties as $prop){
        $lease1 = new Lease(array('property_id'=>$prop->property_id));
        $enqLease = $lease1->loadLease();
        foreach($enqLease as $entry){
            $lease_array[$i] = $entry;
            $i++;
        }
    }
    $summaryText = "Landlord ".$_SESSION['landlord_id']."'s leases: (Clear session to see all on site)";
}
else{
    $lease1 = new Lease(false);
    $lease_array = $lease1->loadLease();
}