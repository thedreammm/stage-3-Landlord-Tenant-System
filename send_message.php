<?php
    require_once("message_class.php");
    $message1 = new Message($_POST);
    $result = $message1->createMessage();
    if($result){
        echo "Success";
    }
?>