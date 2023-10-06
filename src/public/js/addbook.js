const submitAddBookForm = () => {
    console.log("add-book kepanggil");

    const title = document.getElementById("add-book-form-title").value;
    const username = document.getElementById("add-book-form-username").value;
    const genre = document.getElementById("add-book-form-genre").value;
    const release_date = document.getElementById("add-book-form-date").value;
    const word_count = document.getElementById("add-book-form-wordcount").value;
    const duration = document.getElementById("add-book-form-duration").value;
    const synopsis = document.getElementById("add-book-form-synopsis").value;
    const graphic_cntn = document.getElementById("add-book-form-graphic").checked;

    const data = new FormData();
    data.append('title', title);
    data.append('synopsis', synopsis);
    data.append('username', username);
    data.append('genre', genre);
    data.append('release_date', release_date);
    data.append('duration', duration);
    data.append('word_count', word_count);
    data.append('graphic_cntn', graphic_cntn);
    data.append('image_file', document.getElementById("add-book-form-image").files[0]);
    data.append('audio_file', document.getElementById("add-book-form-audio").files[0]);

    for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/addbook');

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
            alert("Add book success :)");
        } else if (this.status === 409) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else if (this.status === 500) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else {
            alert("Add book failed :(");
        }
    };

    xhr.send(data);


}