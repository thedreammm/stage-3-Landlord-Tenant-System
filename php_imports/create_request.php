<?php include("header.php"); 
require_once("../php_classes/maintenance_class.php");
$message = null;
if(isset($_POST['submit'])){
    
    if(isset($_POST['property_id'], $_POST['issue'], $_POST['tenant_id'])){
        
        $request1 = new Maintenance($_POST);
        $result = $request1->CreateRequest();
        
        if($result){
            $message = "Maintenance request created successfully.";
        } else {
            $message = "Error creating maintenance request.";
        }
    } else {
        $message = "Missing required fields.";
    }
} else {
    $message = "Form submission not detected.";
}
?>
    <div><?php echo $message?></div> 
    <div><a href="../PropertyFinder/home.php">Go home</a></div>
<?php include("footer.php") ?>