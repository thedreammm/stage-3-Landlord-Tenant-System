<?php
include ('../php_imports/header.php');
require_once("../php_classes/service_provider_class.php");
require_once("../php_classes/account_class.php");

// Redirect if not logged in as landlord or tenant
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}

// Load service providers for the logged-in landlord
$landlord_id = $_SESSION['landlord_id'];
$service_providers = loadServiceProviders($landlord_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Service Providers</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .service-provider {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .service-provider label {
            font-weight: bold;
        }
        .service-provider span {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Your Service Providers:</h1>
        <?php if(count($service_providers) > 0): ?>
            <?php foreach($service_providers as $provider): ?>
                <div class="service-provider">
                    <label>Company name: </label><span><?php echo $provider->name; ?></span><br>
                    <label>Email address: </label><span><?php echo $provider->email; ?></span><br>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No service providers found.</p>
        <?php endif; ?>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>
