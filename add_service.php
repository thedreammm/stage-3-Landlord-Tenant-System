<?php
require_once("account_class.php");
session_start();
$account_id = $_SESSION['account_id'];
$account1 = new Landlord(array('account_id'=>$account_id));
$result = $account1->loadAccount();
$landlord_id = false;
if($result){
    $landlord_id = $account1->landlord_id;
}
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <h1>Add a service provider's contact details</h1>
        <form class="form" name="form">
            <label>Company name:</label><input class="form_input" type="text" name="name"><br>
            <label>Email address:</label><input class="form_input" type="text" name="email"><br>
            <label>Landlord id: </label><input class="form_input" <?php if($landlord_id){ echo 'type="hidden"'; } else{ echo 'type="text"'; }?> name="landlord_id" value="<?php echo $landlord_id; ?>"><br>
        </form>
        <button name="create_service" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
