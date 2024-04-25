<?php
require_once('../php_imports/header.php');
require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/lease_class.php');

if(!isset($_SESSION['tenant_id']) || isset($_SESSION['admin_id'])){
    header('Location: index.php');
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

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Make Request</h1>
    <form class="form space-y-" name="form" action="../php_imports/create_request.php" method="post">
        <label class="block text-sm font-semibold text-gray-700">Property?</label>
        <select class="form_input" name="property_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option selected hidden disabled>Select one</option>
            <?php foreach ($properties as $propID){
                echo "<option value=\"$propID\">$propID</option>";
            }?>
        </select><br>
        
        <label class="block text-sm font-semibold text-gray-700">Issue:</label><input class="form_input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="text" name="issue"><br>
        <input type="hidden" name="tenant_id" value="<?php echo $_SESSION['tenant_id']?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        
        <div>
            <button type="submit" name="submit" value="Submit" class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Create
            </button>
        </div>
    </form>
</div>
        </div>

<?php include('../php_imports/footer.php')?>