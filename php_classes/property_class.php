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

            $i = 0;
            while($row = $result->fetchArray()){
                $properties_array[$i] = new Property(false);
                $properties_array[$i]->decryptValues($row);
                $i += 1;
            }
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
        $address_id = $this->encrypt($this->address_id);
        $title = $this->title;
        $square_footage = $this->square_footage;
        $bedrooms = $this->bedrooms;
        $bathrooms = $this->bathrooms;
        $deposit = $this->deposit;        
        $verified = 0;
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
                $this->address_id = $this->decrypt($row['address_id']);
            }
        }
    }

}
