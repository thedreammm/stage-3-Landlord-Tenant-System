<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service Provider</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <?php 
    include('../php_imports/header.php');
    require_once("../php_classes/account_class.php");
    if(!isset($_SESSION['landlord_id'])){
        if(isset($_SESSION['tenant_id'])){
            header('Location: home.php');
        }else{
            header("Location: signup.php");
        }
    }
    $landlord_id = $_SESSION['landlord_id'];
    ?>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-xl">
            <h1 class="text-2xl font-bold mb-4 text-center">Add a Service Provider's Contact Details</h1>
            <form class="space-y-4" name="form">
                <div>
                    <label class="block text-gray-700">Company name:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="name">
                </div>
                <div>
                    <label class="block text-gray-700">Email address:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="email">
                </div>
                <input type="hidden" name="landlord_id" value="<?php echo $landlord_id; ?>">
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none" name="../php_imports/create_service" onclick="sendForm(this)">Send</button>
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