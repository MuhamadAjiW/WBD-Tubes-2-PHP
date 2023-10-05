const modal = document.getElementById("reviewmodal");
const reviewbtn = document.getElementById("review-button");
const closebtn = document.getElementById("close-review");
const submitbtn = document.getElementById("submit-review");
const morereviewbtn = document.getElementById("load-more");

const bid_data = document.getElementById("bid-data");
const edit_data = document.getElementById("edit-data");
const review_input = document.getElementById("form-review");
const rating_input = document.getElementById("ratingval");

let reviewOffset = 2;

reviewbtn.onclick = function() {
    modal.style.display = "flex";
}

closebtn.onclick = function() {
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

function submitReview(){
    const bid_data = document.getElementById("bid-data");
    const edit_data = document.getElementById("edit-data");
    const review_input = document.getElementById("form-review");
    const rating_input = document.getElementById("ratingval");
    
    let xhr = new XMLHttpRequest();
    if(edit_data.value == true){
        console.log("edit")
        xhr.open("POST", "/api/editreview", true);    
    }
    else{
        console.log("add")
        xhr.open("POST", "/api/addreview", true);    
    }
    
    const formData = new FormData();
    formData.append("bid", bid_data.value);
    formData.append("review", review_input.value);
    formData.append("rating", rating_input.value);

    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            location.href = window.location.href;
        }
    }
    xhr.send(formData);
}

morereviewbtn.onclick = getMoreReviews;
submitbtn.onclick = submitReview;