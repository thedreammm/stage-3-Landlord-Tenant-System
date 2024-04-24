<?php require_once("../php_classes/account_class.php");
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");
$verResult = false;
$accounts_array = Account::loadUnVerAcc();
$prop_array = Property::loadUnVerProp();

