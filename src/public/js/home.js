var currentDate = new Date();
var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var dayOfWeek = daysOfWeek[currentDate.getDay()];
var dayOfMonth = currentDate.getDate();
var month = months[currentDate.getMonth()];
var year = currentDate.getFullYear();

var formattedDate = dayOfWeek + ', ' + dayOfMonth + ' ' + month + ' ' + year;

document.getElementById("currentdate").innerHTML = formattedDate;