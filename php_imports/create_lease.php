<?php require_once("../php_classes/lease_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");

if(isset($_POST["send_document"])){
    
    $docparams = [];
    $docparams['account_id'] = $_SESSION['account_id'];
    if(isset($_POST['property_id'])){
        $docparams['property_id'] = $_POST['property_id'];
    }
    else if(isset($property_id)){
        $docparams['property_id'] = $property_id;
    }
    else{
        header('Location: ../PropertyFinder/index.php');
    }
    $docparams['document_type'] = "rentalapplication";
    if(isset($_FILES["imageSubmission"])){
        $image_dirs = Document::uploadDocuments($docparams, $_FILES["imageSubmission"]);
        unset($_POST["imageSubmission"]);
        unset($_FILES["imageSubmission"]);
        $_POST['document_id'] = Document::lastDocID();
    
        $_POST['tenant_id'] = $_SESSION['tenant_id'];
        $lease1 = new Lease($_POST); 
        $result = $lease1->CreateLease();
    }

    header('Location: ../PropertyFinder/view_property.php?pid=' . $docparams['property_id']);
};
