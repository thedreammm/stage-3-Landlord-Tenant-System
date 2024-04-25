<?php session_start();
$loggedIn = 0; ///0 not logged in, 1 tenant, 2 landlord, 3 admin(?)
if(isset($_SESSION['account_id'])){
    if(isset($_SESSION['tenant_id'])){
        $loggedIn = 1;
    }
    else if(isset($_SESSION['landlord_id'])){
        $loggedIn = 2;
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Tenant System</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <!-- Leaflet API for map doing not finished will have another look--> 
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <script type="text/javascript" src="../js_imports/property.js"></script>
    
</head>
<body class="bg-gray-100">

<header class="bg-white shadow">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="text-3xl text-red-500 font-bold">PropertyFinder</div>
            <nav class="space-x-4 text-gray-700 text-sm sm:text-base">
            <?php 
            if($loggedIn == 0): ?>
                <a href="index.php" class="no-underline hover:text-red-500">Search</a>
                <a href="login.php" class="no-underline hover:text-red-500">Log in</a>
                <a href="signup.php" class="no-underline hover:text-red-500">Sign up</a>
            <?php endif;
            if($loggedIn == 1): ?>
                <a href="index.php" class="no-underline hover:text-red-500">Search</a>
                <a href="messages.php" class="no-underline hover:text-red-500">Messages</a>
                <a href="tenant_notifications.php" class="no-underline hover:text-red-500">Notifications</a>
                <a href="edit_account.php" class="no-underline hover:text-red-500">Profile</a>
            <?php endif;
            if($loggedIn == 2): ?>
                <a href="index.php" class="no-underline hover:text-red-500">Search</a>
                <a href="messages.php" class="no-underline hover:text-red-500">Messages</a>
                <a href="landlord_dashboard.php" class="no-underline hover:text-red-500">Properties</a>
                <a href="edit_account.php" class="no-underline hover:text-red-500">Profile</a>
            <?php endif; ?>
            </nav>
        </div>
    </div>

    <div>
        <a>
            <h1>LTS</h1>
        </a>
        <nav>
            <ul>
                <li><a href="add_service.php">Add Service</a></li>
                <li><a href="view_services.php">View added services</a></li>
                <li><a href="verifyemail.php">Verify your email</a></li>
                <li><a href="resetpassword.php">Reset your password</a></li>
                <li><a href="add_rentpayment.php">Add Rent payments</a></li>
                <li><a href="view_rentpayment.php">View Rent payment</a></li>
            </ul>
        </nav>
    </div>
</header>