<h1>New Room</h1>
<form class="form" name="form">
    <h3>Add users to the room:</h3><br>
    <div id="usernames" class="form_array" name="usernames">

    </div>
    <button type="button" onclick="addUsername()">+</button>
</form>
<button name="../php_imports/create_messagingroom" onclick="sendFormJSON(this)">Create Room</button>
