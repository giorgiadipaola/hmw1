function checkName(event) {
    const input = event.currentTarget;

    if (input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('error');
    } else {
        input.parentNode.parentNode.classList.add('error');
    }
    
}


function fetchResponse(response){
    if(!response.ok) return null;
    return response.json();
}
function jsonCheckUsername(json){
    if(!json.exists){
        document.querySelector('.username').classList.remove('error');
        console.log("connessione fatta")
    }
    else{
        document.querySelector('.username span').textContent= "Ups..nome utente già preso!"
        document.querySelector('.username').classList.add('error');
    }
}

function checkUsername(event){
        const input=document.querySelector('.username input');

        if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
            input.parentNode.parentNode.querySelector('span').textContent = "Deve contenere solo lettere, numeri e underscore.";
            input.parentNode.parentNode.classList.add('error');
        
       } else {
         fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
         }    

}
function checkEmail(event){
    const input=document.querySelector('.email input');

    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('error');
    }

    else{
        fetch("check_email.php?q="+encodeURIComponent(String(input.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}
function jsonCheckEmail(json){
    if (!json.exists) {
        document.querySelector('.email').classList.remove('error');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('error');
    }
}

function checkPassword(event) {
    const password = document.querySelector('.password input');
    if (password.value.length >= 8) {
        document.querySelector('.password').classList.remove('error');
    } else {
        document.querySelector('.password').classList.add('error');
    }
 
}

function checkConfirmPassword(event) {
    const confirm_password= document.querySelector('.confirm_password input');
    if (confirm_password.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('error');
    } else {
        document.querySelector('.confirm_password').classList.add('error');
    }

}
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkName);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);

function validazione(event)
{
    
    if(form.username.value.length == 0 || 
       form.password.value.length == 0
       || form.email.value.length == 0
       ||form.name.value.length == 0 
       ||form.surname.value.length == 0
       ||form.confirm_password.value.length == 0
       ||form.allow.value.length == 0)
    {
        document.querySelector("#checkForm").classList.remove("hidden");
        event.preventDefault();
    }
        
}


const form = document.forms['signup_form'];

form.addEventListener('submit', validazione);