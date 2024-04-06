<?php
session_start();
$account_id = $_SESSION['account_id'];
echo $account_id;

?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <?php
            require_once('setup_messaging.php');
        ?>
        <div id="messages">
        </div>
        <form class="form" name="form">
            <textarea class="form_input" name="content"></textarea><br>
            <input hidden id="room_id" class="form_input" name="room_id" value=""><br>
            <input hidden class="form_input" name="account_id" value="<?php echo $account_id; ?>"><br>
        </form>
        <button name="send_message" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
