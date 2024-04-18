<?php
require_once("databaseEntity_class.php");

Class Maintenance extends DatabaseEntity{
    public $maintenance_id, $property_id, $tenant_id, $service_id, $issue, $cost, $date_made, $date_service, $date_completed, $iv;
    
    function __construct($params){
        parent::__construct("Maintenance_Requests");
        $this->unpack($params);
    }
    function validInsert(){
        if($this->property_id == null || $this->tenant_id == null || $this->issue == null){
            return false;
        }
        else{
            return true;
        }
    }

    function CreateRequest(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Maintenance_Requests(property_id, tenant_id, issue) VALUES(:property_id, :tenant_id, :issue)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);  
        $stmt->bindParam(':issue', $this->issue, SQLITE3_TEXT);       
        $result = $stmt->execute();
        
        return $result;
    }

    
    static function GetRequestByID($MID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Maintenance_Requests WHERE maintenance_id=:maintenance_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':maintenance_id', $MID, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        $request= new Maintenance(false);
        $request->unpack($row);
        return $request;
    }
        
    function SetService(){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Maintenance_Requests SET service_id=:service_id, date_service=:date_service WHERE maintenance_id=:maintenance_id';

        $stmt=$db->prepare($sql);

        $stmt->bindParam(':maintenance_id',$this->maintenance_id, SQLITE3_INTEGER);
        $stmt->bindParam(':service_id', $this->service_id, SQLITE3_INTEGER);
        $stmt->bindParam(':date_service', $this->date_service, SQLITE3_TEXT);
        $result = $stmt->execute();

        return $result;
    }

    function MarkComplete(){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Maintenance_Requests SET cost=:cost, date_completed=:date_completed WHERE maintenance_id=:maintenance_id';

        $stmt=$db->prepare($sql);

        $stmt->bindParam(':maintenance_id',$this->maintenance_id, SQLITE3_INTEGER);
        $stmt->bindParam(':cost', $this->cost, SQLITE3_FLOAT);
        $stmt->bindParam(':date_completed', $this->date_completed, SQLITE3_TEXT);
        $result = $stmt->execute();

        return $result;

    }

    function LoadRequest(){
        $request_array = [];
        $db = new SQLite3('../storage/database.db');
        if($this->tenant_id){
            
            $sql = 'SELECT * FROM Maintenance_Requests WHERE tenant_id=:tenant_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

        }
        else if($this->property_id){
            $sql = 'SELECT * FROM Maintenance_Requests WHERE property_id=:property_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
            $result = $stmt->execute();
        }
        else{
            $sql = 'SELECT * FROM Maintenance_Requests';
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();        
        }
        $i = 0;
            while($row=$result->fetchArray()){
                $request_array[$i] = new Maintenance(false);
                $request_array[$i]->unpack($row);
                $i++;
            }
        return $request_array;
        
    }







    function unpack($row){
        if($row){
            if(isset($row['maintenance_id'])){
                $this->maintenance_id = $row['maintenance_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $row['tenant_id'];
            }
            if(isset($row['service_id'])){
                $this->service_id = $row['service_id'];
            }
            if(isset($row['issue'])){
                $this->issue = $row['issue'];
            }
            if(isset($row['cost'])){
                $this->cost = $row['cost'];
            }
            if(isset($row['date_made'])){
                $this->date_made = $row['date_made'];
            }
            if(isset($row['date_service'])){
                $this->date_service = $row['date_service'];
            }
            if(isset($row['date_completed'])){
                $this->date_completed = $row['date_completed'];
            }
        }
    }

}