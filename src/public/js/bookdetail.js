const modal = document.getElementById("reviewmodal");
const reviewbtn = document.getElementById("review-button");
const closebtn = document.getElementById("close-review");
const submitbtn = document.getElementById("submit-review");
const morereviewbtn = document.getElementById("load-more");

let reviewOffset = 2;

reviewbtn.onclick = function() {
    modal.style.display = "flex";
}

closebtn.onclick = function() {
    modal.style.display = "none";
}

submitbtn.onclick = function() {
    modal.style.display = "none";
}

function getMoreReviews(){
    let xhr = new XMLHttpRequest();

    const queryString = window.location.search;
    const reviewparams = new URLSearchParams(queryString);
    reviewparams.set("offset", reviewOffset);

    xhr.open("GET", "/api/bookdetailrvw?" + reviewparams, true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            if(xhr.response != ''){
                document.getElementById("review-block").innerHTML += xhr.response;
                reviewOffset += 1;
            } else{
                morereviewbtn.style.display = "none";
            }
        }
    }
    xhr.send();
}

morereviewbtn.onclick = getMoreReviews;