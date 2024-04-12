<?php include('../php_imports/header.php');
include('../php_imports/load_lease.php');

if(!isset($_SESSION['tenant_id'])){header('Location: home.php');}


?>

<h1>Make requests</h1>
<form class="form" name="form">
    <label>Property?</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($result as $propID){
            echo "<option value\"$propID->property_id\">$propID->property_id</option>";
        }?>
    </select><br>
    
    <label>Issue:</label><input class="form_input" type="text" name="issue"><br>
    
</form>
<button name="../php_imports/create_request" onclick="sendForm(this)">Send</button>
<span id="response"></span>

<?php include('../php_imports/footer.php')?>