<?php
include ('../php_imports/header.php');
require_once("../php_classes/property_class.php");
require_once("../php_classes/document_class.php");
$account_id = "";
if(isset($_SESSION['account_id'])){
    $account_id = $_SESSION['account_id'];
}

$response = "";
$property_id = null;
$image_dirs = array();

if(isset($_POST["property_id"])){
    $property_obj = new Property($_POST);
    $property_obj->loadProperty();
    $property_id = $property_obj->property_id;
}
if(isset($_POST["submit"])){
    if(isset($_FILES["imageSubmission"])){
        $image_dirs = Document::uploadDocuments($_POST, $_FILES["imageSubmission"]);
    }
}

?>

<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/script.js"></script>
    </head>
    <body>
        <form method="post" action="upload_documents.php" enctype="multipart/form-data">
            <label>Which type of document is it:</label>
            <select name="document_type">
                <option selected hidden disabled>Select one</option>
                <option value="listingimage">Listing image</option>
                <option value="rentalapplication">Rental application</option>
                <option value="leaseagreement">Lease agreement</option>
                <option value="titledeed">Title deed</option>
                <option value="filledleaseagreement">Filled out lease agreement</option>
            </select><br>
            <input type="file" id="imageSubmission" name="imageSubmission[]" accept="image/jpeg, application/pdf" multiple><br>
            
            <label <?php if($property_id){ echo 'type="hidden"'; } ?>>Property id: </label><input <?php if($property_id){ echo 'type="hidden"'; } ?> name="property_id" value="<?php echo $property_id; ?>"><br>
            <label <?php if($account_id){ echo 'type="hidden"'; } ?>>Account id:</label><input <?php if($account_id){ echo 'type="hidden"'; } ?> name="account_id" value="<?php echo $account_id; ?>"><br>
            <input type="submit" name="submit" value="submit">
        </form>
        <label id="response"><?php echo $response; ?></label>

        <?php foreach($image_dirs as $image){
            echo '<img src="' . $image . '"><br>';
        }?>
    </body>

</html>
<?php include('../php_imports/footer.php')?>
