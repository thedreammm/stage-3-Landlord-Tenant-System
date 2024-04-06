<ul>
<?php
    require_once('message_class.php');
    //$account_id = $_SESSION['account_id'];

    $rooms_array = MessageRoom::findRooms($account_id);
    for($i = 0; $i < count($rooms_array); $i++):
?>
<li>
    <button onclick="postForJson('load_messagingroom.php', 'messages', 'room_id=<?php echo $rooms_array[$i]; ?>')">Load Room #<?php echo $rooms_array[$i]; ?></button>
</li>
<?php
endfor;
?>
