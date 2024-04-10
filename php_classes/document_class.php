<?php
require_once("databaseEntity_class.php");

Class Document extends DatabaseEntity{
    public $document_id, $property_id, $account_id, $document_type, $name, $mime_type, $upload_datetime;
    public $attached_file;
    public static $doc_to_mime = array(
        'listingimage' => 'image/jpeg',
        'rentalapplication' => 'image/jpeg', //rental application consists of things like proof of identity & income
        'leaseagreement' => 'application/pdf',
        'titledeed' => 'application/pdf',
        'filledleaseagreement' => 'application/pdf',
    );

    function __construct($params){
        parent::__construct("Documents");
        $this->unpack($params);
    }

    static function uploadDocuments($post_vars, $file_array){
        $response = array();
        $i = 0;
        foreach($file_array['tmp_name'] as $tmp_name){
            $the_file = array(
                'name' => $file_array['name'][$i],
                'type' => $file_array['type'][$i],
                'tmp_name' => $tmp_name,
                'error' => $file_array['error'][$i],
                'size' => $file_array['size'][$i],
            );
            print_r($the_file);
            $document_obj = new Document($post_vars);
            $result = $document_obj->attachFile($the_file);
            print_r($document_obj);
            if($result){
                $document_obj->createDocument();
            }
            $response[$i] = "images/" . $document_obj->document_id . ".jpeg";
            $i += 1;
        }
        return $response;
    }

    function validInsert(){
        if($this->account_id == null || $this->document_type == null || $this->mime_type == null){
            return false;
        }
        else{
            return true;
        }
    }

    function loadDocument(){
        if($this->document_id){
            $db = new SQLite3('../storage/database.db');
            $sql = 'SELECT * FROM Documents WHERE document_id=:document_id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':document_id', $this->document_id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            $row = $result->fetchArray();
            
            $this->unpack($row);
            return true;
        }
    }

    function createDocument(){
        if(!$this->validInsert()){
            return false;
        }
        $db = new SQLite3('../storage/database.db');
        $sql = 'INSERT INTO Documents(property_id, account_id, document_type, name, mime_type, upload_datetime) VALUES(:property_id, :account_id, :document_type, :name, :mime_type, datetime("now"))';
        $stmt = $db->prepare($sql);

        $property_id = $this->property_id;
        $account_id = $this->account_id;
        $document_type = $this->document_type;
        $name = $this->name;
        $mime_type = $this->mime_type;
        //$upload_datetime = $this->upload_datetime;

        $stmt->bindParam(':property_id', $property_id, SQLITE3_INTEGER);
        $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER);
        $stmt->bindParam(':document_type', $document_type, SQLITE3_TEXT);
        $stmt->bindParam(':name', $name, SQLITE3_TEXT);
        $stmt->bindParam(':mime_type', $mime_type, SQLITE3_TEXT);
        //$stmt->bindParam(':upload_datetime', $upload_datetime, SQLITE3_TEXT);

        $result = $stmt->execute();

        $this->document_id = $db->lastInsertRowID();
        //if($this->mime_type == "image/jpeg"){
        //    $this->compressImage($this->attached_file);
        //}
        //else{
        move_uploaded_file($this->attached_file['tmp_name'], "../storage/documents/" . $this->document_id . ".jpeg");
        //}
        return true;
    }

    function unpack($row){
        if($row){
            if(isset($row['document_id'])){
                $this->document_id = $row['document_id'];
            }
            if(isset($row['property_id'])){
                $this->property_id = $row['property_id'];
            }
            if(isset($row['account_id'])){
                $this->account_id = $row['account_id'];
            }
            if(isset($row['document_type'])){
                $this->document_type = $row['document_type'];
            }
            if(isset($row['name'])){
                $this->name = $row['name'];
            }
            if(isset($row['mime_type'])){
                $this->mime_type = $row['mime_type'];
            }
            if(isset($row['upload_datetime'])){
                $this->upload_datetime = $row['upload_datetime'];
            }
        }
    }

    function attachFile($the_file){
        $this->unpackFileData($the_file);
        if($this->validFile($the_file)){
            $this->attached_file = $the_file;
            return true;
        }
        return false;
    }

    function unpackFileData($the_file){
        //setting mime_type on this class & stuff
        if(isset($the_file['name'])){
            $this->name = $the_file['name'];
        }
        if(isset($the_file['type'])){
            $this->mime_type = $the_file['type'];
        }
    }

    function validFile($the_file){
        if(!$this->document_type){
            return false;
        }
        $valid_type = Document::$doc_to_mime[$this->document_type];
        if(!($this->mime_type == $valid_type)){
            return false;
        }
        if($the_file['size'] > 6291456){ //(6)*(1024)*(1024)
            return false;
        }
        return true;
    }

    //this would require the GD library
    //function compressImage($the_file){
        //$the_jpeg = imagecreatefromjpeg($the_file['tmp_name']);
        //$destination = "images/" . $this->document_id . ".jpeg";
        //$result = imagejpeg($the_jpeg, $destination, 75);
        //imagedestroy($the_jpeg);
    //    return $result;
    //}
}
