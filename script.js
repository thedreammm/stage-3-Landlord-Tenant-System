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
    console.log(element);
    console.log(element.children.length);
    var j = 0;
    for(var i = 0; i < element.children.length; i++){
        console.log(element.children[i].class, element.children[i].class == "form_input")
        if(element.children[i].classList.contains("form_input")){
            console.log(element.children[i]);
            if(j > 0){
                post_vars += "&";
            }
            post_vars += element.children[i].name + "=" + element.children[i].value;
            j += 1;
        }
    }
    return post_vars;
}

function recursiveDigest(theJSON, element){
    let name = element.getAttribute("name");
    if(element.classList.contains("form_input")){
        theJSON[name] = element.value;
    }
    else if(element.classList.contains("sub_form")){
        theJSON[name] = {};
        for(let i = 0; i < element.children.length; i++){
            recursiveDigest(theJSON[name], element.children[i]);
        }
    }
    else if(element.classList.contains("form_array")){
        theJSON[name] = [];
        let j = 0;
        for(let i = 0; i < element.children.length; i++){
            if(element.children[i].classList.contains("form_input")){
                theJSON[name].push({});
                recursiveDigest(theJSON[name][j], element.children[i]);
                j+=1;
            }
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
