const userlist = document.getElementById('user-entries');
const pagination = document.getElementById('page-buttons');

function changePage(page){
    const userQueryString = window.location.search;
    const userParams = new URLSearchParams(userQueryString);
    userParams.set('page', page);
    
    let xhr = new XMLHttpRequest();
    window.history.replaceState({}, "", "/admin/users?" + userParams.toString());

    xhr.open("GET", "/api/admin/userlist?" + userParams.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            const data = xhr.response.split("<SPLIT></SPLIT>");
            userlist.innerHTML = data[0];
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
function deleteUser(user_id){
    const data = new URLSearchParams();
    data.append("uid", user_id);

    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", '/api/user/delete');

    xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status === 200) {
                alert("User deletion success");
                location.reload();
            } else {
                alert("User deletion failed: " + this.statusText);
            }
        }
    };

    xhr.send(data);
}

function deleteUserPrompt(user_id){
    deletemodal.style.display = "flex"
    confmessage.style.display = "flex";
    confmessage.innerText = "Do you want to delete this user?";

    confirmbtn.onclick = function() {
        deleteUser(user_id);
        deletemodal.style.display = "none";
    }
}

// --------EDIT--------
const usermodal = document.getElementById("usermodal");
const useridin = document.getElementById("user-id-input");
const emailin = document.getElementById("email-input");
const usernamein = document.getElementById("username-input");
const passwordin = document.getElementById("password-input");
const namein = document.getElementById("name-input");
const bioin = document.getElementById("bio-input");
const adminin = document.getElementById("admin-input");
const submitbtn = document.getElementById("submit-user");
function editUserPrompt(user_id){
    
    const data = new URLSearchParams();
    data.set("uid", user_id);
    
    const xhr = new XMLHttpRequest();
    xhr.open("GET", '/api/user/get?' + data.toString());
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const responseData = JSON.parse(xhr.responseText);
            if(responseData){
                usermodal.style.display = 'flex';
                useridin.value = responseData['user_id'];
                emailin.value = responseData['email'];
                usernamein.value = responseData['username'];
                passwordin.value = null;
                namein.value = responseData['name'];
                bioin.value = responseData['bio'];
                adminin.checked = responseData['admin'];

                submitbtn.onclick = editUser;
            }
        }
    };
    xhr.send(data);
}

function editUser(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/user/edit", true);    
    
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = new URLSearchParams();
    data.append("uid", useridin.value);
    data.append("email", emailin.value);
    data.append("username", usernamein.value);
    data.append("password", passwordin.value);
    data.append("name", namein.value);
    data.append("bio", bioin.value);
    data.append("admin", adminin.checked);
    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("User edition successful");
                location.reload();
            }
            else{
                alert("User edition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}

// --------ADD--------
function addUserPrompt(){
    usermodal.style.display = 'flex';
    useridin.value = null;
    emailin.value = null;
    usernamein.value = null;
    passwordin.value = null;
    namein.value = null;
    bioin.value = null;
    adminin.checked = null;

    submitbtn.onclick = addUser;
}

function addUser(){
    let xhr = new XMLHttpRequest();
    xhr.open("PUT", "/api/user/add", true);    
    
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = new URLSearchParams();
    data.append("email", emailin.value);
    data.append("username", usernamein.value);
    data.append("password", passwordin.value);
    data.append("name", namein.value);
    data.append("bio", bioin.value);
    data.append("admin", adminin.checked);
    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4){
            if(this.status == 200){
                alert("User addition successful");
                location.reload();
            }
            else{
                alert("User addition failed: " + this.statusText);
            }
        }
    }
    xhr.send(data);
}