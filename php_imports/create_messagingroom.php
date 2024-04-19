<?php
require_once("../php_classes/account_class.php");
require_once("../php_classes/message_class.php");

$form = json_decode(file_get_contents('php://input'));
$username_array = $form->usernames;
$account_array = Account::loadAccounts($username_array);

$new_room = new MessageRoom(false);
$new_room->createMessageRoom();
$result = $new_room->addParticipants($account_array);
return $result;
?>