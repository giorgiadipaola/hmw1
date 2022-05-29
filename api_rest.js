const modal=document.querySelector("#modal-view");
const track_view= modal.querySelector("#contents");
function fetchQuery(event)
{event.preventDefault();
    
    const url = "spotify_api.php?";

    const form_data = new FormData(document.querySelector("form"));

    
    fetch(url+"&q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(searchJson);


}


function searchResponse(response){
    console.log(response);
    return response.json();
}

function searchJson(json){
     console.log(json);
    
    track_view.innerHTML='';
    const iframe=document.createElement('iframe');
    iframe.src = "https://open.spotify.com/embed/track/"+json.tracks.items[0].id;
    iframe.setAttribute('allowtransparency', 'true');
    iframe.allow = "encrypted-media";
    iframe.classList = "track_iframe";
    track_view.appendChild(iframe);
}

const form= modal.querySelector("form");
form.addEventListener("submit", fetchQuery);

const pause_coffe= document.querySelector("#pause-coffee");
const modal_view=document.querySelector("#modal-view")
pause_coffe.addEventListener("click", onCoffeeClick);
modal_view.querySelector("#close-query span").addEventListener("click", Close);
function onCoffeeClick(){
    modal_view.classList.remove("hidden");
    document.body.classList.add('no-scroll');
  
}

function Close(){
    modal_view.classList.add("hidden");
    document.body.classList.remove('no-scroll');
     track_view.innerHTML="";
    
}