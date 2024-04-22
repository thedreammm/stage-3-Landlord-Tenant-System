<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <?php 
    include('../php_imports/header.php');
    require_once('../php_classes/property_class.php');
    if(!isset($_SESSION['landlord_id'])){
        header('Location: home.php');
    }
    $properties = Property::loadProperties($_SESSION);
    ?>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-xl">
            <h1 class="text-2xl font-bold mb-4 text-center">Send Notification</h1>
            <form class="space-y-4" name="form">
                <div>
                    <label class="block text-gray-700">Property</label>
                    <select class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" name="property_id">
                        <option selected hidden disabled>Select one</option>
                        <?php foreach ($properties as $property): ?>
                            <option value="<?php echo $property->property_id; ?>"><?php echo $property->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700">Subject:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="subject">
                </div>
                
                <div>
                    <label class="block text-gray-700">Message:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="content">
                </div>
                
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none" name="../php_imports/create_notifications" onclick="sendForm(this)">Send</button>
            </form>
            <span id="response" class="block mt-4"></span>
        </div>
    </div>
    <script>
        // JavaScript code to send form data
        function sendForm(button) {
            // Implement the form submission logic here
        }
    </script>
    <?php include('../php_imports/footer.php')?>
</body>
</html>