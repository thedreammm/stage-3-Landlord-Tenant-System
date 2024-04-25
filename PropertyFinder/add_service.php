<?php
include ('../php_imports/header.php');

require_once("../php_classes/account_class.php");
if(!isset($_SESSION['landlord_id']) || isset($_SESSION['admin_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: index.php');
    }else{
        header("Location: signup.php");
    }
}
$landlord_id = $_SESSION['landlord_id'];
?>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Add a service provider's contact details</h1>
        <form class="form" name="form">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Company name</label>
                <input type="text" id="name" name="name" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" id="email" name="email" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone number</label>
                <input type="text" id="phone" name="phone" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
            </div>
        </form>
        <div class="flex justify-end mt-6">
            <button name="../php_imports/create_service" onclick="sendForm(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Save</button>
        </div>
    </div>
</div>

<?php include('../php_imports/footer.php')?>
