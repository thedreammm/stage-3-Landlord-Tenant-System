<?php include ('../php_classes/notification_class.php');
 
$result;
if(isset($_SESSION['account_id'])){
    $result = Notification::LoadNotifications($_SESSION);
}

/*if(isset($_SESSION['tenant_id'])){
    $result = Notification::LoadNotificationTenant($_SESSION['tenant_id']);
} else if(isset($_SESSION['landlord_id'])){
    $result = Notification::LoadNotificationLandlord($_SESSION['landlord_id']);
}*/
