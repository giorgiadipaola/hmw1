function updateCourses()
{   console.log("updateCourses");
    
    fetch("your_courses_get_db.php").then(responseUpdate).then(onJSON);
}

function responseUpdate(response)
{   console.log("responseUpdate");
    return response.json();
}

function onJSON(json){
    console.log("onJSON");
    const courses_view= document.querySelector("#courses-section");
    courses_view.innerHTML='';
    for(let course of json){
        
        const first_div= document.createElement("div");
        first_div.dataset.id= course.id;
        first_div.classList.add("course");
        const img= document.createElement("img");
        img.src= course.img_src;
        const subject= document.createElement("p");
        subject.classList.add("subject");
        subject.textContent=course.coursename;
        const teacher= document.createElement("p");
        teacher.classList.add("teacher");
        teacher.textContent="@"+course.teacher;
        const schedule=document.createElement("div");
        schedule.classList.add("schedule");
        const calendar_month=document.createElement("span");
        calendar_month.classList.add("material-symbols-outlined");
        calendar_month.textContent="calendar_month";
        const schedule_date=document.createElement("div");
        schedule_date.classList.add("schedule-date");

        const schedule1=document.createElement("span");
        const schedule2=document.createElement("span");
        schedule1.textContent=course.schedule1;
        schedule2.textContent=course.schedule2;
        
        const sub=document.createElement("div");
        sub.classList.add("sub");
        const sub_symbol=document.createElement("span");
        sub_symbol.classList.add("material-symbols-outlined");
        sub_symbol.textContent="bookmark_remove";
       
        first_div.appendChild(img);
        first_div.appendChild(subject);
        first_div.appendChild(teacher);
        first_div.appendChild(schedule);
        schedule.appendChild(calendar_month);
        schedule.appendChild(schedule_date);
        schedule_date.appendChild(schedule1);
        schedule_date.appendChild(schedule2);
        first_div.appendChild(sub);
        sub.appendChild(sub_symbol);
        

       sub_symbol.addEventListener("click", onUnsubClick);
       courses_view.appendChild(first_div);
    }
}

updateCourses();

function onUnsubClick(event){
    const unsub_button= event.currentTarget;
     const form= new FormData();

     form.append('courseid',unsub_button.parentNode.parentNode.dataset.id);
     const form_data={method:'post', body: form};
    //  fetch("unsubscription_course.php", form_data).then(responseUnsubscribe).then(onjson);
    fetch("unsubscription_course.php", form_data).then(responseUnsubscribe).then(function (json){ updateCourses();
        updateNcourses(json);
        updateMates();})
     event.preventDefault();
 }

 function responseUnsubscribe(response){
    
    return response.json();
 }

//  function onjson(json){
//     console.log(json);
//     updateCourses();
//     updateNcourses(json);
//     updateMates();
//  }


 function updateNcourses(json){
     console.log(json);
    const new_count = document.querySelector("#count-update")
    new_count.textContent=json.ncourses;


 }


 /*----------------MATES--------------*/

function updateMates(){
    document.querySelector("#box-mates").innerHTML="";
        fetch("mates_db_get.php").then(responseUpdate).then(onMatesJson);
        console.log("io");
}

function onMatesJson(json){
    console.log(json);
   
   const box=document.querySelector("#box-mates");
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



updateMates();
