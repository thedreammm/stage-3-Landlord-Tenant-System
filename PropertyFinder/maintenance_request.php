<?php
require_once('../php_imports/header.php');
require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/lease_class.php');

if(!isset($_SESSION['tenant_id'])){
    header('Location: home.php');
    exit();
}

$properties = [];
$lease1 = new Lease($_SESSION);
$lease_array = $lease1->loadLease();
for($i = 0; $i < count($lease_array); $i++){
    if($lease_array[$i]->status == "Accepted"){
        $properties[] = $lease_array[$i]->property_id;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg shadow-lg">
        <div class="md:flex">
            <div class="w-full p-6">
                <h1 class="text-2xl font-semibold text-gray-800 text-center">Make Maintenance Requests</h1>
                <p class="text-gray-600 text-sm text-center my-2">Please fill out the form below to submit your issue.</p>
                
                <form class="mt-4" name="form" action="../php_imports/create_request.php" method="post">
                    <div class="mb-4">
                        <label for="property_id" class="block text-gray-700 text-sm font-bold mb-2">Property?</label>
                        <select id="property_id" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="property_id">
                            <option selected hidden disabled>Select one</option>
                            <?php foreach ($properties as $propID) {
                                echo "<option value=\"{$propID}\">{$propID}</option>";
                            }?>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="issue" class="block text-gray-700 text-sm font-bold mb-2">Issue:</label>
                        <input id="issue" type="text" name="issue" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    </div>
                    
                    <input type="hidden" name="tenant_id" value="<?php echo $_SESSION['tenant_id']?>">
                    
                    <div class="flex justify-center">
                        <input type="submit" name="submit" value="Submit" class="px-6 py-2 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-600 cursor-pointer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../php_imports/footer.php')?>

</body>
</html>
