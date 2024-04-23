<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/document_class.php');
if(!isset($_GET['pid'])){
    header("Location: index.php");
}
if(isset($_SESSION['account_id'])){
    $account_id = $_SESSION['account_id'];
}
$property_id = $_GET['pid'];
require_once('../php_imports/load_property.php');


$document_array = Document::loadDocuments($property_id, "listingimage");
$display_array = array();
for($i = 0; $i < count($document_array); $i++){
    $display_array[$i] = $document_array[$i]->displayDocument();
}

?>
    <body>
        <h1><?php echo $property1->title; ?></h1>
        <div name="images">
        <?php
            for($i = 0; $i < count($display_array); $i++){
                echo $display_array[$i];
            }
        ?>
        </div>
        <div id="address" name="address">
            <label>Post code: <?php echo $address1->post_code; ?></label><br>
            <label>Street address: <?php echo $address1->street_address; ?></label><br>
            <label>County: <?php echo $address1->county; ?></label><br>
            <label>Door Number: <?php echo $address1->door_number; ?></label><br>
            <br>
        </div>
        <div id="cost" class="sub_form" name="cost">
            <label>Cost: £<?php echo $cost1->cost; ?> per <?php echo $cost1->duration; ?> Weeks</label>
        </div>
        <div>
            <label><?php echo $property1->square_footage; ?> Square foot</label><br>
            <label><?php echo $property1->bedrooms; ?> bedrooms</label><br>
            <label><?php echo $property1->bathrooms; ?> bathrooms</label><br>
            <label>£<?php echo $property1->deposit; ?> deposit</label><br>
            <label><?php echo $property1->description; ?></label>
        </div>
        <?php if(count($amenity_array)>0): ?>
        <div id="amenities" class="form_array" name="amenities">
            <ul>Amenities:
            <?php for($i = 0; $i < count($amenity_array); $i++): ?>
                <li><?php echo $amenity_array[$i]->description; ?></li>
            <?php endfor; ?>
            </ul>
        </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['account_id'])): ?>
        <form method="post" action="upload_documents.php" enctype="multipart/form-data">
            <h1><label for="imageSubmission" onclick="makedisplay('hiddensubmit')" style="color:blue">Submit a rental application</label></h1><input id="hiddensubmit" type="hidden" name="submit" value="submit">
            <input type="hidden" name="document_type" value="rentalapplication"><br>
            <input hidden type="file" id="imageSubmission" name="imageSubmission[]" accept="image/jpeg, application/pdf" multiple><br>
            
            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>"><br>
            <input type="hidden" name="account_id" value="<?php echo $account_id; ?>"><br>            
        </form>
        <?php endif; ?>
    </body>
<?php 


include('../php_imports/footer.php')
?>
