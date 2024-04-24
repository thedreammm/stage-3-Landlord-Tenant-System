<?php
include ('../php_imports/header.php');
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}
$landlord_id = $_SESSION['landlord_id'];
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/rentpayment.js"></script>
    </head>
    <body>
        <h1>Add Rent payments to your property:</h1>
        <form class="form" name="form">
            <label>Property id:</label><input class="form_input" type="text" name="property_id"><br>
            <label>Tenant id:</label><input class="form_input" type="text" name="tenant_id">
            <div id="rentpayments" class="form_array" name="rentpayments">
                
            </div>
            <button type="button" onclick="addRentpayment()">+</button>
        </form>
        <button name="../php_imports/create_rentpayments" onclick="sendFormJSON(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
