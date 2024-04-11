<?php
require_once("databaseEntity_class.php");

Class Account extends DatabaseEntity{
    public $account_id, $username, $fname, $lname, $email, $password, $account_type, $verified;
    
    function __construct($params){
        parent::__construct("Accounts");
        $this->unpack($params);
    }

    static function loadAccounts($params){
        $accounts_array = array();
        if(isset($params['usernames'])){
            $db = new SQLite3('../storage/database.db');
            for($i = 0; $i < count($params['usernames']); $i++){
                $accounts_array[$i] = new Account(false);
                $accounts_array[$i]->username = $params['usernames'][$i];
                $accounts_array[$i]->loadAccount();
            }
        }
        else{
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Accounts'; //WHERE <params stuff>, maybe
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();
        
            $i = 0;
            while($row = $result->fetchArray()){
                $accounts_array[$i] = new Account(false);
                $accounts_array[$i]->decryptValues($row);
                $i += 1;
            }
        }
        return $accounts_array;
    }

    function loadAccount(){

        if($this->account_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Accounts WHERE account_id=:account_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->decryptValues($row);
            return true;
        }
        else if($this->username){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Accounts WHERE username=:username';

            $stmt = $db->prepare($sql);

            $username = $this->encryptUnique($this->username);
            $stmt->bindParam(':username', $username, SQLITE3_TEXT);
            $result = $stmt->execute();

            $row = $result->fetchArray();

            $result = false;
            if(isset($row['password'])){
                $result = password_verify($this->password, $row['password']);
            }
            if($result){    //username & password gives all its information
                $this->decryptValues($row);
            }
            else{   //only the username gives only the account_id
                $this->account_id = $row['account_id'];
            }
        }
    }

    function validInsert(){
        if($this->username == null || $this->fname == null || $this->lname == null || $this->email == null || $this->password == null || $this->account_type== null){
            return false;
        }
        else{
            return true;
        }
    }

    function createAccount(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Accounts(username, fname, lname, email, password, account_type, verified, iv) VALUES(:username, :fname, :lname, :email, :password, :account_type, :verified, :iv)';

        $stmt = $db->prepare($sql);

        $iv = openssl_random_pseudo_bytes(16);
        $this->iv = $iv;
        $username = $this->encryptUnique($this->username);
        $fname = $this->encrypt($this->fname);
        $lname = $this->encrypt($this->lname);
        $email = $this->encrypt($this->email);
        $password = $this->encryptPassword($this->password);
        $account_type = $this->encrypt($this->account_type);
        $verified = 0;

        $stmt->bindParam(':username', $username, SQLITE3_TEXT);
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $stmt->bindParam(':password', $password, SQLITE3_TEXT);
        $stmt->bindParam(':account_type', $account_type, SQLITE3_TEXT);
        $stmt->bindParam(':verified', $verified, SQLITE3_INTEGER);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->account_id = $db->lastInsertRowID();

        if($this->account_type == "tenant"){
            $sql = 'INSERT INTO Tenants(account_id) VALUES (:account_id)';
        }
        else{
            $sql = 'INSERT INTO Landlords(account_id) VALUES (:account_id)';
        }
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result;
    }

    function updateAccount($params){
        if(!$this->account_id){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        if(isset($params['verificationcode'])){
            require_once("onetime_code_class.php");

            $code = new OnetimeCode(array('account_id'=>$this->account_id));
            $code->loadCode();
            if($params['verificationcode'] == $code->code){
                $this->verified = 1;
                $sql = 'UPDATE Accounts SET verified=:verified WHERE account_id=:account_id';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':verified', $this->verified, SQLITE3_INTEGER);
                $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
            }
        }
        else if(isset($params['resetcode'])){
            require_once("onetime_code_class.php");

            $code = new OnetimeCode(array('account_id'=>$this->account_id));
            $result = $code->loadCode();
            if($params['resetcode'] == $code->code){
                $password = $this->encryptPassword($params['password']);
                $sql = 'UPDATE Accounts SET password=:password WHERE account_id=:account_id';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':password', $password, SQLITE3_TEXT);
                $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
            }
        }
        $result = $stmt->execute();
        return $result;
    }

    function unpack($row){
        if($row){
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['username'])){
                $this->username = $row['username'];
            }
            if(isset($row['fname'])){
                $this->fname = $row['fname'];
            }
            if(isset($row['lname'])){
                $this->lname = $row['lname'];
            }
            if(isset($row['email'])){
                $this->email = $row['email'];
            }
            if(isset($row['password'])){
                $this->password = $row['password'];
            }
            if(isset($row['account_type'])){
                $this->account_type = $row['account_type'];
            }
            if(isset($row['verified'])){
                $this->verified = $row['verified'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }

    function decryptValues($row){
        if($row){
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['verified'])){
                $this->verified = $row['verified'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }

            if(isset($row['username'])){
                $this->username = $this->decryptUnique($row['username']);
            }
            if(isset($row['fname'])){
                $this->fname = $this->decrypt($row['fname']);
            }
            if(isset($row['lname'])){
                $this->lname = $this->decrypt($row['lname']);
            }
            if(isset($row['email'])){
                $this->email = $this->decrypt($row['email']);
            }
            if(isset($row['account_type'])){
                $this->account_type = $this->decrypt($row['account_type']);
            }
        }
    }
}

Class Tenant extends Account{
    public $tenant_id;
    function __construct($params){
        parent::__construct($params);
    }

    function tenantCount(){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT COUNT(*) FROM Tenants';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    function loadAccount(){
        parent::loadAccount();
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT tenant_id FROM Tenants WHERE account_id=:account_id';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        $this->tenant_id = $row['tenant_id'];
        return true;
    }
}
Class Landlord extends Account{
    public $landlord_id;
    function __construct($params){
        parent::__construct($params);
    }

    function loadAccount(){
        parent::loadAccount();
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT landlord_id FROM Landlords WHERE account_id=:account_id';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        $this->landlord_id = $row['landlord_id'];
        return true;
    }
}
?>
