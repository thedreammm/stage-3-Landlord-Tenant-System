<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<?php
    include ('../php_imports/header.php');
    require_once("../php_classes/account_class.php");
    require_once("../php_classes/onetime_code_class.php");

    $account1 = new Account($_SESSION);
    $result = $account1->loadAccount();
    if($result){
        $email = $account1->email;
        
        $code = new OnetimeCode($_SESSION);
        $code->createCode();

        $result = "Results: ";
        $subject = "Verification code";
        $body = "Your verification code is: " . $code->code;
        $header = false;

        if($email && $subject && $body){
            $header = "From: " . $email;
            
            if (mail($email, $subject, $body, $header)) {
                $result = "Email was successfully sent.";
            }
        }
        $result .= ( ($email) ? " The Email used was " . $email : " No Email on record. " );

    }
?>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-semibold mb-4">Enter your verification code</h1>
            <div id="response" class="mb-4 text-sm text-green-500"><?php echo $result; ?></div>
            <form class="form" name="form" onsubmit="sendForm(this); return false;">
                <div class="flex flex-col space-y-2 mb-4">
                    <label for="verificationcode" class="block mb-2">Your code:</label>
                    <input class="form_input border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" type="text" id="verificationcode" name="verificationcode">
                </div>
                <button type="submit" name="../php_imports/update_account" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                    Send
                </button>
            </form>
        </div>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>