<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <?php 
    include ('../php_imports/header.php');
    require_once("../php_classes/account_class.php");
    if(!isset($_SESSION['account_id'])){
        header('Location: signup.php');
    }
    $account_id = $_SESSION['account_id'];
    $account1 = new Account(false);
    $account1->account_id = $account_id;
    $account1->loadAccount();
    ?>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-xl">
            <h1 class="text-2xl font-bold mb-4 text-center">Account Details</h1>
            <form class="space-y-4" name="form">
                <div>
                    <label class="block text-gray-700">Username:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="username" value="<?php echo $account1->username; ?>">
                </div>
                <div>
                    <label class="block text-gray-700">First Name:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="fname" value="<?php echo $account1->fname; ?>">
                </div>
                <div>
                    <label class="block text-gray-700">Last Name:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="lname" value="<?php echo $account1->lname; ?>">
                </div>
                <div>
                    <label class="block text-gray-700">Your Email:</label>
                    <input class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" type="text" name="email" value="<?php echo $account1->email; ?>">
                </div>
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none" name="../php_imports/update_account" onclick="sendForm(this)">Send</button>
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