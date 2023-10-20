const confirmmodal = document.getElementById("confirmmodal");
const confirmmsg = document.getElementById("confirmation-msg");
const confirmbtn = document.getElementById("confirm-btn");
const editbtn = document.getElementById("edit-button");
const logoutbtn = document.getElementById("logout-button");
const emailin = document.getElementById("email-input");
const usernamein = document.getElementById("username-input");
const namein = document.getElementById("name-input");
const bioin = document.getElementById("bio-input");

const initusername = usernamein.value;

editbtn.onclick = function () {
  confirmmodal.style.display = "flex";
  confirmmsg.style.display = "flex"
  confirmmsg.textContent = "Do you want to change your profile?"
  
  confirmbtn.onclick = edit;
}

logoutbtn.onclick = function () {
  confirmmodal.style.display = "flex";
  confirmmsg.style.display = "flex"
  confirmmsg.textContent = "Do you want to log out"

  confirmbtn.onclick = logout;
}


function logout(){
  let xhr = new XMLHttpRequest();
  
  xhr.open("POST", "/logout");    
  xhr.onreadystatechange = function (){
    if(this.readyState == 4 && this.status == 200){
        location.href='/login';
    }
  }
  xhr.send();
  
}

function edit(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/profile", true);    
  
  const data = new FormData();

  let email = emailin.value;
  let username = usernamein.value;
  let name = namein.value;
  let bio = bioin.value;
  
  if (
      email === null || typeof email !== "string" || email.trim() === "" ||
      !/^\S+@\S+\.\S+$/.test(email)
  ) {
      alert("Email must be a valid non-empty string in the format 'user@example.com'.");
  } else{
      if (email.length > 256){
          alert("Email must not be longer than 256 characters.");
      }
  } 
  
  if (username === null || typeof username !== "string" || username.trim() === "") {
      alert("Username must be a valid non-empty string.");
  } else{
      if (username.length > 256){
          alert("Username must not be longer than 256 characters.");
      }
  }
  
  if (name === null || typeof name !== "string" || name.trim() === "") {
      alert("Name must be a valid non-empty string.");
  } else{
      if (name.length > 256){
          alert("Name must not be longer than 256 characters.");
      }
  } 
  
  if (bio === null || typeof bio !== "string" || bio.trim() === "") {
      bio = "This user does not have a bio";
  } else{
      if (bio.length > 2048){
          alert("Bio must not be longer than 2048 characters.");
      }
  }    

  data.append("email", email);
  data.append("username", username);
  data.append("name", name);
  data.append("bio", bio);

  if(username != initusername){
    data.append("changeUname", true);
  }
  else{
    data.append("changeUname", false);
  }

  xhr.onreadystatechange = function (){
      if(this.readyState == 4){
          if(this.status == 200){
              alert("Profile edition successful");
              location.reload();
          }
          else{
              alert("Profile edition failed: " + this.response);
          }
      }
  }
  xhr.send(data);
}