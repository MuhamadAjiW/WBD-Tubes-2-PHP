const submitUserForm = () => {
    console.log("add-user kepanggil");
    const name = document.getElementById("add-user-input-name").value;
    const username = document.getElementById("add-user-input-username").value;
    const password = document.getElementById("add-user-input-password").value;
    const email = document.getElementById("add-user-input-email").value;
    const bio = document.getElementById("add-user-input-bio").value;
    const admin = document.getElementById("add-user-input-admin").checked;

    if (name === "" || username === "" || password === "" || email === "" || bio === "") {
        alert("Please fill all the required fields");
        return;
    }

    const data = new FormData();
    data.append("name", name);
    data.append("username", username);
    data.append("password", password);
    data.append("email", email);
    data.append("bio", bio);
    data.append("admin", admin);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/admin/adduser');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Gatau mau isi apa
        }
    };
    
    xhr.onload = function() {
        if (this.status === 200) {
            alert("Add user success :)");
        } else if (this.status === 409) {
            alert("Username already taken :(");
        } else {
            alert("Add user failed :(");
        }
    };

    xhr.send(data);
};

