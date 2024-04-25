function addUsername(){
    div = document.getElementById("usernames");
    div.insertAdjacentHTML('beforeend', '<label>User:</label><input  container mx-auto px-6 py-8 class="form_input" type="text" name="username"><br>');
    return;
}
