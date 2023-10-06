const deleteReview = (user_id, book_id) => {
    console.log("delete-review kepanggil");

    const data = new FormData();

    data.append("user_id", user_id);
    data.append("book_id", book_id);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/reviews');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            alert("Delete review success :)");
            window.location.reload();
        } else {
            alert("Delete review failed :(");
        }
    };

    console.log("Book id " + book_id + ", User id " + user_id);

    xhr.send(data);
}