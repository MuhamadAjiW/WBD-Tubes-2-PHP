const deleteBook = (bookID) => {
    console.log("delete-book kepanggil");

    const data = new FormData();
    data.append("book_id", bookID);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/books');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            alert("Delete book success :)");
            window.location.reload();
        } else {
            alert("Delete book failed :(");
        }
    };

    xhr.send(data);
}