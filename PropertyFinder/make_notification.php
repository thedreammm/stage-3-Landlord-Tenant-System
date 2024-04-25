<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
if(!isset($_SESSION['landlord_id'])){
    header('Location: index.php');
}
$properties = Property::loadProperties($_SESSION);
?>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Send Notification</h1>
        <form class="form" name="form">
            <div class="mb-4">
            <label for="property_id" class="block text-sm font-medium text-gray-700">Property</label>
            <select id="property_id" name="property_id" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option selected hidden disabled>Select one</option>
                <?php foreach ($properties as $property):?>
                    <option value="<?php echo $property->property_id; ?>"><?php echo $property->title; ?></option>";
                <?php endforeach; ?>
            </select><br>
            
            <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label><input type="text" id="subject" name="subject" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="content" class="block text-sm font-medium text-gray-700">Object:</label><input type="text" id="content" name="content"class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </form>
        <div class="flex justify-end mt-6">
            <button name="../php_imports/create_notifications" onclick="sendForm(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Send</button>
        </div>
    </div>
</div>

<?php include('../php_imports/footer.php')?>