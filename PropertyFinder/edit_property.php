<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
if(!isset($_SESSION['landlord_id']) || !isset($_SESSION['admin_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}
$property_id;
$account_id = $_SESSION['account_id'];
if(isset($_GET['pid'])){
    $property_id = $_GET['pid'];
    $_SESSION['edit_property']= $property_id;
    require_once('../php_imports/load_property.php');
} else {
    header('location: home.php');
}
?>
    <body>
        <h1>Edit property</h1>
        <form class="form" name="form">
            <label>Listing title:</label><input class="form_input" type="text" name="title" value="<?php echo $property1->title; ?>"><br>
            <div id="address" name="address">
                <h3>The address:</h3><br>
                <label>Post code: </label><output type="text" name="post_code"><?php echo $address1->post_code; ?></output><br>
                <label>Street address: </label><output type="text" name="street_address"><?php echo $address1->street_address; ?></output><br>
                <label>County: </label><output type="text" name="county"><?php echo $address1->county; ?></output><br>
                <label>Door Number: </label><output type="text" name="door_number"><?php echo $address1->door_number; ?></output><br>
                <br>
            </div>

            <label>Square footage:</label><input class="form_input" type="text" name="square_footage" value="<?php echo $property1->square_footage; ?>"><br>
            <label>Number of Bedrooms:</label><input class="form_input" type="text" name="bedrooms" value="<?php echo $property1->bedrooms; ?>"><br>
            <label>Number of bathrooms:</label><input class="form_input" type="text" name="bathrooms" value="<?php echo $property1->bathrooms; ?>"><br>
            <label>Deposit:</label><input class="form_input" type="text" name="deposit" value="<?php echo $property1->deposit; ?>"><br>

            <div id="cost" class="sub_form" name="cost">
                <label>Cost:</label><input class="form_input" type="text" name="cost" value="<?php echo $cost1->cost; ?>">
                <label> per </label> 
                <input class="form_input" type="text" name="duration" value="<?php echo $cost1->duration; ?>">
                <select class="form_input" name="period">
                    <option value="days" <?php if($cost1->period === "days") echo "selected"; ?>>Days</option>
                    <option value="weeks" <?php if($cost1->period === "weeks") echo "selected"; ?>>Weeks</option>
                    <option value="months" <?php if($cost1->period === "months") echo "selected"; ?>>Months</option>
                    <option value="years" <?php if($cost1->period === "years") echo "selected"; ?>>Years</option>
                </select><br>
            </div>

            <label>Description:</label><input class="form_input" type="textarea" name="description" value="<?php echo $property1->description; ?>"><br>
            <h3>Add Amenities</h3><br>
            <div id="amenities" class="form_array" name="amenities">
                <?php for($i = 0; $i < count($amenity_array); $i++): ?>
                    <label>Amenity:</label><input class="form_input" type="text" name="description" value="<?php echo $amenity_array[$i]->description; ?>"><br>
                <?php endfor; ?>
            </div>
            <button type="button" onclick="addAmenity()">+</button>
        </form>
        <button name="../php_imports/update_property" onclick="sendFormJSON(this)">Send</button>
        <span id="response"></span>
    </body>

<?php 

include('../php_imports/footer.php')
?>
