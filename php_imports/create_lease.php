<?php require_once("../php_classes/lease_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");


$properties = [];
$properties = Property::loadPropID();

if(isset($_POST["submit"])){
    
    $docparams = [];
    $docparams['account_id'] = $_SESSION['account_id'];
    $docparams['property_id'] = $_POST['property_id'];
    $docparams['document_type'] = "rentalapplication";
    if(isset($_FILES["imageSubmission"])){
        $image_dirs = Document::uploadDocuments($docparams, $_FILES["imageSubmission"]);
        unset($_POST["imageSubmission"]);
        unset($_FILES["imageSubmission"]);
        $_POST['document_id'] = Document::lastDocID();
    }

    $_POST['tenant_id'] = $_SESSION['tenant_id'];


    $lease1 = new Lease($_POST); 
    $result = $lease1->CreateLease();

    header('Location: ../PropertyFinder/home.php');


};
