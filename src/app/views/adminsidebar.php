<div class="sidebar">
    <div class="sidebar-header">
        <img src="../../public/images/logo.png" alt="User Profile" class="user-profile-img">
        <h5 style="margin-top:10px;">Hello, Admin</h5>
    </div>
    <div class="sidebar-body">
        <div class="section-sidebar" onclick="showBooks(); resetBackground();">
            <i class="fas fa-book" id="books-icon"></i><span class="sidebar-text">Books</span>
        </div>
        <div class="section-sidebar" onclick="showUsers(); resetBackground();">
            <i class="fas fa-user" id="user-icon"></i><span class="sidebar-text">Users</span>
        </div>
        <div class="section-sidebar" onclick="showReviews(); resetBackground();">
            <i class="fas fa-comment" id="comment-icon"></i><span class="sidebar-text">Reviews</span>
        </div>
        <div class="section-sidebar">
            <i class="fas fa-sign-out" id="sign-out-icon"></i><span class="sidebar-text">Sign Out</span>
        </div>
    </div>
</div>