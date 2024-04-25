<?php require_once('../php_classes/lease_class.php'); 
require_once('../php_classes/occupancy_class.php');
require_once('../php_classes/document_class.php');
require_once('../php_classes/cost_class.php');
require_once('../php_classes/account_class.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/rentpayment_class.php');
require_once('../php_classes/notification_class.php');

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

    $cost1 = new Cost(false);
    $cost1->property_id = $lease1->property_id;
    $cost1->loadCost();

    $property1 = new Property(false);
    $property1->property_id = $lease1->property_id;
    $property1->loadProperty();
    
    
    $x = '';

    if($cost1->period == "months"){$x = 'months';} else if($cost1->period == "weeks"){$x = 'weeks';} else if($cost1->period == "years"){$x = 'years';}
    $y = $cost1->duration;

    $start = $occupancy1->beginning;
    $date = new DateTime($start);
    $date->modify('+'.$cost1->duration.' '.$x);

    $dueDate = $date->format('Y-m-d');


    $rent1 = new RentPayment(false);
    $rent1->property_id = $lease1->property_id;
    $rent1->tenant_id = $lease1->tenant_id;
    $rent1->date_due = $dueDate;
    $rent1->cost = $cost1->cost;
    
    $notification1 = new Notification(false);
    $notification1->landlord_id = $property1->landlord_id;
    $notification1->subject = "Rent Due";
    $notification1->content = '£'.$cost1->cost.' on '.$dueDate;
    $notification1->CreateNotification($rent1->tenant_id);

    $rent1->notification_id = $notification1->notification_id;
    $rent1->createRentPayment();

    Header('Location = view_leases.php');
}

?>