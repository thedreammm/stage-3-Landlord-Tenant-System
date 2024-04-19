<?php include('../php_imports/header.php')?>

 
    <h1>Sign up</h1>
    <form class="form" name="form">
        <label>Username:</label><input class="form_input" type="text" name="username"><br>
        <label>First name:</label><input class="form_input" type="text" name="fname"><br>
        <label>Last name:</label><input class="form_input" type="text" name="lname"><br>
        <label>Your email:</label><input class="form_input" type="text" name="email"><br>
        <label>Password:</label><input class="form_input password" type="password" name="password"><br>
        <input type="checkbox" onclick="togglePassword(5)"> <label>Show password</label><br>
        <label>Account type:</label>
        <select class="form_input" name="account_type">
            <option selected hidden disabled>Select one</option>
            <option value="tenant">A tenant</option>
            <option value="landlord">A landlord</option>
        </select><br>
    </form>
    <button name="../php_imports/create_account" onclick="sendForm(this)">Send</button>
    <span id="response"></span>

    
<?php include('../php_imports/footer.php')?>
