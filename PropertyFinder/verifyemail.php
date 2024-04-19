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

<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/script.js"></script>
    </head>
    <body>
        <h1>Enter your verification code</h1>
        <span id="response"><?php echo $result; ?></span>
        <form class="form" name="form">
            <label>Your code:</label><input class="form_input" type="text" name="verificationcode"><br>
        </form>
        <button name="../php_imports/update_account" onclick="sendForm(this)">Send</button>
        
    </body>
</html>
<?php include('../php_imports/footer.php')?>
