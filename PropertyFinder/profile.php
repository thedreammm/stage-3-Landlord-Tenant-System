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
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Account details:</h1>
        <form class="form" name="form">
            <label>Username: </label><input class="form_input" type="text" name="username" value="<?php echo $account1->username; ?>"><br>
            <label>First name:</label><input class="form_input" type="text" name="fname" value="<?php echo $account1->fname; ?>"><br>
            <label>Last name:</label><input class="form_input" type="text" name="lname" value="<?php echo $account1->lname; ?>"><br>
            <label>Your email:</label><input class="form_input" type="text" name="email" value="<?php echo $account1->email; ?>"><br>
        </form>
        <button name="../php_imports/update_account" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
