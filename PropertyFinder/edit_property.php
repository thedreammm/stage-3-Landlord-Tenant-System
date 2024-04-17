<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}

$account_id = $_SESSION['account_id'];
$property_id = false;
if(isset($_POST['property_id'])){
    $property_id = $_POST['property_id'];
    $_SESSION['edit_property'] = $property_id;
    require_once('../php_imports/load_property.php');
}

if($property_id):
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
                <select class="form_input" name="duration_unit"><!--make duration unit important-->
                    <option selected hidden disabled>Select one</option>
                    <option value="days">Days</option>
                    <option value="weeks">Weeks</option>
                    <option value="months">Months</option>
                    <option value="years">Years</option>
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
endif;
if(!$property_id):?>
    <body>
        <h1>Choose a property</h1>
        <form method="post">
            <label>Property id: </label><input type="text" name="property_id"><br>
            <input type="submit" value="submit">
        </form>
    </body>
<?php 
endif;
include('../php_imports/footer.php')
?>
