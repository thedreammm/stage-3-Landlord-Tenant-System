<?php
require_once("databaseEntity_class.php");

Class Occupancy extends DatabaseEntity{
    public $occupancy_id, $lease_id, $date_made, $beginning, $ending;

    function __construct($params){
        parent::__construct("Occupancies");
        $this->unpack($params);
    }
    function validInsert(){
        if($this->lease_id == null){
            return false;
        }
        else{
            return true;
        }
    }


    function CreateOccupancy(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Occupancies(lease_id, beginning, ending) VALUES(:lease_id, :beginning, :ending)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':lease_id', $this->lease_id, SQLITE3_INTEGER);
        $stmt->bindParam(':beginning', $this->beginning, SQLITE3_TEXT);  
        $stmt->bindParam(':ending', $this->ending, SQLITE3_TEXT);       
        $result = $stmt->execute();
        
        return $result;
    }
    function loadOccupancy(){
        $occupancy_array = array();
        $db = new SQLite3('../storage/database.db');        
        if($this->occupancy_id){
            
            $sql = 'SELECT * FROM Occupancies WHERE occupancy_id=:occupancy_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':occupancy_id', $this->occupancy_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

        }
        else if($this->lease_id){
            $sql = 'SELECT * FROM Occupancies WHERE lease_id=:lease_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':lease_id', $this->lease_id, SQLITE3_INTEGER);
            $result = $stmt->execute();
        }
        else
        {
            $sql = 'SELECT * FROM Occupancies';
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();        
        }
        $i = 0;
            while($row=$result->fetchArray()){
                $occupancy_array[$i] = new Occupancy(false);
                $occupancy_array[$i]->unpack($row);
                $i++;
            }
        return $occupancy_array;
    }

    static function GetOccupancyByID($LID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Occupancies WHERE lease_id = :lease_id';
        
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':lease_id', $LID, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        while($row = $result->fetchArray()){
            $result = new Notification(false);
            $result->unpack($row);            
        }

        return $result;
    }


    function unpack($row){
        if($row){
            if(isset($row['occupancy_id'])){
                $this->occupancy_id = $row['occupancy_id'];
            }
            if(isset($row['lease_id'])){
                $this->lease_id = $row['lease_id'];
            }            
            if(isset($row['date_made'])){
                $this->date_made = $row['date_made'];
            }
            if(isset($row['beginning'])){
                $this->beginning = $row['beginning'];
            }
            if(isset($row['ending'])){
                $this->ending = $row['ending'];
            }

        }
    }
}

