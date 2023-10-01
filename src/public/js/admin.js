function showBooks() {
    console.log("showBooks function called");
    $.ajax({
        url:"../../app/views/adminbooks.php",
        method:"post",
        data:{record:1},
        success:function(data) {
            console.log("AJAX request successful");
            $('.main-content').html(data);
        }
    });
}

function showUsers() {
    console.log("showUsersfunction called");
    $.ajax({
        url:"../../app/views/adminusers.php",
        method:"post",
        data:{record:1},
        success:function(data) {
            console.log("AJAX request successful");
            $('.main-content').html(data);
        }
    });
}