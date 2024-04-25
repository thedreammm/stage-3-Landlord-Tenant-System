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

    static function loadOccupancies($params){
        $occupancy_array = array();
        $present_date = date('Y-m-d');

        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Occupancies INNER JOIN Leases ON Occupancies.lease_id = Leases.lease_id';
        $add_where = true;

        if(isset($params['active']) && $params['active'] == true){
            if($add_where){
                $sql .= ' WHERE';
                $add_where = false;
            }
            else{
                $sql .= ' AND';
            }
            $sql .= ' beginning <= :present_date AND ending >= :present_date';
        }
        if(isset($params['tenant_id'])){
            if($add_where){
                $sql .= ' WHERE';
                $add_where = false;
            }
            else{
                $sql .= ' AND';
            }
            $sql .= ' tenant_id = :tenant_id';
        }
        if(isset($params['property_id'])){
            if($add_where){
                $sql .= ' WHERE';
                $add_where = false;
            }
            else{
                $sql .= ' AND';
            }
            $sql .= ' property_id = :property_id';
        }
        $stmt = $db->prepare($sql);

        if(isset($params['active']) && $params['active'] == true){
            $stmt->bindParam(':present_date', $present_date, SQLITE3_TEXT);
        }
        if(isset($params['tenant_id'])){
            $stmt->bindParam(':tenant_id', $params['tenant_id'], SQLITE3_INTEGER);
        }
        if(isset($params['property_id'])){
            $stmt->bindParam(':property_id', $params['property_id'], SQLITE3_INTEGER);
        }

        $result = $stmt->execute(); 
        if($result){
            $i = 0;
            while($row=$result->fetchArray()){
                $occupancy_array[$i] = new Occupancy($row);
                $occupancy_array[$i]->tenant_id = $row['tenant_id'];
                $i++;
            }
        }
        return $occupancy_array;
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
        $db = new SQLite3('../storage/database.db');     
        $result = false;   
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
        return $result;
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

