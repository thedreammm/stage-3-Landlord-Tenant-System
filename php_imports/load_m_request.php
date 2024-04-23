<?php 
require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/service_provider_class.php');
$request_array=[];
$summaryText = "All maintenance:";


if(isset($_SESSION['tenant_id'])){
    $maintenance1 = new Maintenance(array('tenant_id'=>$_SESSION['tenant_id']));
    $request_array = $maintenance1->LoadRequest();
    $summaryText = "Tenant ".$_SESSION['tenant_id']."'s Requests: (Clear session to see all on site)";
} else if(isset($_SESSION['landlord_id'])){
    $properties = Property::loadProperties($_SESSION);
    $i=0;
    foreach($properties as $prop){
        $maintenance1 = new Maintenance(array('property_id'=>$prop->property_id));
        $enqReq = $maintenance1->LoadRequest();
        foreach($enqReq as $entry){
            $request_array[$i] = $entry;
            $i++;
        }
    }
    $summaryText = "Landlord ".$_SESSION['landlord_id']."'s Maintenance Request: (Clear session to see all on site)";
}
else if(isset($_SESSION['admin_id'])){
    $maintenance1 = new Maintenance(false);
    $request_array = $maintenance1->LoadRequest();
}
else {
    $maintenance1 = new Maintenance(false);
    $request_array = $maintenance1->LoadRequest();
}