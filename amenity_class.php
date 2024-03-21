<?php
require_once("databaseEntity_class.php");

Class Amenity extends DatabaseEntity{
    public $amenity_id, $property_id, $description;

    function __construct($params){
        parent::__construct("Amenities");
        $this->unpack($params);
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
            $db = new SQLite3('database.db');
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
        $db = new SQLite3('database.db');
        $sql = 'INSERT INTO Amenities(property_id, description) VALUES(:property_id, :description)';

        $stmt = $db->prepare($sql);

        $property_id = $this->property_id;
        $description = $this->description;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $result = $stmt->execute();

        return true;
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
