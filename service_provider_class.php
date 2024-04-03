<?php
require_once("databaseEntity_class.php");

function loadServiceProviders($landlord_id){
    $service_providers = array();

    $db = new SQLite3('database.db');
    $sql = 'SELECT * FROM Service_providers WHERE landlord_id=:landlord_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':landlord_id', $landlord_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $i = 0;
    while($row = $result->fetchArray()){
        $service_providers[$i] = new ServiceProvider($row);
        $i += 1;
    }
    return $service_providers;
}

Class ServiceProvider extends DatabaseEntity{
    public $service_id, $landlord_id, $name, $email;

    function __construct($params){
        parent::__construct("Service_providers");
        $this->unpack($params);
    }

    function validInsert(){
        if($this->landlord_id == null || $this->name == null || $this->email == null){
            return false;
        }
        else{
            return true;
        }
    }

    function loadService(){
        if($this->service_id){
            $db = new SQLite3('database.db');
            $sql = 'SELECT * FROM Service_providers WHERE service_id=:service_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':service_id', $this->service_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
    }

    function createService(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('database.db');
        $sql = 'INSERT INTO Service_providers(landlord_id, name, email) VALUES(:landlord_id, :name, :email)';

        $stmt = $db->prepare($sql);

        $landlord_id = $this->landlord_id;
        $name = $this->name;
        $email = $this->email;

        $stmt->bindParam(':landlord_id', $landlord_id, SQLITE3_INTEGER);
        $stmt->bindParam(':name', $name, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        return true;
    }

    function unpack($row){
        if($row){
            if(isset($row['service_id'])){
                $this->service_id = $row['service_id'];
            }
            if(isset($row['landlord_id'])){
                $this->landlord_id = $row['landlord_id'];
            }
            if(isset($row['name'])){
                $this->name = $row['name'];
            }
            if(isset($row['email'])){
                $this->email = $row['email'];
            }
        }
    }

}

?>