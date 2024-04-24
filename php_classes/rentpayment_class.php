<?php
require_once("databaseEntity_class.php");

Class RentPayment extends DatabaseEntity{
    public $rent_id, $property_id, $tenant_id, $reminder_id, $cost, $date_due, $date_paid;

    function __construct($params){
        parent::__construct("Rent_payments");
        $this->unpack($params);
    }

    function validInsert(){
        if($this->property_id == null || $this->tenant_id == null || $this->cost == null){
            return false;
        }
        else{
            return true;
        }
    }

    static function loadRentPayments($params){
        $rent_array = array();
        $obj = new RentPayment(false);
        $db = new SQLite3('../storage/database.db');

        $sql = 'SELECT * FROM Rent_payments';
        if(isset($params['property_id']) && $params['property_id']){
            $sql .= ' WHERE property_id=:property_id';
            if(isset($params['tenant_id']) && $params['tenant_id']){
                $sql .= ' AND tenant_id=:tenant_id';
            }
        }
        else if(isset($params['tenant_id']) && $params['tenant_id']){
            $sql .= ' WHERE tenant_id=:tenant_id';
        }
        else{
            return $rent_array;
        }
        if(isset($params['past']) && isset($params['present'])){
            $sql .= " AND date_due BETWEEN '" . $params['past'] . "' AND '" . $params['present'] . "'";
        }
        else{
            $present = date('Y-m-d');
            $theYear = substr($present, 0, 4);
            $theMonth = substr($present, 5, 2);
            $theDay = substr($present, 8, 2);
            $theMonth -= (intval($params['duration'])-1);
            if($theMonth < 1){
                $theMonth = 1;
            }
            $theDay = 1;

            $strYear = strval($theYear);
            $strMonth = strval($theMonth);
            if($theMonth < 10){
                $strMonth = "0".$strMonth;
            }
            $strDay = "0".strval($theDay);

            $past = $strYear . "-" . $strMonth . "-" . $strDay;
            $sql .= " AND date_due BETWEEN '" . $past . "' AND '" . $present . "'";
        }
        $sql .= ' ORDER BY date_due ASC';
        //echo($sql);
        
        $stmt = $db->prepare($sql);
        if(isset($params['property_id'])){
            $property_id = $obj->encryptUnique($params['property_id']);
            $stmt->bindParam(':property_id', $property_id, SQLITE3_TEXT);
        }
        if(isset($params['tenant_id'])){
            $tenant_id = $obj->encryptUnique($params['tenant_id']);
            $stmt->bindParam(':tenant_id', $tenant_id, SQLITE3_TEXT);
        }

        $result = $stmt->execute();
        $i = 0;
        while($row = $result->fetchArray()){
            $rent_array[$i] = new RentPayment(false);
            $rent_array[$i]->decryptValues($row);
            $i += 1;
        }

        return $rent_array;
    }

    function loadRentPayment(){
        if($this->rent_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Rent_payments WHERE rent_id=:rent_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':rent_id', $this->rent_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->decryptValues($row);
            return true;
        }
        return false;
    }

    function createRentPayment(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Rent_payments(property_id, tenant_id, reminder_id, cost, date_due, date_paid, iv) VALUES(:property_id, :tenant_id, :reminder_id, :cost, date(:date_due), date(:date_paid), :iv)';
        $stmt = $db->prepare($sql);

        $iv = $this->createIV();
        $this->iv = $iv;
        $property_id = $this->encryptUnique($this->property_id);
        $tenant_id = $this->encryptUnique($this->tenant_id);
        $reminder_id = $this->reminder_id;
        $cost = $this->encrypt($this->cost);    //if we don't end up 
        $date_due = $this->date_due;
        $date_paid = $this->date_paid;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_TEXT);
        $stmt->bindParam(':tenant_id', $tenant_id, SQLITE3_TEXT);
        $stmt->bindParam(':reminder_id', $reminder_id, SQLITE3_INTEGER);
        $stmt->bindParam(':cost', $cost, SQLITE3_TEXT);
        $stmt->bindParam(':date_due', $date_due, SQLITE3_TEXT);
        $stmt->bindParam(':date_paid', $date_paid, SQLITE3_TEXT);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->rent_id = $db->lastInsertRowID();
        return true;
    }

    function updateRentPayment($params){
        $db = new SQLite3('../storage/database.db');
        $sql = 'UPDATE Rent_payments SET';
        if(isset($params['due_date'])){
            if($this->date_paid || $this->date_due >= date("Y-m-d")){
                return false;
            }
            $sql .= ' due_date=:due_date';
        }
        if(isset($params['cost'])){
            if($this->date_paid){
                return false;
            }
            $sql .= ' cost=:cost';
        }
        $sql .= ' WHERE rent_id=:rent_id';
        $stmt = $db->prepare($sql);

        $rent_id = $this->rent_id;
        if(isset($params['due_date'])){
            $due_date = $params['due_date'];
            $stmt->bindParam(':date_due', $date_due, SQLITE3_TEXT);
        }
        if(isset($params['cost'])){
            $cost = $this->encrypt($params['cost']);
            $stmt->bindParam(':cost', $cost, SQLITE3_TEXT);
        }
        $stmt->bindParam(':rent_id', $rent_id, SQLITE3_INTEGER);

        $result = $stmt->execute();
        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['rent_id'])){
                $this->rent_id = $row['rent_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $row['tenant_id'];
            }
            if(isset($row['reminder_id'])){
                $this->reminder_id = $row['reminder_id'];
            }
            if(isset($row['cost'])){
                $this->cost = $row['cost'];
            }
            if(isset($row['date_due'])){
                $this->date_due = $row['date_due'];
            }
            if(isset($row['date_paid'])){
                $this->date_paid = $row['date_paid'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }

    function decryptValues($row){
        if($row){
            if(isset($row['rent_id'])){
                $this->rent_id = $row['rent_id'];
            }
            if(isset($row['reminder_id'])){
                $this->reminder_id = $row['reminder_id'];
            }
            if(isset($row['date_due'])){
                $this->date_due = $row['date_due'];
            }
            if(isset($row['date_paid'])){
                $this->date_paid = $row['date_paid'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
            
            if(isset($row['property_id'])){
                $this->property_id = $this->decryptUnique($row['property_id']);
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $this->decryptUnique($row['tenant_id']);
            }
            if(isset($row['cost'])){
                $this->cost = $this->decrypt($row['cost']);
            }
        }
    }

}
