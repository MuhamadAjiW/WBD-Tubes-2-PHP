const submitEditReviewForm = () => {
    console.log("edit-review-kepanggil");

    const user_id = document.getElementById("form-edit-review").getAttribute("data-review-user-id");
    const book_id = document.getElementById("form-edit-review").getAttribute("data-review-book-id");
    const username = document.getElementById("edit-review-input-username").value;
    const title = document.getElementById("edit-review-input-title").value;
    const rating = document.getElementById("edit-review-input-rating").value;
    const reviewtext = document.getElementById("edit-review-input-reviewtext").value;

    const data = new FormData();
    data.append('user_id', user_id);
    data.append('book_id', book_id);
    data.append('username', username);
    data.append('title', title);
    data.append('rating', rating);
    data.append('reviewtext', reviewtext);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/editreview');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert("Edit review success :)");
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        } else if (this.status === 409) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else {
            alert("Edit review failed :(");
        }
    };

    xhr.send(data);
}