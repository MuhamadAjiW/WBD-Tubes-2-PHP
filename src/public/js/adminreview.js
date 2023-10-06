const reviewlist = document.getElementById('review-entries');
const pagination = document.getElementById('page-buttons');
function changePage(page){
    const reviewQueryString = window.location.search;
    const reviewParams = new URLSearchParams(reviewQueryString);
    reviewParams.set('page', page);
    
    let xhr = new XMLHttpRequest();
    window.history.replaceState({}, "", "/admin/reviews?" + reviewParams.toString());

    xhr.open("GET", "/api/admin/reviewlist?" + reviewParams.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            const data = xhr.response.split("<SPLIT></SPLIT>");
            reviewlist.innerHTML = data[0];
            pagination.innerHTML = data[1];
        }
    }
    xhr.send();
}

// TODO: make response dynamic
// --------DELETE--------
const deletemodal = document.getElementById("confirmmodal");
const confirmbtn = document.getElementById("confirm-btn");
const confmessage = document.getElementById("confirmation-msg");
function deleteReview(user_id, book_id){
    const data = new URLSearchParams();
    data.append("uid", user_id);
    data.append("bid", book_id);

    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", '/api/review/delete');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status === 200) {
                alert("Review deletion success");
                location.reload();
            } else {
                alert("Review deletion failed: " + this.statusText);
            }
        }
    };

    xhr.send(data);
}

function deleteReviewPrompt(user_id, book_id){
    deletemodal.style.display = "flex"
    confmessage.style.display = "flex";
    confmessage.innerText = "Do you want to delete this review?";

    confirmbtn.onclick = function() {
        deleteReview(user_id, book_id);
        deletemodal.style.display = "none";
    }
}

// --------EDIT--------
const reviewmodal = document.getElementById("reviewmodal");
const useridin = document.getElementById("userid-input");
const bookidin = document.getElementById("bookid-input");
const formreview = document.getElementById("form-review");
const ratingval = document.getElementById("ratingval");
const submitbtn = document.getElementById("submit-review");
function editReviewPrompt(userId, bookId){
    
    const data = new URLSearchParams();
    data.set("uid", userId);
    data.set("bid", bookId);
    
    const xhr = new XMLHttpRequest();
    xhr.open("GET", '/api/review/get?' + data.toString());
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const responseData = JSON.parse(xhr.responseText);
            if(responseData){
                reviewmodal.style.display = 'flex';
                useridin.value = responseData['user_id'];
                bookidin.value = responseData['book_id'];
                formreview.value = responseData['reviewtext'];
                ratingval.value = responseData['rating'];

                submitbtn.onclick = editReview;
            }
        }
    };
    xhr.send(data);
}

function editReview(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/review/edit", true);    
    
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = new URLSearchParams();
    data.append("uid", useridin.value);
    data.append("bid", bookidin.value);
    data.append("review", formreview.value);
    data.append("rating", ratingval.value);
    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("Review edition successful");
                location.reload();
            }
            else{
                alert("Review edition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}

// --------ADD--------
function addReviewPrompt(){
    reviewmodal.style.display = 'flex';
    useridin.value = null;
    bookidin.value = null;
    formreview.value =null;
    ratingval.value = null;

    submitbtn.onclick = addReview;
}

function addReview(){
    let xhr = new XMLHttpRequest();
    xhr.open("PUT", "/api/review/add", true);    
    
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = new URLSearchParams();
    data.append("uid", useridin.value);
    data.append("bid", bookidin.value);
    data.append("review", formreview.value);
    data.append("rating", ratingval.value);
    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("Review addition successful");
                location.reload();
            }
            else{
                alert("Review addition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}