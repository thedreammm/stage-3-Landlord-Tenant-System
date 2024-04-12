<?php
include ('../php_imports/header.php');
if(!isset($_SESSION['account_id'])){
    header("Location: signup.php");
}
$account_id = $_SESSION['account_id'];

?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/script.js"></script>
        <script type="text/javascript" src="../js_imports/username.js"></script>
    </head>
    <body>
        <?php
            require_once('../php_imports/setup_messaging.php');
        ?>
        <div id="messages">
        </div>
        <form class="form" name="form">
            <textarea class="form_input" name="content"></textarea><br>
            <input hidden id="room_id" class="form_input" name="room_id" value=""><br>
            <input hidden class="form_input" name="account_id" value="<?php echo $account_id; ?>"><br>
        </form>
        <button name="../php_imports/send_message" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
