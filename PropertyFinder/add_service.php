<?php
include ('../php_imports/header.php');

require_once("../php_classes/account_class.php");
if(!isset($_SESSION['landlord_id']) || !isset($_SESSION['admin_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}
$landlord_id = $_SESSION['landlord_id'];
?>
    <body>
        <h1>Add a service provider's contact details</h1>
        <form class="form" name="form">
            <label>Company name:</label><input class="form_input" type="text" name="name"><br>
            <label>Email address:</label><input class="form_input" type="text" name="email"><br>
            <label>Phone number:</label><input class="form_input" type="text" name="phone"><br>
            <input class="form_input" type="hidden" name="landlord_id" value="<?php echo $landlord_id; ?>"><br>
        </form>
        <button name="../php_imports/create_service" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>

<?php include('../php_imports/footer.php')?>
