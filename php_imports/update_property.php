<?php
require_once("../php_classes/account_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");

session_start();

$landlord_id = $_SESSION['landlord_id'];
$property_id = $_SESSION['edit_property'];
unset($_SESSION['edit_property']);

$form = json_decode(file_get_contents('php://input'));

//updating the address
//except you're not allowed to!!!! 0_0
//$address_obj = $form->address;
//$post_address = array(
//    'post_code'=>$address_obj->post_code,
//    'street_address'=>$address_obj->street_address,
//    'county'=>$address_obj->county,
//    'door_number'=>$address_obj->door_number,
//);

//$address_obj = new Address($post_address);
//$address_obj->updateAddress();

//updating the property
$post_property = array(
    'landlord_id'=>$landlord_id,
    'title'=>$form->title,
    'square_footage'=>$form->square_footage,
    'bedrooms'=>$form->bedrooms,
    'bathrooms'=>$form->bathrooms,
    'deposit'=>$form->deposit,
    'description'=>$form->description,
);

$property_obj = new Property(false);
$property_obj->property_id = $property_id;
$property_obj->loadProperty();
$property_obj->updateProperty($post_property);

//updating the cost
$cost_obj = $form->cost;
$post_cost = array(
    'property_id'=>$property_id,
    'cost'=>$cost_obj->cost,
    'duration'=>$cost_obj->duration,
);

$cost_obj = new Cost(false);
$cost_obj->property_id = $property_id;
$cost_obj->loadCost();
$cost_obj->updateCost($post_cost);

//updating the amenitites
$post_amenities = $form->amenities;
Amenity::updateAmenities($property_id, $post_amenities);

?>
