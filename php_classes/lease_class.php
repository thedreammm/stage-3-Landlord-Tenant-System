<?php
require_once("databaseEntity_class.php");

Class Lease extends DatabaseEntity{
    public $lease_id, $property_id, $tenant_id, $document_id, $date_made, $status, $date_result;

    function __construct($params){
        parent::__construct("Lease");
        $this->unpack($params);
    }
    function validInsert(){
        if($this->property_id == null || $this->tenant_id == null){
            return false;
        }
        else{
            return true;
        }
    }


    function loadLease(){
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
        else if($this->lease_id){
            $sql = 'SELECT * FROM Leases WHERE lease_id=:lease_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':lease_id', $this->lease_id, SQLITE3_INTEGER);
            $result = $stmt->execute();
        } 
        else{
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

    static function getLeaseByID($LID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Leases WHERE lease_id='.$LID;
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        $lease= new Lease(false);
        $lease->unpack($row);
        return $lease;
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
    }

    function ResultLease($decision){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Leases SET status = :status WHERE lease_id = :lease_id';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':lease_id', $this->lease_id, SQLITE3_INTEGER);
        $stmt->bindParam(':status', $decision, SQLITE3_TEXT);

        $result = $stmt->execute();

        return $result;

    }




    function CreateLease(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Leases(property_id, tenant_id, document_id) VALUES(:property_id, :tenant_id, :document_id)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);  
        $stmt->bindParam(':document_id', $this->document_id, SQLITE3_INTEGER);       
        $result = $stmt->execute();
        
        return $result;
    }


    function unpack($row){
        if($row){
            if(isset($row['lease_id'])){
                $this->lease_id = $row['lease_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $row['tenant_id'];
            }
            if(isset($row['document_id'])){
                $this->document_id = $row['document_id'];
            }
            if(isset($row['date_made'])){
                $this->date_made = $row['date_made'];
            }
            if(isset($row['status'])){
                $this->status = $row['status'];
            }
            if(isset($row['date_result'])){
                $this->date_result = $row['date_result'];
            }

        }
    }
}

