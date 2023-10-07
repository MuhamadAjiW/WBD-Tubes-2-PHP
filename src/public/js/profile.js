const confirmmodal = document.getElementById("confirmmodal");
const confirmmsg = document.getElementById("confirmation-msg");
const confirmbtn = document.getElementById("confirm-btn");
const editbtn = document.getElementById("edit-button");
const logoutbtn = document.getElementById("logout-button");
const emailin = document.getElementById("email-input");
const usernamein = document.getElementById("username-input");
const namein = document.getElementById("name-input");
const bioin = document.getElementById("bio-input");

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
  xhr.send();
  
  location.href='/login';
}

function edit(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/profile", true);    
  
  const data = new FormData();
  data.append("email", emailin.value);
  data.append("username", usernamein.value);
  data.append("name", namein.value);
  data.append("bio", bioin.value);
  xhr.onreadystatechange = function (){
      if(this.readyState == 4){
          if(this.status == 200){
              alert("Profile edition successful");
              location.reload();
          }
          else{
              alert("Profile edition failed: " + this.statusText);
          }
      }
  }
  xhr.send(data);
}