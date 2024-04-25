<ul>
<?php
    require_once('../php_classes/message_class.php');
    //$account_id = $_SESSION['account_id'];

    $rooms_array = MessageRoom::findRooms($account_id);
    for($i = 0; $i < count($rooms_array); $i++):
?>
<li class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700">
    <button class="text-3xl font-semibold text-gray-700" onclick="postForJson('../php_imports/load_messagingroom.php', 'messages', 'room_id=<?php echo $rooms_array[$i]; ?>')">Load Room #<?php echo $rooms_array[$i]; ?></button>
</li>
<?php
endfor;
?>
<li class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700">
    <span class="mx-4 font-medium"><button class="text-3xl font-semibold text-gray-700" onclick="postFile('../php_imports/new_messagingroom.php', 'messages', false)">New Room</button></span>
</li>
    
</ul>
