<?php
include ('../php_imports/header.php');
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}
$landlord_id = $_SESSION['landlord_id'];
?>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js_imports/rentpayment.js"></script>
</head>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Schedule Rent payments for a property</h1>
        <form class="form" name="form">
            <div class="mb-4">
                <label for="property_id" class="block text-sm font-medium text-gray-700">Property</label>
                <input type="text" id="property_id" name="property_id" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
            </div>
            <div class="mb-4">
                <label for="tenant_id" class="block text-sm font-medium text-gray-700">Tenant</label>
                <input type="text" id="tenant_id" name="tenant_id" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
            </div>
            <div id="rentpayments" class="form_array" name="rentpayments">
                
            </div>
            <button type="button" onclick="addRentpayment()" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Add additional payment</button>
        </form>
        <div class="flex justify-end mt-6">
            <button name="../php_imports/create_rentpayments" onclick="sendFormJSON(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Send</button>
        </div>
    </div>
</div>

<?php include('../php_imports/footer.php')?>
