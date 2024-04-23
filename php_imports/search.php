<?php
require_once("../php_classes/property_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");

    
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $searchField = isset($_GET['searchField']) ? $_GET['searchField'] : 'title';
    $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
    $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;
    $minBedrooms = isset($_GET['minBedrooms']) ? $_GET['minBedrooms'] : null;
    $minBathrooms = isset($_GET['minBathrooms']) ? $_GET['minBathrooms'] : null;
    $minSqft = isset($_GET['minSqft']) ? $_GET['minSqft'] : null;
    
    if($minPrice > $maxPrice){
        Header("Location = index.php");
    }
    $properties_array = [];    
    if($searchField == 'title'){        
        $properties_array = Property::searchProperty($_GET);
    } else {
        $address_array = Address::searchAddress($_GET);
        $_GET['search'] = '';
        $property_array = Property::searchProperty($_GET);
        $i = 0;
        foreach($address_array as $add){
            foreach($property_array as $prop){
                if($add->address_id == $prop->address_id){
                    $properties_array[$i] = $prop;
                }
                $i +=1;
            }
        }
    }

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
                            'duration' => $cost1->duration];
    
        $amenity_array[$i] = Amenity::loadAmenities($properties_array[$i]->property_id);
    
        $document_array[$i] = Document::loadDocuments($properties_array[$i]->property_id, "listingimage"); 
        
        for($j = 0; $j < count($document_array[$i]); $j++){
            $listing_array[$i] = $document_array[$i][$j]->displayDocument(); ///If there is more than one listing image assigned to the property, the image assigned to listing array will be the latest.
        }
        
        
    }

    require("../PropertyFinder/search_result.php");


    

    