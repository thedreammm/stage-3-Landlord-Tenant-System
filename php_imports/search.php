<?php
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");
require_once("../php_classes/address_class.php");
require_once("../php_classes/cost_class.php");
require_once("../php_classes/amenity_class.php");

    $diag ='Start: ';
    $x = 0;
    $result = [];
    $errorMesage = '';
    $add_sql_statement = '';
    $add_id_array = [];
    $tInput = [];
    if($_POST['title']==''){unset($_POST['title']);} else {$tInput['title'] = $_POST['title']; $wildInput = "%".$tInput['title']."%";$_POST['title'] = $wildInput;}

    if($_POST['street_address']==''){unset($_POST['street_address']);} else {$tInput['street_address'] = $_POST['street_address']; $wildInput = "%".$tInput['street_address']."%";$_POST['street_address'] = $wildInput;}

    if($_POST['post_code']==''){unset($_POST['post_code']);} else {$tInput['post_code'] = $_POST['post_code']; $wildInput = "%".$tInput['post_code']."%";$_POST['post_code'] = $wildInput;}

    if($_POST['county']==''){unset($_POST['county']);} else {$tInput['county'] = $_POST['county']; $wildInput = "%".$tInput['county']."%";$_POST['county'] = $wildInput;}

    if(isset($_POST['minPriceCheckbox']) && isset($_POST['maxPriceCheckbox']) && !empty($_POST['minPrice']) && !empty($_POST['minPrice'])){
        if(intval($_POST['minPrice']) > intval($_POST['maxPrice'])){
            $_POST['minPrice'] = '';
            $_POST['maxPrice'] = '';
            $errorMessage = "Minimum Price was set to greater than maximum price and was therefore Excluded from results.<br>";
        }
    }
    if(!isset($_POST['minPriceCheckbox']) || empty($_POST['minPrice'])){
        unset($_POST['minPrice']);
    }
    if(!isset($_POST['maxPriceCheckbox']) || empty($_POST['maxPrice'])){
        unset($_POST['maxPrice']);
    }
    if(!isset($_POST['minBedroomsCheckbox']) || empty($_POST['minBedrooms'])){
        unset($_POST['minBedrooms']);
    }
    if(!isset($_POST['minBathroomsCheckbox']) || empty($_POST['minBathrooms'])){
        unset($_POST['minBathrooms']);
    }
    if(!isset($_POST['minSqftCheckbox']) || empty($_POST['minSqft'])){
        unset($_POST['minSqft']);
    }
    ///cost all are set or none are
    if(empty($_POST['cost']) || empty($_POST['duration'])){unset($_POST['cost']); unset($_POST['duration']);}
    
    
    
    ///Address search
    if(isset($_POST['street_address']) || isset($_POST['post_code']) || isset($_POST['county'])){
        $add_array = Address::searchAddress($_POST);        
    }
    
    if(!empty($add_array)){
        for($i = 0; $i < count($add_array); $i++){
            $_POST['address_id'] = $add_array[$i]->address_id;
            $search_result = Property::searchProperty($_POST);
            if(!empty($search_result)){
                $add_res_array[$i] = $search_result[0]->address_id;
            }            
        }        
        unset($_POST['address_id']);
          
        $add_id_array[] = Property::searchPropByAdds($add_res_array);
    }
    if(!empty($add_id_array)){
        $x += 1;
    }
    $cost_id_array = [];
    if(isset($_POST['cost'])){
        $cost_id_array[] = Cost::searchCost($_POST);
    }
    if(!empty($cost_id_array)){
        $x += 1;
    }
    
    $prop_array = []; 
    $prop_id_array = [];
    if(isset($_POST['title'])){        
        $prop_array = Property::searchProperty($_POST);
        for($i=0;$i<count($prop_array);$i++){
            $prop_id_array[]=$prop_array[$i]->property_id;
        }

    }
    if(!empty($prop_id_array)){
        $x += 1;
    }
    
    $result_search = [];
    function mergeArraysRecursive($arrays) {
        $merged = [];
        foreach ($arrays as $array) {
            if (is_array($array)) {
                $merged = array_merge($merged, mergeArraysRecursive($array));
            } else {
                $merged[] = $array;
            }
        }
        return $merged;
    }
    $prep_arrays = [];
    foreach([$prop_id_array, $cost_id_array,$add_id_array] as $array){
        if(!empty($array)){
            $prep_arrays[] = $array;
        }
    }
    $result_array = array_merge($prep_arrays);
    
    $result_search = mergeArraysRecursive($result_array);
    $result_final = [];

    function filterByOccurrenceCount($array, $minOccurrences) {
        $occurrences = array_count_values($array);        
        $filteredNumbers = [];
        foreach ($occurrences as $number => $count) {
            if ($count >= $minOccurrences) {
                $filteredNumbers[] = $number;
            }
        }
        
        return $filteredNumbers;
    }

    $result_final = filterByOccurrenceCount($result_search, $x);

    $properties_array = Property::searchByPID($result_final);
    
    
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
   
    if(isset($_POST['title'])){ $_POST['title'] = $tInput['title'];}
    if(isset($_POST['street_address'])){ $_POST['street_address'] = $tInput['street_address'];}
    if(isset($_POST['post_code'])){ $_POST['post_code'] = $tInput['post_code'];}
    if(isset($_POST['county'])){ $_POST['county'] = $tInput['county'];}
    


    

    