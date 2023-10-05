const submitEditUserForm = () => {
    console.log("edit-user kepanggil");

    const user_id = document.getElementById("form-edit-user").getAttribute("data-user-id");
    const name = document.getElementById("edit-user-input-name").value;
    const username = document.getElementById("edit-user-input-username").value;
    const password = document.getElementById("edit-user-input-password").value;
    const email = document.getElementById("edit-user-input-email").value;
    const bio = document.getElementById("edit-user-input-bio").value;
    const admin = document.getElementById("edit-user-input-admin").checked;


    if (name === "" || username === "" || email === "" || bio === "") {
        alert("Please fill all the required fields");
        return;
    }

    const data = new FormData();
    data.append("user_id", user_id);
    data.append("name", name);
    data.append("username", username);
    data.append("email", email);
    data.append("bio", bio);
    data.append("admin", admin);

    if (password !== "") {
        data.append("password", password);
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/edituser');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };

    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert("Edit user success :)");
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        } else if (this.status === 409) {
            alert("Username already taken :(");
        } else {
            alert("Edit user failed :(");
        }
    };

    xhr.send(data);
}