<?php
    require_once("../php_classes/account_class.php");
    session_start();
    session_destroy();
    session_start();

    $account1 = new Account($_POST);
    $result = $account1->loadAccount();

    $ID = $account1->account_id;
    $type = $account1->account_type;
    if($type == "tenant"){
        $db = new SQLite3('../storage/database.db');

        $sql = 'SELECT tenant_id, account_id FROM Tenants WHERE account_id = :account_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $ID, SQLITE3_INTEGER);
        $result = $stmt->execute();


        $row = $result->fetchArray(SQLITE3_ASSOC);
        $tenant_id = $row['tenant_id'];
        $account_id = $row['account_id'];
            

        $_SESSION['tenant_id'] = $tenant_id;
        $_SESSION['account_id'] = $account_id; 
    }
    else if($type == "landlord"){
        $db = new SQLite3('../storage/database.db');

        $sql = 'SELECT landlord_id, account_id FROM Landlords WHERE account_id = :account_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $ID, SQLITE3_INTEGER);
        $result = $stmt->execute();


        $row = $result->fetchArray(SQLITE3_ASSOC);
        $landlord_id = $row['landlord_id'];
        $account_id = $row['account_id'];
            

        $_SESSION['landlord_id'] = $landlord_id;
        $_SESSION['account_id'] = $account_id; 
    }
    else if($type == "admin"){
        $db = new SQLite3('../storage/database.db');

        $sql = 'SELECT admin_id, account_id FROM Admins WHERE account_id = :account_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':account_id', $ID, SQLITE3_INTEGER);
        $result = $stmt->execute();


        $row = $result->fetchArray(SQLITE3_ASSOC);
        $admin_id = $row['admin_id'];
        $account_id = $row['account_id'];
            

        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['account_id'] = $account_id; 
    }

    header('location: index.php');

?>
