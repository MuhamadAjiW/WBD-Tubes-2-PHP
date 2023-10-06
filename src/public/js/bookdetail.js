const reviewmodal = document.getElementById("reviewmodal");
const confirmmodal = document.getElementById("confirmmodal");
const reviewbtn = document.getElementById("review-button");
const closebtn = document.getElementById("close-review");
const closecnfrm = document.getElementById("close-confirm");
const submitbtn = document.getElementById("submit-review");
const morereviewbtn = document.getElementById("load-more");

const bid_data = document.getElementById("bid-data");
const uid_data = document.getElementById("uid-data");
const edit_data = document.getElementById("edit-data");
const review_input = document.getElementById("form-review");
const rating_input = document.getElementById("ratingval");
const confirm_btn = document.getElementById("confirm-btn");
const cancel_btn = document.getElementById("cancel-btn");

let reviewOffset = 2;

reviewbtn.onclick = function() {
    reviewmodal.style.display = "flex";
}
closebtn.onclick = function() {
    reviewmodal.style.display = "none";
}

closecnfrm.onclick = function() {
    confirmmodal.style.display = "none";
}
cancel_btn.onclick = function() {
    confirmmodal.style.display = "none";
}

function getMoreReviews() {
  let xhr = new XMLHttpRequest();

  const queryString = window.location.search;
  const reviewparams = new URLSearchParams(queryString);
  reviewparams.set("offset", reviewOffset);

  xhr.open("GET", "/api/bookdetail/getMore?" + reviewparams, true);    
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


// +TODO: make input validation response better
function validateEntry(review_input, rating_input){
    if (review_input.value.length > 2048) {
        alert("Review must be shorter than 2048 characters");
        return false;
    }
    const rating = parseInt(rating_input.value);
    if (isNaN(rating) || rating < 1 || rating > 5) {
        alert("Rating must be a number between 1 and 5");
        return false;
    }
    return true;
}

function submitReview(){
    if(validateEntry(review_input, rating_input)){
        let xhr = new XMLHttpRequest();
        if(edit_data.value == true){
            xhr.open("POST", "/api/review/edit", true);
        }
        else{
            xhr.open("PUT", "/api/review/add", true);    
        }
        
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        const data = new URLSearchParams();
        data.append("uid", uid_data.value);
        data.append("bid", bid_data.value);
        data.append("review", review_input.value);
        data.append("rating", rating_input.value);
        
        xhr.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        }
        xhr.send(data);
    }
}

morereviewbtn.onclick = getMoreReviews;


if(edit_data.value == true){
    const delete_btn = document.getElementById("delete-review");

    function deleteReview(){
        let xhr = new XMLHttpRequest();
        xhr.open("DELETE", "/api/review/delete", true);    
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        const data = new URLSearchParams();
        data.append("uid", uid_data.value);
        data.append("bid", bid_data.value);
        
        xhr.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        }
        xhr.send(data);
    }
    
    
    submitbtn.onclick = function(){
        confirmmodal.style.display = "flex";
        confirm_btn.onclick = submitReview; 
    }
    delete_btn.onclick = function(){
        confirmmodal.style.display = "flex";
        confirm_btn.onclick = deleteReview; 
    }
}
else{
    submitbtn.onclick = submitReview;
}
