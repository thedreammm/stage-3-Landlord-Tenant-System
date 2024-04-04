<?php include('header.php');
if(!isset($_SESSION['landlord_id'])){header('Location: home.php');}

$db = new SQLite3('database.db');
$result = $db->query('SELECT property_id FROM Properties');
$properties = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    $properties[] = $row['property_id'];
}
///Ideally this is limited to properties this landlord owns
?>

<h1>Send notification</h1>
<form class="form" name="form">
    <label>Property?</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($properties as $propID){
            echo "<option value\"$propID\">$propID</option>";
        }?>
    </select><br>
    
    <label>Subject:</label><input class="form_input" type="text" name="subject"><br>
    <label>Object:</label><input class="form_input" type="text" name="content"><br>
</form>
<button name="create_notificationS" onclick="sendForm(this)">Send</button>
<span id="response"></span>

<?php include('footer.php')?>