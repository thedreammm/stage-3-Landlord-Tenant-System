<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <h1>Log in</h1>
        <form class="form" name="form">
            <label>Username:</label><input class="form_input" type="text" name="username"><br>
            <label>Password:</label><input class="form_input password" type="text" name="password"><br>
        </form>
        <button name="login_account" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </body>
</html>
