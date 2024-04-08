<?php
require_once("../php_classes/account_class.php");
session_start();
$account_id = $_SESSION['account_id'];
$account1 = new Landlord(array('account_id'=>$account_id));
$result = $account1->loadAccount();

require_once("../php_classes/property_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");

$form = json_decode(file_get_contents('php://input'));

//saving the address
$address_obj = $form->address;
$post_address = array(
    'post_code'=>$address_obj->post_code,
    'street_address'=>$address_obj->street_address,
    'county'=>$address_obj->county,
    'door_number'=>$address_obj->door_number,
);

$address_obj = new Address($post_address);
$address_obj->createAddress();

//saving the property
$post_property = array(
    'landlord_id'=>$account1->landlord_id,
    'address_id'=>$address_obj->address_id,
    'square_footage'=>$form->square_footage,
    'bedrooms'=>$form->bedrooms,
    'bathrooms'=>$form->bathrooms,
    'deposit'=>$form->deposit,
    'description'=>$form->description,
);

$property_obj = new Property($post_property);
$property_obj->createProperty();
$property_id = $property_obj->property_id;

//saving the cost
$cost_obj = $form->cost;
$post_cost = array(
    'property_id'=>$property_id,
    'cost'=>$cost_obj->cost,
    'duration'=>$cost_obj->duration,
);

$cost_obj = new Cost($post_cost);
$cost_obj->createCost();

//saving the amenities
$amenity_array = $form->amenities;
for($i = 0; $i < count($amenity_array); $i++){
    $post_amenity = array(
        'property_id'=>$property_id,
        'description'=>$amenity_array[$i]->description,
    );
    $amenity_obj = new Amenity($post_amenity);
    $amenity_obj->createAmenity();
}

?>
