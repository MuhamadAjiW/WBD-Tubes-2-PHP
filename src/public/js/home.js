
function changePage(page){
    const homeQueryString = window.location.search;
    const homeParams = new URLSearchParams(homeQueryString);
    const homeBooklist = document.getElementById('content-booklist');
    homeParams.set('page', page);
    
    let xhr = new XMLHttpRequest();
    
    window.history.replaceState({}, "", "/home?" + homeParams.toString());

    xhr.open("GET", "/api/homelist?" + homeParams.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            homeBooklist.innerHTML = xhr.response;
        }
    }
    xhr.send();
}

function showDate(){
    let currentDate = new Date();
    let daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    let dayOfWeek = daysOfWeek[currentDate.getDay()];
    let dayOfMonth = currentDate.getDate();
    let month = months[currentDate.getMonth()];
    let year = currentDate.getFullYear();
    
    let formattedDate = dayOfWeek + ', ' + dayOfMonth + ' ' + month + ' ' + year;
    
    document.getElementById("currentdate").innerHTML = formattedDate;
}

showDate();