function updateCourses()
{
    
    fetch("courses_db_get.php").then(responseUpdate).then(onJSON);
}

function responseUpdate(response)
{
    return response.json();
}

function onJSON(json){
    console.log(json);
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
        const best_seller=document.createElement("img");
        best_seller.src="best_seller.png";
        best_seller.id="best_seller";
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
        const students_count= document.createElement("div");
        const students=document.createElement("img");
        students.src="studente.png";
        students_count.classList.add("students-count");
        const sub_update=document.createElement("span");
        sub_update.classList.add("sub_update");
        sub_update.textContent=course.nsubs;
        
        const sub_symbol=document.createElement("span");

        sub_symbol.classList.add("material-symbols-outlined");
        sub_symbol.id="material"
        if (course.subscribed == 0) {
            sub_symbol.textContent="bookmarks";
            sub_symbol.addEventListener('click', onSubClick);
        } else {
            sub_symbol.textContent="add_task";
        }
        
        
       
        first_div.appendChild(img);
        first_div.appendChild(subject);
        first_div.appendChild(teacher);
        first_div.appendChild(schedule);
        schedule.appendChild(calendar_month);
        schedule.appendChild(schedule_date);
        schedule_date.appendChild(schedule1);
        schedule_date.appendChild(schedule2);
        first_div.appendChild(sub);
        students_count.appendChild(sub_update)
        students_count.appendChild(students);
        sub.appendChild(students_count);
        sub.appendChild(sub_symbol);
        
        if(course.nsubs>1){
           
            subject.appendChild(best_seller);
            
            }
        
       courses_view.appendChild(first_div);
    }
}



 function onSubClick(event){
    const sub_button= event.currentTarget;
     const form= new FormData();

     form.append('courseid',sub_button.parentNode.parentNode.dataset.id);
     const form_data={method:'post', body: form};
     fetch("subscription_course.php", form_data).then(responseSubscribe).then(function (json){ return afterSub(json, sub_button); });
    event.preventDefault();
    }

 function afterSub(json,sub_button){
    console.log(json);
    const new_sub_count=sub_button.parentNode.querySelector(".sub_update").innerText=json.nsubs;
    sub_button.removeEventListener('click',onSubClick );
    sub_button.textContent="add_task";
}
 function responseSubscribe(response){
     return response.json();
 }


 
function onResponse(response){
    return response.json();
}



/*------------- */

updateCourses();
