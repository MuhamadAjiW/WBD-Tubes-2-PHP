const modal = document.getElementById("editprofilemodal");
const editbtn = document.getElementById("edit-button");
const submitbtn = document.getElementById("submit-edit-profile");
const cancelbtn = document.getElementById("cancel-edit-profile");
const email = document.getElementById("emailprofile");
const username = document.getElementById("usernameprofile");
const name = document.getElementById("nameprofile");
const bio = document.getElementById("bioprofile");

const modal2 = document.getElementById("logoutmodal");
const editbtn2 = document.getElementById("logout-button");
const submitbtn2 = document.getElementById("submit-edit-logout");
const cancelbtn2 = document.getElementById("cancel-edit-logout");

editbtn.onclick = function () {
  modal.style.display = "flex";
};
editbtn2.onclick = function () {
  modal2.style.display = "flex";
};
cancelbtn.onclick = function () {
  modal.style.display = "none";
};
cancelbtn2.onclick = function () {
  modal2.style.display = "none";
};

submitbtn2.onclick = function(){
  let xhr = new XMLHttpRequest();
    
  xhr.open("POST", "/logout");    
  xhr.send();
}