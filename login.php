<?php include('header.php')?>

    <h1>Log in</h1>
    <form class="form" name="form">
        <label>Username:</label><input class="form_input" type="text" name="username"><br>
        <label>Password:</label><input class="form_input password" type="text" name="password"><br>
    </form>
    <button name="login_account" onclick="sendForm(this)">Send</button>
    <span id="response"></span>

        
<?php include('footer.php')?>