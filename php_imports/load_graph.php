<?php
require_once("../php_classes/rentpayment_class.php");
header("Content-Type: application/json; charset=UTF-8");

$rent_array = RentPayment::loadRentPayments($_POST);
for($i = 0; $i < count($rent_array); $i++){
    $rent_array[$i]->removeIV();
}
echo json_encode($rent_array);
?>
