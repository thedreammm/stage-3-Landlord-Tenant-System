<?php include ('../php_classes/notification_class.php');

$result;
if(isset($_SESSION['account_id'])){
    if(!isset($_SESSION['admin_id'])){
        $result = Notification::LoadNotifications($_SESSION);
    }
}
