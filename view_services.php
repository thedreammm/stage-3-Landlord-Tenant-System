<?php
require_once("service_provider_class.php");
require_once("account_class.php");
session_start();
$account_id = $_SESSION['account_id'];
$account1 = new Landlord(array('account_id'=>$account_id));
$result = $account1->loadAccount();
$landlord_id = false;
$service_providers = array();
if($result){
    $landlord_id = $account1->landlord_id;
    $service_providers = loadServiceProviders($landlord_id);
}

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
