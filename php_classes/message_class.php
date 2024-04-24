<?php
require_once("databaseEntity_class.php");

Class Message extends DatabaseEntity{
    public $message_id, $room_id, $account_id, $content, $send_datetime;
    function __construct($params){
        parent::__construct("Direct_messages");
        $this->unpack($params);
    }
    function validInsert(){
        if($this->room_id == null || $this->account_id == null || $this->content == null){
            return false;
        }
        else{
            return true;
        }
    }
    function loadMessage(){
        if($this->message_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Direct_messages WHERE message_id=:message_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':message_id', $this->message_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->decryptValues($row);
            return true;
        }
    }
    function createMessage(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Direct_messages(room_id, account_id, content, send_datetime, iv) VALUES(:room_id, :account_id, :content, datetime("now"), :iv)';

        $stmt = $db->prepare($sql);

        $iv = $this->createIV();
        $this->iv = $iv;
        $room_id = $this->room_id;
        $account_id = $this->encrypt($this->account_id);
        $content = $this->encrypt($this->content);
        //$send_datetime

        $stmt->bindParam(':room_id', $room_id, SQLITE3_INTEGER);
        $stmt->bindParam(':account_id', $account_id, SQLITE3_TEXT);
        $stmt->bindParam(':content', $content, SQLITE3_TEXT);
        //$send_datetime
        $stmt->bindParam(':iv', $iv, SQLITE3_TEXT);
        $result = $stmt->execute();

        $this->message_id = $db->lastInsertRowID();

        return true;
    }
    function unpack($row){
        if($row){
            if(isset($row['message_id'])){
                $this->message_id = $row['message_id'];
            }
            if(isset($row['room_id'])){
                $this->room_id = $row['room_id'];
            }
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['content'])){
                $this->content = $row['content'];
            }
            if(isset($row['send_datetime'])){
                $this->send_datetime = $row['send_datetim'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }
        }
    }
    function decryptValues($row){
        if($row){
            if(isset($row['message_id'])){
                $this->message_id = $row['message_id'];
            }
            if(isset($row['room_id'])){
                $this->room_id = $row['room_id'];
            }
            if(isset($row['send_datetime'])){
                $this->send_datetime = $row['send_datetime'];
            }
            if(isset($row['iv'])){
                $this->iv = $row['iv'];
            }

            if(isset($row['account_id'])){
                $this->account_id = $this->decrypt($row['account_id']);
            }
            if(isset($row['content'])){
                $this->content = $this->decrypt($row['content']);
            }
        }
    }
}

Class MessageRoom extends DatabaseEntity{
    public $room_id;
    public $participants, $messages = array();
    function __construct($params){
        parent::__construct("Message_rooms");
        $this->unpack($params);
    }

    static function findRooms($account_id){
        if($account_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT room_id FROM Room_participants WHERE account_id=:account_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $message_rooms = array();
            while($row = $result->fetchArray()){
                $message_rooms[] = $row['room_id'];
            }

            return $message_rooms;
        }
        return false;
    }
    function loadMessageRoom($offset, $size, $send_datetime){
        if($this->room_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT account_id FROM Room_participants WHERE room_id=:room_id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':room_id', $this->room_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $i = 0;
            while($row = $result->fetchArray()){
                $this->participants[$i] = $row['account_id'];
                $i += 1;
            }

            $sql = 'SELECT * FROM Direct_messages WHERE room_id=:room_id';
            if($send_datetime){
                $sql .= ' AND send_datetime > datetime(:send_datetime)';
            }
            $sql .= ' ORDER BY send_datetime ASC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':room_id', $this->room_id, SQLITE3_INTEGER);
            if($send_datetime){
                $stmt->bindParam(':send_datetime', $send_datetime, SQLITE3_TEXT);
            }
            $sql .= ' LIMIT ' . $size . ' OFFSET ' . $offset;

            $result = $stmt->execute();
            $i = 0;
            while($row = $result->fetchArray()){
                $this->messages[$i] = new Message(false);
                $this->messages[$i]->decryptValues($row);
                $i += 1;
            }
            return true;
        }
    }
    function createMessageRoom(){
        //insertion is ALWAYS VALID...!!!!
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Message_rooms DEFAULT VALUES';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        $this->room_id = $db->lastInsertRowID();
        return true;
    }
    function addParticipants($new_participants){
        if($this->room_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'INSERT INTO Room_participants(room_id, account_id, join_datetime) VALUES(:room_id, :account_id, datetime("now"))';
            for($i = 0; $i < count($new_participants); $i++){
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':room_id', $this->room_id, SQLITE3_INTEGER);
                $stmt->bindParam(':account_id', $new_participants[$i]->account_id, SQLITE3_INTEGER);
                $result = $stmt->execute();
                if($result){
                    $this->participants[] = $new_participants[$i];
                }
            }
            return true;
        }
    }
    function unpack($row){
        if($row){
            if(isset($row['room_id'])){
                $this->room_id = $row['room_id'];
            }
            if(isset($row['participants'])){
                $this->participants = $row['participants'];
            }
            if(isset($row['messages'])){
                $this->messages = $row['messages'];
            }
        }
    }

    function removeIV(){
        parent::removeIV();
        for($i = 0; $i < count($this->messages); $i++){
            $this->messages[$i]->removeIV();
        }
    }
}