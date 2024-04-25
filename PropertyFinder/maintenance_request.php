<?php
require_once('../php_imports/header.php');
require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/lease_class.php');

if(!isset($_SESSION['tenant_id']) || isset($_SESSION['admin_id'])){
    header('Location: index.php');
    exit();
}

$properties = [];
$lease1 = new Lease($_SESSION);
$lease_array = $lease1->loadLease();
for($i = 0; $i < count($lease_array); $i++){
    if($lease_array[$i]->status == "Accepted"){
        $properties[] = $lease_array[$i]->property_id;
    }
}
?>

<h1>Make requests</h1>
<form class="form" name="form" action="../php_imports/create_request.php" method="post">
    <label>Property?</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($properties as $propID){
            echo "<option value=\"$propID\">$propID</option>";
        }?>
    </select><br>
    
    <label>Issue:</label><input class="form_input" type="text" name="issue"><br>
    <input type="hidden" name="tenant_id" value="<?php echo $_SESSION['tenant_id']?>">
    
    <input type="submit" name="submit" value="Submit">
</form>

<?php include('../php_imports/footer.php')?>