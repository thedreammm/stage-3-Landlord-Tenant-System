<?php
require_once("databaseEntity_class.php");

Class OnetimeCode extends databaseEntity{
    public $code_id, $account_id, $code;

    function __construct($params){
        parent::__construct("Onetime_codes");
        $this->unpack($params);
    }

    function unpack($row){
        if($row){
            if(isset($row['code_id'])){
                $this->code_id = $row['code_id'];
            }
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['code'])){
                $this->code = $row['code'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }

    function validInsert(){
        if($this->account_id == null || $this->code == null){
            return false;
        }
        else{
            return true;
        }
    }

    function createCode(){
        $this->deleteOldCodes();
        
        $chars = array_merge(range('0','9'), range('a','z'), range('A','Z'));
        $code = "";
        for($i = 0; $i < 6; $i++){
            $code .= $chars[random_int(0,61)];
        }
        $this->code = $code;

        if(!$this->validInsert()){
            return false;
        }

        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Onetime_codes(account_id, code, iv) VALUES(:account_id, :code, :iv)';
        $stmt = $db->prepare($sql);

        $iv = openssl_random_pseudo_bytes(16);
        $this->iv = $iv;

        $account_id = $this->encryptUnique($this->account_id);
        $code = $this->encrypt($this->code);

        $stmt->bindParam(':account_id', $account_id, SQLITE3_TEXT);
        $stmt->bindParam(':code', $code, SQLITE3_TEXT);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        return $result;
    }

    function loadCode(){
        if($this->account_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Onetime_codes WHERE account_id=:account_id';
            $stmt = $db->prepare($sql);

            $account_id = $this->encryptUnique($this->account_id);

            $stmt->bindParam(':account_id', $account_id, SQLITE3_TEXT);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            if($row){
                $this->decryptValues($row);
                return true;
            }
        }
        return false;
    }

    function deleteOldCodes(){
        if($this->account_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'DELETE FROM Onetime_codes WHERE account_id=:account_id';
            $stmt = $db->prepare($sql);
            $account_id = $this->encryptUnique($this->account_id);
            $stmt->bindParam(':account_id', $account_id, SQLITE3_TEXT);
            $result = $stmt->execute();
            return $result;
        }
        return false;
    }

    function decryptValues($row){
        if($row){
            if(isset($row['code_id'])){
                $this->code_id = $row['code_id'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }

            if(isset($row['account_id'])){
                $this->account_id = $this->decryptUnique($row['account_id']);
            }
            if(isset($row['code'])){
                $this->code = $this->decrypt($row['code']);
            }
            
        }
    }
}


?>
