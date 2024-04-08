<?php include('../php_imports/header.php')?>

    <h1>Log in</h1>
    <form class="form" name="form">
        <label>Username:</label><input class="form_input" type="text" name="username"><br>
        <label>Password:</label><input class="form_input password" type="text" name="password"><br>
    </form>
    <button name="../php_imports/login_account" onclick="sendForm(this)">Send</button>
    <span id="response"></span>

        
<?php include('../php_imports/footer.php')?>