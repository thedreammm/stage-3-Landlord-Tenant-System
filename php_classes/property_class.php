<?php
require_once("databaseEntity_class.php");

Class Property extends DatabaseEntity{
    public $property_id, $landlord_id, $address_id, $title, $square_footage, $bedrooms, $bathrooms, $deposit, $verified, $description;

    function __construct($params){
        parent::__construct("Properties");
        $this->unpack($params);
    }

    function validInsert(){
        if($this->landlord_id == null || $this->address_id == null){
            return false;
        }
        else{
            return true;
        }
    }

    static function loadPropID(){
        $db = new SQLite3('../storage/database.db');
        $result = $db->query('SELECT property_id FROM Properties');
        $propID = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)){
            $propID[] = $row['property_id'];
        }
        return $propID;
    }

    static function searchPropByAdds($addressIds) {
    $db = new SQLite3('../storage/database.db');
    $sql = "SELECT * FROM Properties WHERE verified = 1";
    if (!empty($addressIds)) {
        $placeholders = implode(' OR ', array_fill(0, count($addressIds), 'address_id = ?'));
        $sql .= " AND (" . $placeholders . ")";
    }

    $stmt = $db->prepare($sql);
    $obj = new Property(false);

    foreach ($addressIds as $key => $addressId) {
        $addressInp = $obj->encryptUnique($addressId);
        $stmt->bindValue($key, $addressInp, SQLITE3_TEXT); 
    }

    $result = $stmt->execute();

    $properties = [];
    $i = 0;
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $property = new Property(false);
        $property->decryptValues($row);
        $properties[] = $property->property_id;
        $i+=1;
    }

    return $properties;
}

    static function searchByPID($PID) {
        $db = new SQLite3('../storage/database.db');   
        $sql = "SELECT * FROM Properties WHERE verified = 1";
    
        if (!empty($PID)) {            
            $placeholders = implode(' OR ', array_fill(0, count($PID), 'property_id = ?'));    
            $sql .= " AND (" . $placeholders . ")";
        }
    
        $stmt = $db->prepare($sql);
    
        foreach ($PID as $key => $PID) {
            $stmt->bindValue($key + 1, $PID, SQLITE3_INTEGER); 
        }    
    
        $result = $stmt->execute();
        $i = 0;
        $properties = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $properties[$i] = new Property(false);
            $properties[$i]->decryptValues($row);
            $i+=1;
        }
    
        return $properties;
    }
    static function loadUnVerProp(){
        $prop_result = [];
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Properties WHERE verified=0';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
        $i = 0;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $prop_result[$i] = new Property(false);
            $prop_result[$i]->decryptValues($row); 
            $i+= 1;
        }
        return $prop_result;
    }
    
    function verifyProp(){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Properties SET verified=1 WHERE property_id=:property_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result;
    }

    static function loadAllProperties($params){

        $properties_array = array();
        if(isset($params['property_id'])){
            $db = new SQLite3('../storage/database.db');
            for($i = 0; $i < count($params['property_id']); $i++){
                $properties_array[$i] = new Property(false);
                $properties_array[$i]->property_id = $params['property_id'][$i];
                $properties_array[$i]->loadProperty();
            }
        }
        else{
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Properties WHERE verified=1';
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();
        
            $i = 0;
            while($row = $result->fetchArray()){
                $properties_array[$i] = new Property(false);
                $properties_array[$i]->decryptValues($row);
                $i += 1;
            }
        }
        return $properties_array;
    }

    static function loadProperties($params){
        $properties_array = array();
        if(isset($params['landlord_id'])){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Properties WHERE landlord_id=:landlord_id';
            $stmt = $db->prepare($sql);
            
            $obj = new Property(false);
            $landlord_id = $obj->encryptUnique($params['landlord_id']);

            $stmt->bindParam(':landlord_id', $landlord_id, SQLITE3_TEXT);
            $result = $stmt->execute();
        } else if(isset($params['property_id'])){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Properties WHERE property_id=:property_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $params['property_id'], SQLITE3_INTEGER);
            $result = $stmt->execute();
        }

            $i = 0;
            while($row = $result->fetchArray()){
                $properties_array[$i] = new Property(false);
                $properties_array[$i]->decryptValues($row);
                $i += 1;
            }
        
        return $properties_array;
    }

    function loadProperty(){
        if($this->property_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Properties WHERE property_id=:property_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->decryptValues($row);
            return true;
        }
    }
    static function searchProperty($input){
        $db = new SQLite3('../storage/database.db');
        $sql = "SELECT * FROM Properties WHERE verified = 1";
        $result_array = [];
        $conditions = [];
    
        if(isset($input['title'])) {
            $conditions[] = "title LIKE :title";
        }
        if (isset($input['minPrice'])){
            $conditions[] = "deposit >= :minDeposit";
        }
        if (isset($input['maxPrice'])){
            $conditions[] = "deposit <= :maxDeposit";
        }
        if (isset($input['minBedrooms'])){
            $conditions[] = "bedrooms >= :minBedrooms";
        }
        if (isset($input['minBathrooms'])){
            $conditions[] = "bathrooms >= :minBathrooms";
        }
        if (isset($input['minSqft'])){
            $conditions[] = "square_footage >= :square_footage";
        }
        if (isset($input['address_id'])){
            
            $conditions[] = "address_id = :address_id";
        }
    
        // Construct the WHERE clause if there are conditions
        if (!empty($conditions)) {
            $sql .= " AND ".implode(" AND ", $conditions);
        }
    
        $stmt = $db->prepare($sql);
        if(isset($input['title'])){
            $stmt->bindParam(':title', $input['title'], SQLITE3_TEXT); 
        }
        if (isset($input['minPrice'])){
            $stmt->bindParam(':minDeposit', $input['minPrice'], SQLITE3_FLOAT);
        }
        if (isset($input['maxPrice'])){
            $stmt->bindParam(':maxDeposit', $input['maxPrice'], SQLITE3_FLOAT);
        }
        if (isset($input['minBedrooms'])){
            $stmt->bindParam(':minBedrooms', $input['minBedrooms'], SQLITE3_INTEGER);
        }
        if (isset($input['minBathrooms'])){
            $stmt->bindParam(':minBathrooms', $input['minBathrooms'], SQLITE3_INTEGER);
        }
        if (isset($input['minSqft'])){
            $stmt->bindParam(':square_footage', $input['minSqft'], SQLITE3_FLOAT);
        }
        if(isset($input['address_id'])){
            $obj = new Property(false);;
            $address = $obj->encryptUnique($input['address_id']);
            $stmt->bindParam(':address_id', $address, SQLITE3_TEXT);
        }
    
        $result = $stmt->execute();
    
        $i = 0;
        
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            $result_array[$i] = new Property(false);    
            $result_array[$i]->decryptValues($row);
            $i += 1;
        }
        return $result_array;
        
    }

    

    function createProperty(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Properties(landlord_id, address_id, title, square_footage, bedrooms, bathrooms, deposit, verified, description, iv) VALUES(:landlord_id, :address_id, :title, :square_footage, :bedrooms, :bathrooms, :deposit, :verified, :description, :iv)';

        $stmt = $db->prepare($sql);

        $iv = $this->createIV();
        $this->iv = $iv;
        $landlord_id = $this->encryptUnique($this->landlord_id);
        $address_id = $this->encryptUnique($this->address_id);
        $title = $this->title;
        $square_footage = $this->square_footage;
        $bedrooms = $this->bedrooms;
        $bathrooms = $this->bathrooms;
        $deposit = $this->deposit;
        if(!isset($this->verified)){$verified = 0;}else{$verified = $this->verified;}      
        $description = $this->description;

        $stmt->bindParam(':landlord_id', $landlord_id, SQLITE3_TEXT);
        $stmt->bindParam(':address_id', $address_id, SQLITE3_TEXT);
        $stmt->bindParam(':title', $title, SQLITE3_TEXT);
        $stmt->bindParam(':square_footage', $square_footage, SQLITE3_INTEGER);
        $stmt->bindParam(':bedrooms', $bedrooms, SQLITE3_INTEGER);
        $stmt->bindParam(':bathrooms', $bathrooms, SQLITE3_INTEGER);
        $stmt->bindParam(':deposit', $deposit, SQLITE3_INTEGER);
        $stmt->bindParam(':verified', $verified, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->property_id = $db->lastInsertRowID();
        return true;
    }

    function updateProperty($params){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Properties SET title=:title, square_footage=:square_footage, bedrooms=:bedrooms, bathrooms=:bathrooms, deposit=:deposit, description=:description WHERE property_id=:property_id';

        $stmt = $db->prepare($sql);

        $title = $params['title'];
        $square_footage = $params['square_footage'];
        $bedrooms = $params['bedrooms'];
        $bathrooms = $params['bathrooms'];
        $deposit = $params['deposit'];
        $description = $params['description'];
        $property_id = $this->property_id;

        $stmt->bindParam(':title', $title, SQLITE3_TEXT);
        $stmt->bindParam(':square_footage', $square_footage, SQLITE3_INTEGER);
        $stmt->bindParam(':bedrooms', $bedrooms, SQLITE3_INTEGER);
        $stmt->bindParam(':bathrooms', $bathrooms, SQLITE3_INTEGER);
        $stmt->bindParam(':deposit', $deposit, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['landlord_id'])){
                $this->landlord_id = $row['landlord_id'];
            }
            if(isset($row['address_id'])){
                $this->address_id = $row['address_id'];
            }
            if(isset($row['title'])){
                $this->title = $row['title'];
            }
            if(isset($row['square_footage'])){
                $this->square_footage = $row['square_footage'];
            }
            if(isset($row['bedrooms'])){
                $this->bedrooms = $row['bedrooms'];
            }
            if(isset($row['bathrooms'])){
                $this->bathrooms = $row['bathrooms'];
            }
            if(isset($row['deposit'])){
                $this->deposit = $row['deposit'];
            }
            if(isset($row['verified'])){
                $this->verified = $row['verified'];
            }
            if(isset($row['description'])){
                $this->description = $row['description'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }

    function decryptValues($row){
        if($row){
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['title'])){
                $this->title = $row['title'];
            }
            if(isset($row['square_footage'])){
                $this->square_footage = $row['square_footage'];
            }
            if(isset($row['bedrooms'])){
                $this->bedrooms = $row['bedrooms'];
            }
            if(isset($row['bathrooms'])){
                $this->bathrooms = $row['bathrooms'];
            }
            if(isset($row['deposit'])){
                $this->deposit = $row['deposit'];
            }
            if(isset($row['verified'])){
                $this->verified = $row['verified'];
            }
            if(isset($row['description'])){
                $this->description = $row['description'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }

            if(isset($row['landlord_id'])){
                $this->landlord_id = $this->decryptUnique($row['landlord_id']);
            }
            if(isset($row['address_id'])){
                $this->address_id = $this->decryptUnique($row['address_id']);
            }
        }
    }

}
