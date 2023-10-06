const submitEditBookForm = () => {
    console.log("edit-book kepanggil");

    const title = document.getElementById("edit-book-input-title").value;
    const author_username = document.getElementById("edit-book-input-author").value;
    const genre = document.getElementById("edit-book-input-genre").value;
    const release_date = document.getElementById("edit-book-input-date").value;
    const word_count = document.getElementById("edit-book-input-wordcount").value;
    const duration = document.getElementById("edit-book-input-duration").value;
    const synopsis = document.getElementById("edit-book-input-synopsis").value;
    const graphic_cntn = document.getElementById("edit-book-input-graphic").checked;

    const image_input = document.getElementById("edit-book-input-image");
    const audio_input = document.getElementById("edit-book-input-audio");

    const data = new FormData();
    data.append('title', title);
    data.append('author_username', author_username);
    data.append('genre', genre);
    data.append('release_date', release_date);
    data.append('word_count', word_count);
    data.append('duration', duration);
    data.append('synopsis', synopsis);
    data.append('graphic_cntn', graphic_cntn);

    if (image_input.files.length > 0) {
        data.append('image_input', image_input.files[0]);
    }

    if (audio_input.files.length > 0) {
        data.append('audio_input', audio_input.files[0]);
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/editbook');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.redirect) {
                window.location.href = response.redirect;
            }
            alert("Edit book success :)");
        } else if (this.status === 409) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else if (this.status === 500) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else {
            alert("Edit book failed :(");
        }
    };

    xhr.send(data);
}