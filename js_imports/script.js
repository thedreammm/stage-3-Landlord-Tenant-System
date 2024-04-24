function postFile(filename, destination, post_vars){
    var Request = makeRequest();
    console.log(filename);
    console.log(post_vars);
    Request.open("POST",filename);
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.onreadystatechange = function(){
        if(Request.readyState == 4 && Request.status == 200){
            console.log(Request.responseText);
            document.getElementById(destination).innerHTML = Request.responseText;
            if(filename == "../php_imports/create_account.php" || filename == "../php_imports/login_account.php")
            {window.location.href = 'home.php'};            
        }
    }
    Request.send(post_vars);
}

function postJsonToFile(filename, destination, post_JSON){
    var Request = makeRequest();
    Request.open("POST", filename);
    Request.setRequestHeader('Content-Type', 'application/json');
    Request.onreadystatechange = function(){
        if(Request.readyState == 4 && Request.status == 200){
            console.log(Request.responseText);
            document.getElementById(destination).innerHTML = Request.responseText;
            
        }
    }
    Request.send(post_JSON);
}

function postForJson(filename, destination, post_vars){
    var Request = makeRequest();
    console.log(filename);
    console.log(post_vars);
    Request.responseType = 'json';
    Request.open("POST",filename);
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.onreadystatechange = function(){
        if(Request.readyState == 4 && Request.status == 200){
            console.log(Request.response);
            var newMessage = new MessagingRoom(Request.response);
            newMessage.displayRoom(destination);
        }
    }
    Request.send(post_vars);
}

function makeRequest(){
    var Request = null;
    if(window.XMLHttpRequest){
        Request = new XMLHttpRequest();
    }
    else if(window.ActiveXObject){
        Request = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return Request;
}

function sendForm(element){
    var filename = element.name + ".php";
    console.log(filename);
    var destination = "response";
    var post_vars = formToPostvars();
    postFile(filename, destination, post_vars);
}

function sendFormJSON(element){
    var filename = element.name + ".php";
    console.log(filename);
    var destination = "response";
    var post_JSON = formToJSON();
    postJsonToFile(filename, destination, post_JSON);
}

function formToPostvars(){
    var post_vars = "";
    element = document.getElementsByClassName("form")[0];
    post_vars = recursiveGetPostvars(post_vars, element);
    post_vars = post_vars.substring(1);
    return post_vars;
}

function recursiveGetPostvars(post_vars, element){
    let name = element.getAttribute("name");
    if(element.classList.contains("form_input")){
        post_vars += "&" + element.name + "=" + element.value;
    }
    else{
        for(let i = 0; i < element.children.length; i++){
            post_vars = recursiveGetPostvars(post_vars, element.children[i]);
        }
    }
    return post_vars;
}

function recursiveDigest(theJSON, element){
    let name = element.getAttribute("name");
    if(element.classList.contains("form_input")){
        console.log(1);
        theJSON[name] = element.value;
    }
    else if(element.classList.contains("sub_form")){
        console.log(2);
        theJSON[name] = {};
        for(let i = 0; i < element.children.length; i++){
            recursiveDigest(theJSON[name], element.children[i]);
        }
    }
    else if(element.classList.contains("form_array")){
        console.log(3);
        theJSON[name] = [];
        let j = 0;
        for(let i = 0; i < element.children.length; i++){
            if(element.children[i].classList.contains("form_input") || element.children[i].classList.contains("sub_form")){
                theJSON[name].push({});
                recursiveDigest(theJSON[name][j], element.children[i]);
                j+=1;
            }
        }
    }
    else{   //its like a generic div for styling or whatevs
        console.log(4);
        for(let i = 0; i < element.children.length; i++){
            recursiveDigest(theJSON, element.children[i]);
        }
    }
}

function formToJSON(){
    var formJSON = {};
    element = document.getElementsByClassName("form")[0];

    for(var i = 0; i < element.children.length; i++){
        recursiveDigest(formJSON, element.children[i]);
    }
    return JSON.stringify(formJSON);
}

function togglePassword(){
    passwordElement = document.getElementsByClassName("password")[0];
    if(passwordElement.type == "password"){
        passwordElement.type = "text";
    }
    else{
        passwordElement.type = "password";
    }
    return;
}

class Message {
    constructor(json_response){
        this.message_id = json_response.message_id;
        this.account_id = json_response.account_id;
        this.content = json_response.content;
        this.send_datetime = json_response.send_datetime;
    }

    loadMessage(div){
        div.insertAdjacentHTML("beforeend", "<li>[id:  " + this.message_id + "] [sent by: " + this.account_id + "] [sent at: " + this.send_datetime + "] [content: " + this.content + "]</li>");
        return;
    }
}

class MessagingRoom {
    constructor(json_response){
        this.room_id = json_response.room_id;
        this.participants = json_response.participants;
        this.messages = [];
        for(var i = 0; i < json_response.messages.length; i++){
            this.messages.push(new Message(json_response.messages[i]));
        }
    }

    displayRoom(destination){
        var div = document.getElementById(destination);
        div.innerHTML = "";
        for(var i = 0; i < this.messages.length; i++){
            this.messages[i].loadMessage(div);
        }

        document.getElementById("room_id").value = this.room_id;
    }
}

function makedisplay(id){
    var element = document.getElementById(id);
    element.type = "submit";
    return;
}