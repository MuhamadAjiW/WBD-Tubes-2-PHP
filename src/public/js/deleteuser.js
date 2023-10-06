const deleteUser = (id) => {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", '/admin/users', true);

    const data = new FormData();
    data.append("user_id", id)

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            alert("Delete user success :)");
            window.location.reload();
        } else {
            alert("Delete user failed :(");
        }
    };

    console.log("Ini idnya ", id);

    xhr.send(data);
}