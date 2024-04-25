<?php 
require_once("../php_classes/notification_class.php");
require_once("../php_classes/occupancy_class.php");

session_start();
if(isset($_SESSION['landlord_id'])){
    $_POST['landlord_id'] = $_SESSION['landlord_id'];
}

$occupancies_array = Occupancy::LoadOccupancies($_POST);

for($i = 0; $i < count($occupancies_array); $i++){
    $_POST['tenant_id'] = $occupancies_array[$i]->tenant_id;
    $noti1 = new Notification($_POST);
    $noti1->CreateNotification();
};
