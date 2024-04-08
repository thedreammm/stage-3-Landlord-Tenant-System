<?php
    require_once("../php_classes/message_class.php");
    $message1 = new Message($_POST);
    $result = $message1->createMessage();
    if($result){
        echo "Success";
    }
?>