<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/document_class.php');
require_once("../php_classes/address_class.php");
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: index.php');
    }else{
        header("Location: signup.php");
    }
}

$account_id = $_SESSION['account_id'];
$property_id = false;

if(isset($_POST['property_id'])){
    $property_id = $_POST['property_id'];
    $_POST['landlord_id'] = $_SESSION['landlord_id'];
    $property1 = new Property($_POST);
    $property1->loadProperty();

    $address1 = new Address(false);
    $address1->address_id = $property1->address_id;
    $address1->loadAddress();
}

$document_array = Document::loadDocuments($property_id, "rentalapplication");
$display_array = array();
for($i = 0; $i < count($document_array); $i++){
    $display_array["id:" . $document_array[$i]->account_id][] = $document_array[$i]->displayDocument();
}

if($property_id):
?>
    <body>
        <h1><?php echo $property1->title; ?></h1>

        <div id="address" name="address">
            <label>Post code: <?php echo $address1->post_code; ?></label><br>
            <label>Street address: <?php echo $address1->street_address; ?></label><br>
            <label>County: <?php echo $address1->county; ?></label><br>
            <label>Door Number: <?php echo $address1->door_number; ?></label><br>
            <br>
        </div>
        <div name="images">
        <?php
            foreach($display_array as $id => $application_array){
                echo '<label>Applicant ' . $id . '</label><br>';
                for($i = 0; $i < count($application_array); $i++){
                    echo $application_array[$i];
                }
                echo '<br><br>';
            }
        ?>
        </div>
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
