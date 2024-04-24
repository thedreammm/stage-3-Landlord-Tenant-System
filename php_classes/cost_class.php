<?php
require_once("databaseEntity_class.php");

Class Cost extends DatabaseEntity{
    public $cost_id, $property_id, $cost, $duration, $period;

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
    static function searchCost($input){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT property_id FROM Costs WHERE cost<=:cost AND duration>=:duration AND period=:period';
        $cost_array = [];

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':cost', $input['cost'], SQLITE3_INTEGER);
        $stmt->bindParam(':duration', $input['duration'], SQLITE3_INTEGER);
        $stmt->bindParam(':period', $input['period'], SQLITE3_TEXT);
        $result = $stmt->execute();
        

        while ($row = $result->fetchArray(SQLITE3_ASSOC)){
            $cost_array[] = $row['property_id'];
        }
        return $cost_array;


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
        $sql = 'INSERT INTO Costs(property_id, cost, duration, period) VALUES(:property_id, :cost, :duration, :period)';

        $stmt = $db->prepare($sql);

        $property_id = $this->property_id;
        $cost = $this->cost;
        $duration = $this->duration;
        $period = $this->period;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':cost', $cost, SQLITE3_INTEGER);
        $stmt->bindParam(':duration', $duration, SQLITE3_INTEGER);
        $stmt->bindParam(':period', $period, SQLITE3_TEXT);
        $result = $stmt->execute();

        return true;
    }
    
    function updateCost($params){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Costs SET cost=:cost, duration=:duration, period=:period WHERE property_id=:property_id';

        $stmt = $db->prepare($sql);

        $cost = $params['cost'];
        $duration = $params['duration'];
        $period = $params['period'];
        $property_id = $params['property_id'];
        
        $stmt->bindParam(':cost', $cost, SQLITE3_INTEGER);
        $stmt->bindParam(':duration', $duration, SQLITE3_INTEGER);
        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':period', $period, SQLITE3_TEXT);
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
            if(isset($row['period'])){
                $this->period = $row['period'];
            }
        }
    }

}
