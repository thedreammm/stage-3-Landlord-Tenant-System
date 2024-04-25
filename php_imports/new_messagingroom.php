<h1>New Room</h1>
<form class="form" name="form">
    <h3 class="text-3xl font-semibold text-gray-700">Add users to the room:</h3><br>
    <div id="usernames" class="form_array container mx-auto px-6 py-8" name="usernames">

    </div>
    <button class="text-3xl font-semibold text-gray-700" type="button" onclick="addUsername()">+</button>
</form>
<button class="text-3xl font-semibold text-gray-700" name="../php_imports/create_messagingroom" onclick="sendFormJSON(this)">Create Room</button>
