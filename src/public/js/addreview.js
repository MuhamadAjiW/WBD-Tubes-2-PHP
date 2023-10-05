const submitAddReviewForm = () => {

    const username = document.getElementById("add-review-input-username").value;
    const title = document.getElementById("add-review-input-title").value;
    const rating = document.getElementById("add-review-input-rating").value;
    const reviewtext = document.getElementById("add-review-input-reviewtext").value;

    const data = new FormData();
    data.append('username', username);
    data.append('title', title);
    data.append('rating', rating);
    data.append('reviewtext', reviewtext);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/addreview', true);
    
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert("Add review successful :)");
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        } else if (this.status === 409) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else {
            alert("Add review failed :(");
        }
    };


    xhr.send(data);
}