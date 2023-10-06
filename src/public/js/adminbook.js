const booklist = document.getElementById('book-entries');
const pagination = document.getElementById('page-buttons');

function changePage(page){
    const bookQueryString = window.location.search;
    const bookParams = new URLSearchParams(bookQueryString);
    bookParams.set('page', page);
    
    let xhr = new XMLHttpRequest();
    window.history.replaceState({}, "", "/admin/books?" + bookParams.toString());

    xhr.open("GET", "/api/admin/booklist?" + bookParams.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            const data = xhr.response.split("<SPLIT></SPLIT>");
            booklist.innerHTML = data[0];
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
function deleteBook(book_id){
    const data = new URLSearchParams();
    data.append("bid", book_id);

    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", '/api/book/delete');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status === 200) {
                alert("Book deletion success");
                location.reload();
            } else {
                alert("Book deletion failed: " + this.statusText);
            }
        }
    };

    xhr.send(data);
}

function deleteBookPrompt(book_id){
    deletemodal.style.display = "flex"
    confmessage.style.display = "flex";
    confmessage.innerText = "Do you want to delete this book?";

    confirmbtn.onclick = function() {
        deleteBook(book_id);
        deletemodal.style.display = "none";
    }
}

// --------EDIT--------
const bookmodal = document.getElementById("bookmodal");
const bookidin = document.getElementById("book-id-input");
const titlein = document.getElementById("title-input");
const authorin = document.getElementById("username-input");
const genrein = document.getElementById("genre-input");
const releasein = document.getElementById("release-input");
const wordin = document.getElementById("word-count-input");
const durationin = document.getElementById("duration-input");
const synopsisin = document.getElementById("synopsis-input");
const imagein = document.getElementById("add-book-form-image");
const audioin = document.getElementById("add-book-form-audio");
const gcin = document.getElementById("gc-input");
const submitbtn = document.getElementById("submit-book");
function editBookPrompt(book_id){
    
    const data = new URLSearchParams();
    data.set("bid", book_id);
    
    const xhr = new XMLHttpRequest();
    xhr.open("GET", '/api/book/get?' + data.toString());
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const responseData = JSON.parse(xhr.responseText);
            if(responseData){
                bookmodal.style.display = 'flex';
                bookidin.value = responseData['book_id'];
                titlein.value = responseData['title'];
                synopsisin.value = responseData['synopsis'];
                authorin.value = responseData['username'];
                genrein.value = responseData['genre'];
                releasein.value = responseData['release_date'];
                wordin.value = responseData['word_count'];
                durationin.value = responseData['duration'];
                gcin.checked = responseData['graphic_cntn'];

                submitbtn.onclick = editBook;
            }
        }
    };
    xhr.send(data);
}

function editBook(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/book/edit", true);    
    
    const data = new FormData();
    data.append("bid", bookidin.value);
    data.append("title", titlein.value);
    data.append("synopsis", synopsisin.value);
    data.append("username", authorin.value);
    data.append("genre", genrein.value);
    data.append("release_date", releasein.value);
    data.append("word_count", wordin.value);
    data.append("duration", durationin.value);
    data.append('image_file', imagein.files[0])
    data.append('audio_file', audioin.files[0])
    data.append("graphic_cntn", gcin.checked);
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("Book edition successful");
                location.reload();
            }
            else{
                alert("Book edition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}

// --------ADD--------
function addBookPrompt(){
    bookmodal.style.display = 'flex';
    bookidin.value = null
    titlein.value = null
    authorin.value = null
    genrein.value = null
    releasein.value = null
    wordin.value = null
    durationin.value = null
    synopsisin.value = null
    gcin.checked = null

    submitbtn.onclick = addBook;
}

function addBook(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/book/add", true);    
    
    const data = new FormData();
    data.append("bid", bookidin.value);
    data.append("title",titlein.value);
    data.append("synopsis", synopsisin.value);
    data.append("username", authorin.value);
    data.append("genre", genrein.value);
    data.append("release_date", releasein.value);
    data.append("word_count", wordin.value);
    data.append("duration", durationin.value);
    data.append('image_file', imagein.files[0])
    data.append('audio_file', audioin.files[0])
    data.append("graphic_cntn", gcin.checked);
    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("Book addition successful");
                location.reload();
            }
            else{
                alert("Book addition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}