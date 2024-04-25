<?php
include ('../php_imports/header.php');
require_once("../php_classes/service_provider_class.php");
require_once("../php_classes/account_class.php");
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: index.php');
    }else{
        header("Location: signup.php");
    }
}
$landlord_id = $_SESSION['landlord_id'];
$service_providers = loadServiceProviders($landlord_id);

?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Your Service Providers:</h1>
        <?php for($i = 0; $i < count($service_providers); $i++): ?>
            <div>
                <label>Company name: </label><span><?php echo $service_providers[$i]->name; ?></span><br>
                <label>Email address: </label><span><?php echo $service_providers[$i]->email; ?></span><br>
            </div>
            <br>
        <?php endfor; ?>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
