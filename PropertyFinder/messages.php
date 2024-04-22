<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include('../php_imports/header.php'); ?>
    <?php
    if(!isset($_SESSION['account_id'])){
        header("Location: signup.php");
        exit();
    }
    $account_id = $_SESSION['account_id'];
    ?>
    <?php require_once('../php_imports/setup_messaging.php'); ?>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-semibold mb-4">Messaging System</h2>

            <div class="flex justify-between items-center mb-4">
                <button onclick="startNewChat()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none">
                    Start New Chat
                </button>
                <button onclick="addUsersToChat()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                    Add Users
                </button>
            </div>

            <div id="messages" class="space-y-4 max-h-96 overflow-y-auto p-4 mb-4">
                <!-- Messages will be loaded here -->
            </div>

            <form class="form" name="form">
                <textarea class="form_input w-full p-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500" name="content" placeholder="Type your message here..."></textarea>
                <input hidden id="room_id" class="form_input" name="room_id" value="">
                <input hidden class="form_input" name="account_id" value="<?php echo $account_id; ?>">
                <button type="button" name="../php_imports/send_message" onclick="sendForm(this)" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                    Send
                </button>
            </form>
            <span id="response" class="text-sm text-red-500"></span>
        </div>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>