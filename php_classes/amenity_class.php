<?php
require_once("databaseEntity_class.php");

Class Amenity extends DatabaseEntity{
    public $amenity_id, $property_id, $description;

    function __construct($params){
        parent::__construct("Amenities");
        $this->unpack($params);
    }

    static function loadAmenities($property_id){
        if($property_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Amenities WHERE property_id=:property_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
            $result = $stmt->execute();
            
            $amenities_array = array();
            $i = 0;
            while($row = $result->fetchArray()){
                $amenities_array[$i] = new Amenity(false);
                $amenities_array[$i]->unpack($row);
                $i += 1;
            }
            
            return $amenities_array;
        }
        return false;
    }

    static function updateAmenities($property_id, $post_amenities){
        $amenities_array = Amenity::loadAmenities($property_id);
        $i = 0;
        while($i < count($amenities_array) && $i < count($post_amenities)){
            $amenities_array[$i]->updateAmenity( (array) $post_amenities[$i]);
            $i+=1;
        }
        while($i < count($post_amenities)){
            $post_amenities[$i] = (array) $post_amenities[$i];
            $post_amenities[$i]['property_id'] = $property_id;
            $amenity_obj = new Amenity($post_amenities[$i]);
            $amenity_obj->createAmenity();
            $i+=1;
        }
        if($i < count($amenities_array)){
            //$amenities_array[$i]->deleteAmenity();
            //$i+=1;
            $db = new SQLite3('../storage/database.db');
            $sql = 'DELETE FROM Amenities WHERE property_id=:property_id OFFSET :excess';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
            $stmt->bindParam(':excess', $i, SQLITE3_INTEGER);
            $result = $stmt->execute();
        }
        
        return true;
    }

    function validInsert(){
        if($this->property_id == null || $this->description == null){
            return false;
        }
        else{
            return true;
        }
    }

    function loadAmenity(){
        if($this->amenity_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Amenities WHERE amenity_id=:amenity_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':amenity_id', $this->amenity_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
    }

    function createAmenity(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Amenities(property_id, description) VALUES(:property_id, :description)';

        $stmt = $db->prepare($sql);

        $property_id = $this->property_id;
        $description = $this->description;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $result = $stmt->execute();

        return true;
    }

    function updateAmenity($params){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Amenities SET description=:description WHERE amenity_id=:amenity_id';

        $stmt = $db->prepare($sql);

        $description = $params['description'];
        $amenity_id = $this->amenity_id;

        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $stmt->bindParam(':amenity_id', $amenity_id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['amenity_id'])){
                $this->amenity_id = $row['amenity_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['description'])){
                $this->description = $row['description'];
            }
        }
    }

}
