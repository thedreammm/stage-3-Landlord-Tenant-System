<?php include('databaseEntity_class.php');

Class Notification extends DatabaseEntity{
    public $notification_id, $landlord_id, $tenant_id, $subject, $content, $read;
    function __construct($params){
        parent::__construct("Notification");
        $this->unpack($params);
    }
    function validInsert(){
        if($this->landlord_id == null || $this->tenant_id == null || $this->subject == null || $this->content == null){
            return false;
        }
        else{
            return true;
        }
    }

    static function LoadNotifications($params){
        $db = new SQLite3('../storage/database.db');
        $result = null;
        $arrayResult = [];
        $i = 0;
        if(isset($params['tenant_id'])){
            $sql = 'SELECT * FROM Notifications WHERE tenant_id = '.$params['tenant_id'];
            $result = $db->query($sql);
        } else if(isset($params['landlord_id'])){
            $sql = 'SELECT * FROM Notifications WHERE landlord_id = '.$params['landlord_id'];
            $result = $db->query($sql);
        }
        
        while($row = $result->fetchArray()){
            $arrayResult[$i] = new Notification(false);
            $arrayResult[$i]->decryptValues($row); 
            $i += 1;
        }
        
        return $arrayResult;
    }
    
    /*static function LoadNotificationTenant($tenant_id){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Notifications WHERE tenant_id = '.$tenant_id;
        $result = $db->query($sql);
        
        $arrayResult = [];
        $i = 0;
        while($row = $result->fetchArray()){
            $arrayResult[$i] = new Notification(false);
            $arrayResult[$i]->decryptValues($row); 
            $i += 1;
        }
        
        return $arrayResult;
    }

    static function LoadNotificationLandlord($landlord_id){
        $db = new SQLite3('../storage/database.db');
        $sql = 'SELECT * FROM Notifications WHERE landlord_id = '.$landlord_id;
        $result = $db->query($sql);

        $arrayResult = [];
        $i = 0;
        while($row = $result->fetchArray()){
            $arrayResult[$i] = new Notification(false);
            $arrayResult[$i]->decryptValues($row); 
            $i += 1;
        }
        
        return $arrayResult;
    }*/



    function CreateNotification($tenant_id){
        $this->tenant_id = $tenant_id;
        if(!$this->validInsert()){
            return false;
        }         
    
        
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Notifications(landlord_id, tenant_id, subject, content, read, iv) VALUES(:landlord_id, :tenant_id, :subject, :content, :read, :iv)';

        $stmt = $db->prepare($sql);

        $iv = $this->createIV();
        $this->iv = $iv;        
        $landlord_id = $this->landlord_id;
        $tenant_id = $this->tenant_id;
        $subject = $this->encrypt($this->subject);
        $content = $this->encrypt($this->content);        
        $read = 0;
        
        $stmt->bindParam(':landlord_id', $landlord_id, SQLITE3_INTEGER);
        $stmt->bindParam(':tenant_id', $tenant_id, SQLITE3_INTEGER);
        $stmt->bindParam(':subject', $subject, SQLITE3_TEXT);
        $stmt->bindParam(':content', $content, SQLITE3_TEXT);
        $stmt->bindParam(':read', $read, SQLITE3_INTEGER);
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->notification_id = $db->lastInsertRowID();

        return $result;
    }




    function unpack($row){
        if($row){
            if(isset($row['notification_id'])){
                $this->notification_id = $row['notification_id'];
            }   
            if(isset($row['landlord_id'])){
                $this->landlord_id = $row['landlord_id'];
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $row['tenant_id'];
            }
            if(isset($row['subject'])){
                $this->subject = $row['subject'];
            }
            if(isset($row['content'])){
                $this->content = $row['content'];
            }
            if(isset($row['read'])){
                $this->read = $row['read'];
            }            
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }            
        }
    }

    function decryptValues($row){
        if($row){
            if(isset($row['notification_id'])){
                $this->notification_id = $row['notification_id'];
            }
            if(isset($row['landlord_id'])){
                $this->landlord_id = $row['landlord_id'];
            }
            if(isset($row['tenant_id'])){
                $this->tenant_id = $row['tenant_id'];
            }
            if(isset($row['read'])){
                $this->read = $row['read'];
            } 
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }

            if(isset($row['subject'])){
                $this->subject = $this->decrypt($row['subject']);
            }
            if(isset($row['content'])){
                $this->content = $this->decrypt($row['content']);
            }
        }
    }
}
