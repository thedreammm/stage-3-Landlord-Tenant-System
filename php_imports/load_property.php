<?php
require_once("../php_classes/account_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");

$return = false;
if(!session_status()){
    $return = true;
    session_start();
}
$landlord_id = $_SESSION['landlord_id'];

$_POST['landlord_id'] = $landlord_id;
$property1 = new Property($_POST);
$property1->loadProperty();

$address1 = new Address(false);
$address1->address_id = $property1->address_id;
$address1->loadAddress();

$cost1 = new Cost($_POST);
$cost1->loadCost();

//saving the amenities
$amenity_array = Amenity::loadAmenities($property1->property_id);

if($return){
    $property1->removeIV();
    $response = array(
        'property'=>$property1,
        'address'=>$address1,
        'cost'=>$cost1,
        'amenities'=>$amenity_array,
    );
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($response);
}
?>
