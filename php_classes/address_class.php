<?php
require_once("databaseEntity_class.php");

Class Address extends DatabaseEntity{
    public $address_id, $post_code, $street_address, $county, $door_number;

    function __construct($params){
        parent::__construct("Addresses");
        $this->unpack($params);
    }

    function validInsert(){
        if($this->post_code == null || $this->street_address == null){
            return false;
        }
        else{
            return true;
        }
    }

    function loadAddress(){
        if($this->address_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Addresses WHERE address_id=:address_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':address_id', $this->address_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
    }

    static function searchAddress($input){
        $db = new SQLite3('../storage/database.db');
        $sql = "SELECT * FROM Addresses";
        $conditions = [];
        if(isset($input['street_address'])) {
            $conditions[] = "street_address LIKE :street_address";
        }
        if (isset($input['post_code'])){
            $conditions[] = "post_code LIKE :post_code";
        }
        if (isset($input['county'])){
            $conditions[] = "county LIKE :county";
        }

        if (!empty($conditions)) {
            $sql .= " WHERE ".implode(" AND ", $conditions);
        }
        $stmt = $db->prepare($sql);
        if(isset($input['street_address'])) {
            $stmt->bindParam(':street_address', $input['street_address'], SQLITE3_TEXT);
        }
        if (isset($input['post_code'])){
            $stmt->bindParam(':post_code', $input['post_code'], SQLITE3_TEXT);
        }
        if (isset($input['county'])){
            $stmt->bindParam(':county', $input['county'], SQLITE3_TEXT);
        }
        $result = $stmt->execute();

        $i = 0;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)){
            $result_array[$i] = new Address(false);
            $result_array[$i]->unpack($row);            
            $i+=1;
        }
        return $result_array;
    }

    function createAddress(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Addresses(post_code, street_address, county, door_number) VALUES(:post_code, :street_address, :county, :door_number)';

        $stmt = $db->prepare($sql);

        $post_code = $this->post_code;
        $street_address = $this->street_address;
        $county = $this->county;
        $door_number = $this->door_number;

        $stmt->bindParam(':post_code', $post_code, SQLITE3_TEXT);
        $stmt->bindParam(':street_address', $street_address, SQLITE3_TEXT);
        $stmt->bindParam(':county', $county, SQLITE3_TEXT);
        $stmt->bindParam(':door_number', $door_number, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->address_id = $db->lastInsertRowID();
        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['address_id'])){
                $this->address_id = $row['address_id'];
            }
            if(isset($row['post_code'])){
                $this->post_code = $row['post_code'];
            }
            if(isset($row['street_address'])){
                $this->street_address = $row['street_address'];
            }
            if(isset($row['county'])){
                $this->county = $row['county'];
            }
            if(isset($row['door_number'])){
                $this->door_number = $row['door_number'];
            }
        }
    }

}
