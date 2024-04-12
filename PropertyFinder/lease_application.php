<?php include ('../php_imports/header.php');
if(!isset($_SESSION['tenant_id'])){
    if(isset($_SESSION['landlord_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
} 

$db = new SQLite3('../storage/database.db');
$result = $db->query('SELECT property_id FROM Properties');
$properties = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    $properties[] = $row['property_id'];
}
?>

<h1>Apply for lease</h1>
<form class="form" name="form">
    <label>Property?</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($properties as $propID){
            echo "<option value\"$propID\">$propID</option>";
        }?>
    </select><br>
</form>
<button name="../php_imports/create_lease" onclick="sendForm(this)">Send</button>
<span id="response"></span>

<?php include('../php_imports/footer.php')?>