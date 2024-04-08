function addUsername(){
    div = document.getElementById("usernames");
    div.insertAdjacentHTML('beforeend', '<label>User:</label><input class="form_input" type="text" name="username"><br>');
    return;
}
