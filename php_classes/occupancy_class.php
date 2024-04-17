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


    /*function loadLease(){
        $lease_array = array();
        $db = new SQLite3('../storage/database.db');        
        if($this->tenant_id){
            
            $sql = 'SELECT * FROM Leases WHERE tenant_id=:tenant_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

        }
        else if($this->property_id){
            $sql = 'SELECT * FROM Leases WHERE property_id=:property_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
            $result = $stmt->execute();
        }
        else
        {
            $sql = 'SELECT * FROM Leases';
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();        
        }
        $i = 0;
            while($row=$result->fetchArray()){
                $lease_array[$i] = new Lease(false);
                $lease_array[$i]->unpack($row);
                $i++;
            }
        return $lease_array;
    }
    static function getTenantLeases($tID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Leases WHERE tenant_id='.$tID;
        $result = $db->query($sql);
        
        $arrayResult = [];
        $i = 0;
        while($row = $result->fetchArray()){
            $arrayResult[$i] = new Lease(false);
            $arrayResult[$i]->unpack($row); 
            $i += 1;
        }
        
        return $arrayResult;
    }*/


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

    static function GetOccupancyByID($LID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Occupancies WHERE lease_id = :lease_id';
        
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':lease_id', $LID, SQLITE3_INTEGER);
        $result = $stmt->execute();

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

