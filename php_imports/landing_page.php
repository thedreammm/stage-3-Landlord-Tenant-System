<?php
require_once("../php_classes/account_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");
require_once("../php_classes/document_class.php");

$params = [];

$properties_array = Property::loadAllProperties($params);

for($i = 0; $i < count($properties_array); $i++){

    $address1 = new Address(false);
    $address1->address_id = $properties_array[$i]->address_id;
    $address1->loadAddress();
    $address_array[$i] = ['post_code' => $address1->post_code,
                          'street_address' => $address1->street_address,
                           'county' => $address1->county,
                            'door_number' => $address1->door_number];  

    $cost1 = new Cost(false);
    $cost1->property_id = $properties_array[$i]->property_id;
    $cost1->loadCost();
    $cost_array[$i] = [
                        'cost' => $cost1->cost,
                        'duration' => $cost1->duration,
                        'period' => $cost1->period];

    $amenity_array[$i] = Amenity::loadAmenities($properties_array[$i]->property_id);

    $document_array[$i] = Document::loadDocuments($properties_array[$i]->property_id, "listingimage"); 
    
    for($j = 0; $j < count($document_array[$i]); $j++){
        $listing_array[$i] = $document_array[$i][$j]->displayDocument(); ///If there is more than one listing image assigned to the property, the image assigned to listing array will be the latest.
    }
    
    
}

?>
