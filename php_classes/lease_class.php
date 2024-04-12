<?php
require_once("databaseEntity_class.php");

Class Lease extends DatabaseEntity{
    public $lease_id, $property_id, $tenant_id;

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

    static function loadAllLeases($params){
        $lease_array = array();
        if(isset($params['tenant_id'])){
            $db = new SQLite3('../storage/database.db');
            for($i = 0; $i < count($params['tenant_id']); $i++){
                $lease_array[$i] = new Lease(false);
                $lease_array[$i]->tenant_id = $params['tenant_id'][$i];
                $lease_array[$i]->loadLease();
            }
        }
        else{
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Lease_Test'; //WHERE <params stuff>, maybe
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();

            $i = 0;
            while($row=$result->fetchArray()){
                $lease_array[$i] = new Lease(false);
                $lease_array[$i]->unpack($row);
                $i++;
            }
        
        }
        return $lease_array;
    }

    function loadLease(){

        if($this->tenant_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Lease_Test WHERE tenant_id=:tenant_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();            
          
            return true;
        }

    }
    static function getTenantLeases($tID){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Lease_Test WHERE tenant_id='.$tID;
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


    function CreateLease(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Lease_Test(property_id, tenant_id) VALUES(:property_id, :tenant_id)';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':property_id', $this->property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':tenant_id', $this->tenant_id, SQLITE3_INTEGER);        
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

        }
    }
}