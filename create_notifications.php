<?php require_once("notification_class.php");

session_start();
$_POST['landlord_id'] = $_SESSION['landlord_id'];
$pID = $_POST['property_id'];
unset($_POST['property_id']);

$db = new SQLite3('database.db');
$result = $db->query("SELECT tenant_id FROM Lease_Test WHERE property_id = '$pID'");
$tIDArray = [];
while($row = $result->fetchArray(SQLITE3_ASSOC)){
    $tIDArray[]=$row['tenant_id'];
}

$noti1 = new Notification($_POST);
foreach($tIDArray as $tID){
    $noti1->CreateNotification($tID);
};
