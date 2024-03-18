<?php
function getAccountSeed(){
    $encryption_keys = file_get_contents('keys.json');
    $account_seed = json_decode($encryption_keys)->Accounts;
    return $account_seed;
}


Class Account{
    public $account_id, $username, $fname, $lname, $email, $password, $account_type, $account_seed, $iv;
    
    function __construct($params){
        $this->unpack($params);
        $this->account_seed = getAccountSeed();
    }

    function loadAccount(){

        if($this->account_id){
            $db = new SQLite3('database.db');
            $sql = 'SELECT * FROM Accounts WHERE account_id=:account_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':account_id', $this->account_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->decryptValues($row);
        }
        else if($this->username && $this->password){
            $db = new SQLite3('database.db');
            $sql = 'SELECT * FROM Accounts WHERE username=:username';

            $stmt = $db->prepare($sql);

            $username = $this->encryptUsername($this->username);
            $stmt->bindParam(':username', $username, SQLITE3_TEXT);
            $result = $stmt->execute();

            $row = $result->fetchArray();

            $result = false;
            if(isset($row['password'])){
                $result = password_verify($this->password, $row['password']);
            }
            if($result){
                $this->decryptValues($row);
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
        $db = new SQLite3('database.db');
        $sql = 'INSERT INTO Accounts(username, fname, lname, email, password, account_type, iv) VALUES(:username, :fname, :lname, :email, :password, :account_type, :iv)';

        $stmt = $db->prepare($sql);

        $iv = openssl_random_pseudo_bytes(16);
        $this->iv = $iv;
        $username = $this->encryptUsername($this->username);
        $fname = $this->encrypt($this->fname);
        $lname = $this->encrypt($this->lname);
        $email = $this->encrypt($this->email);
        $password = $this->encryptPassword($this->password);
        $account_type = $this->encrypt($this->account_type);

        $stmt->bindParam(':username', $username, SQLITE3_TEXT);
        $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
        $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $stmt->bindParam(':password', $password, SQLITE3_TEXT);
        $stmt->bindParam(':account_type', $account_type, SQLITE3_TEXT);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        return true;
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
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }

    function encryptValues(){
        if($row){
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['username'])){
                $this->username = $this->encryptUsername($row['username']);
            }
            if(isset($row['fname'])){
                $this->fname = $this->encrypt($row['fname']);
            }
            if(isset($row['lname'])){
                $this->lname = $this->encrypt($row['lname']);
            }
            if(isset($row['email'])){
                $this->email = $this->encrypt($row['email']);
            }
            if(isset($row['password'])){
                $this->password = $this->encryptPassword($row['password']);
            }
            if(isset($row['account_type'])){
                $this->account_type = $this->encrypt($row['account_type']);
            }
        }
    }

    function decryptValues($row){
        if($row){
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
            if(isset($row['username'])){
                $this->username = $this->decryptUsername($row['username']);
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
            //if(isset($row['password'])){
            //    $this->password = $this->verifyPassword($row['password']);
            //}
            if(isset($row['account_type'])){
                $this->account_type = $this->decrypt($row['account_type']);
            }
            
        }
    }
    function encrypt($value){
        return openssl_encrypt($value, "aes-128-cbc", $this->account_seed, 0, $this->iv);
    }
    function encryptUsername($value){
        return openssl_encrypt($value, "aes-128-cbc", $this->account_seed, 0, "usernameusername");
    }
    function encryptPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function decrypt($value){
        return openssl_decrypt($value, "aes-128-cbc", $this->account_seed, 0, $this->iv);
    }
    function decryptUsername($value){
        return openssl_decrypt($value, "aes-128-cbc", $this->account_seed, 0, "usernameusername");
    }
}

?>
