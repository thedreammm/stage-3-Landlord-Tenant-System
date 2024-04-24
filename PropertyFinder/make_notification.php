<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
if(!isset($_SESSION['landlord_id'])){
    header('Location: home.php');
}
$properties = Property::loadProperties($_SESSION);
?>

<h1>Send notification</h1>
<form class="form" name="form">
    <label>Property</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($properties as $property):?>
            <option value="<?php echo $property->property_id; ?>"><?php echo $property->title; ?></option>";
        <?php endforeach; ?>
    </select><br>
    
    <label>Subject:</label><input class="form_input" type="text" name="subject"><br>
    <label>Object:</label><input class="form_input" type="text" name="content"><br>
</form>
<button name="../php_imports/create_notifications" onclick="sendForm(this)">Send</button>
<span id="response"></span>

<?php include('../php_imports/footer.php')?>