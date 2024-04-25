<?php require_once('../php_classes/lease_class.php'); 
require_once('../php_classes/account_class.php'); 
require_once('../php_classes/occupancy_class.php');
require_once('../php_classes/document_class.php');
require_once('../php_classes/cost_class.php');
require_once('../php_classes/account_class.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/rentpayment_class.php');
require_once('../php_classes/notification_class.php');

function makeRentPayment($notification_id){
    $notification1 = new Notification(false);
    $notification1->notification_id = $notification_id;
    $notification1->loadNotification();
    
    $rent1 = new RentPayment(false);
    $rent1->notification_id = $notification1->notification_id;
    $rent1->loadRentPayment();
    $rent1->date_paid = date('Y-m-d');
    $rent1->makeRentPayment();

    $tenant1 = new Tenant(false);
    $tenant1->tenant_id = $rent1->tenant_id;
    $tenant1->GetAccountFromTID();

    $notification1->subject = "Rent Paid";
    $notification1->content = $tenant1->username." paid on ".$rent1->date_paid;
    $notification1->updatePaidNotification();

    $lease1 = new Lease(false);
    $lease1->tenant_id = $tenant1->tenant_id;
    $lease1->leaseObj();

    $cost1 = new Cost(false);
    $cost1->property_id = $lease1->property_id;
    $cost1->loadCost();

    $property1 = new Property(false);
    $property1->property_id = $lease1->property_id;
    $property1->loadProperty();

    $occupancy1 = new Occupancy(false);
    $occupancy1->lease_id = $lease1->lease_id;
    $occupancy1->loadOccupancy();
    
    $currentTimestamp = time();
    $timestamptocheck = strtotime($occupancy1->ending);

    if($timestamptocheck < $currentTimestamp){
        $rent1 = new RentPayment(false);
        $rent1->notification_id = $notification_id;
        $rent1->loadRentPayment();
        $dateDue = $rent1->date_due;
        $x = '';

        if($cost1->period == "months"){$x = 'months';} else if($cost1->period == "weeks"){$x = 'weeks';} else if($cost1->period == "years"){$x = 'years';}    
        $date = new DateTime($dateDue);
        $date->modify('+'.$cost1->duration.' '.$x);
        $dueDate = $date->format('Y-m-d');

        $rent2 = new RentPayment(false);
        $rent2->property_id = $lease1->property_id;
        $rent2->tenant_id = $lease1->tenant_id;
        $rent2->date_due = $dueDate;
        $rent2->cost = $cost1->cost;

        $notification2 = new Notification(false);
        $notification2->landlord_id = $property1->landlord_id;
        $notification2->subject = "Rent Due";
        $notification2->content = '£'.$cost1->cost.' on '.$dueDate;
        $notification2->CreateNotification($rent2->tenant_id);

        $rent2->notification_id = $notification2->notification_id;
        $rent2->createRentPayment();

        return true;
    }

    return false;

    

    
}

function makeDepositPayment(){}