<?php include ('notification_class.php');
 
$result;
if(isset($_SESSION['tenant_id'])){
    $noti1 = new Notification($_SESSION['tenant_id']);
    $result = $noti1->LoadNotificationTenant($_SESSION['tenant_id']);
} else if(isset($_SESSION['landlord_id'])){
    $noti1 = new Notification($_SESSION['landlord_id']);
    $result = $noti1->LoadNotificationLandlord($_SESSION['landlord_id']);
}



