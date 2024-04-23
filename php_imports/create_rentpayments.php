<?php
require_once("../php_classes/rentpayment_class.php");
session_start();
$landlord_id = $_SESSION['landlord_id'];

$form = json_decode(file_get_contents('php://input'));
$property_id = $form->property_id;
$tenant_id = $form->tenant_id;

$rentpayments_array = $form->rentpayments;
for($i = 0; $i < count($rentpayments_array); $i++){
    $rent_payment = $rentpayments_array[$i]->rentpayment;
    print_r($rentpayments_array);
    $post_rent = array(
        'property_id'=>$property_id,
        'tenant_id'=>$tenant_id,
        'cost'=>$rent_payment->cost,
        'date_due'=>$rent_payment->date_due,
    );
    $rent_obj = new RentPayment($post_rent);
    $rent_obj->createRentPayment();
}

?>