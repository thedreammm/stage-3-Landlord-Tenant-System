<?php include ('../php_imports/header.php');
include('../php_imports/create_lease.php');
if(!isset($_SESSION['tenant_id'])){
    if(isset($_SESSION['landlord_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
} 

?>

<h1>Apply for lease</h1>
<form class="form" name="form" method="post" enctype="multipart/form-data">
    <label>Property?</label>
    <select class="form_input" name="property_id">
        <option selected hidden disabled>Select one</option>
        <?php foreach ($properties as $propID){
            echo "<option value=\"$propID\">$propID</option>";
        }?>
    </select><br>
    <input type="file" id="imageSubmission" name="imageSubmission[]" accept="image/jpeg, application/pdf" multiple><br>
    <input type="submit" name="submit" value="submit">
</form>
<span id="response"></span>



<?php include('../php_imports/footer.php')?>