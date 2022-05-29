function validazione(event)
{
 
    if(form.username.value.length == 0 ||
       form.password.value.length == 0)
    {
        
        const error= document.querySelector("#error_span");
        error.classList.remove("hidden");
        event.preventDefault();
    }
        
}

const form = document.forms['login_form'];


form.addEventListener('submit', validazione);