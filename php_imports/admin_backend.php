<?php require_once("../php_classes/account_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");
$verResult = false;
$accounts_array = Account::loadUnVerAcc();
$prop_array = Property::loadUnVerProp();

if(isset($_GET['pid'])){
    $_GET['pid'] = $property_id;
    $property1 = new Property(false);
    $property1->property_id = $property_id;
    $property1->loadProperty();
    $document_array = Document::loadDocuments($property_id, "titledeed");
    $display_array = array();
    for($i = 0; $i < count($document_array); $i++){
        $display_array[$i] = $document_array[$i]->displayDocument();
    }

}
if(isset($_POST["submit"])){
    $pid = $_POST["property_id"];
    $property2 = new Property(false);
    $property2->property_id = $pid;
    $verResult = $property2->verifyProp();
}