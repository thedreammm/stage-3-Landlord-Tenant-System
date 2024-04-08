<?php include ('notification_class.php');
 
$result;
if(isset($_SESSION['tenant_id'])){
    $result = Notification::LoadNotificationTenant($_SESSION['tenant_id']);
} else if(isset($_SESSION['landlord_id'])){
    $result = Notification::LoadNotificationLandlord($_SESSION['landlord_id']);
}
