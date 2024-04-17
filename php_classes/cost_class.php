<?php
require_once("databaseEntity_class.php");

Class Cost extends DatabaseEntity{
    public $cost_id, $property_id, $cost, $duration;

    function __construct($params){
        parent::__construct("Costs");
        $this->unpack($params);
    }

    function validInsert(){
        if($this->property_id == null || $this->cost == null || $this->duration == null){
            return false;
        }
        else{
            return true;
        }
    }

    function loadCost(){
        if($this->cost_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Costs WHERE cost_id=:cost_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cost_id', $this->cost_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
        else if($this->property_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Costs WHERE property_id=:property_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
    }

    function createCost(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Costs(property_id, cost, duration) VALUES(:property_id, :cost, :duration)';

        $stmt = $db->prepare($sql);

        $property_id = $this->property_id;
        $cost = $this->cost;
        $duration = $this->duration;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':cost', $cost, SQLITE3_INTEGER);
        $stmt->bindParam(':duration', $duration, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return true;
    }
    
    function updateCost($params){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Costs SET cost=:cost, duration=:duration WHERE property_id=:property_id';

        $stmt = $db->prepare($sql);

        $cost = $params['cost'];
        $duration = $params['duration'];
        $property_id = $params['property_id'];
        
        $stmt->bindParam(':cost', $cost, SQLITE3_INTEGER);
        $stmt->bindParam(':duration', $duration, SQLITE3_INTEGER);
        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['cost_id'])){
                $this->cost_id = $row['cost_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['cost'])){
                $this->cost = $row['cost'];
            }
            if(isset($row['duration'])){
                $this->duration = $row['duration'];
            }
        }
    }

}
