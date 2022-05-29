function updateMates(){
    fetch("mates_db_get.php").then(responseUpdate).then(onMatesJson);
}

function onMatesJson(json){
console.log(json);
const box= document.querySelector("#box-mates");
for(let mate of json){
const user=document.createElement("div");
user.classList.add("mate-profile");
const img_profile=document.createElement("img");
img_profile.src="studente.png";
const username=document.createElement("span");
username.classList.add("username-mate");
username.textContent="@"+mate.username;
const email=document.createElement("span");
email.textContent=mate.email;
email.classList.add("username-mate");

user.appendChild(img_profile);
user.appendChild(username);
user.appendChild(email);
box.appendChild(user);

}

}

function responseUpdate(response)
{   console.log("responseUpdate");
    return response.json();
}

    


updateMates();

