<?php
require_once("../php_classes/message_class.php");
header("Content-Type: application/json; charset=UTF-8");

$room_id = false;
if(isset($_POST['room_id'])){
    $room_id = $_POST['room_id'];
}
if($room_id){
    $new_room = new MessageRoom(false);
    $new_room->room_id = $room_id;
    $new_room->loadMessageRoom(0,20, false);    //the 20 newest ones?
    //the iv contains special characters which brick the json. also, we shoudldnt send it for security reasons.
    $new_room->removeIV();
    echo json_encode($new_room);
}
else{
    echo json_encode("room_id: " . $room_id);
}
?>
