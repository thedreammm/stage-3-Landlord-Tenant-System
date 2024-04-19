<?php require_once('../php_classes/lease_class.php'); 
require_once('../php_classes/occupancy_class.php');
require_once('../php_classes/document_class.php');
require_once('../php_classes/account_class.php');
require_once('../php_classes/property_class.php');

if(isset($_GET['lid'])){
    $lease1 = Lease::getLeaseByID($_GET['lid']);

    $property1 = new Property(false);
    $property1->property_id = $lease1->property_id;
    $property1->loadProperty();

    $document1 = new Document(false);
    $document1->property_id = $lease1->property_id;
    $document1->loadDocument();

    $tenant1 = new Tenant(false);
    $tenant1->tenant_id = $lease1->tenant_id;
    $tenant1->GetAccountFromTID();
}

if(isset($_POST['Rejected'])){
    $lease1 = Lease::getLeaseByID($_POST['lid']);
    $lease1->ResultLease($_POST['Rejected']);
    Header('Location = view_leases.php');
} else if(isset($_POST['Accepted'])){
    $lease1 = Lease::getLeaseByID($_POST['lid']);
    $lease1->ResultLease($_POST['Accepted']);

    $occupancy1 = new Occupancy(false);
    $occupancy1->lease_id = $lease1->lease_id;
    $occupancy1->beginning = $_POST['beginning'];
    $occupancy1->ending = $_POST['ending'];
    $occupancy1->CreateOccupancy();

    Header('Location = view_leases.php');
}

?>