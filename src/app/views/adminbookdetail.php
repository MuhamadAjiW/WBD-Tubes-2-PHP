<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bookdetail.css" />
</head>
<body>
    <div class="top-wrapper">
    <img class="blur-bg" src="/images/book_cover.jpeg">
        <div class="book-info">
            <div class="book-cover">
                <img class="book-cover-image" src="/images/book_cover.jpeg">
            </div>
            <div class ="book-contents">
                <div class="book-contents-header">
                    <h1 class="book-genre">Romance</h1>
                    <div class="admin-buttons">
                        <button id="edit-button" class="book-buttons" type="button">Edit</button>
                        <button id="delete-button" class="book-buttons" type="button">Delete</button>
                    </div>
                </div>
                <h1 class='book-title'>The Most Important Thing In The World</h1>
                <h2 class='book-author'>By Kelly Sanford</h2>
                <div class="book-buttons">
                    <button id="recommend-button" class="book-buttons" type="button">Recommend</button>
                    <button id="audio-button" class="book-buttons" type='button'>Hear it now</button>
                    <button id="save-button" class="book-buttons" type='button'>Save to library</button>
                </div>
            </div>
        </div>
    </div>
    <div class="body-wrapper">
        <div class="book-review">
            <div class="book-synopsis">
                <div class="text-title">Synopsis</div>
                <div class="plain-text" id="synopsis-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                    \n
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                    \n
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                </div>
            </div>
            <h1 class="text-title">Reviews</h1>
            <div class="review-section">
                <div class="review-box">
                    <div class="user-profile" id="reviewer-profile">
                        Testimoni Review
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="user-profile" id="reviewer-profile">
                        Testimoni Review
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="user-profile" id="reviewer-profile">
                        Testimoni Review
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="user-profile" id="reviewer-profile">
                        Testimoni Review
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>

                <button id="load-more">Load More</button>
            </div>
        </div>
        <div class="author-content">
            <h1 class="text-for-sidebar">ABOUT THE AUTHOR</h1>
            <div class="user-profile">
                Varsha Chitnis
            </div>
            <div class="author-bio">
                Born in Mumbai, Varsha Chitnis grew up in the beautiful city of Baroda in western India and currently calls California her home. 
                Through her two Ph.D.s and a fulfilling teaching career,
                 she has remained a storyteller at heart. She writes about South Asian characters and their multifaceted lives.e</div>
            <div class="publish-info">
                <p class="publish-info">Published on bla bla bla</p>
                <p class="publish-info">Published by</p>
                <p class="publish-info">Word count</p>
                <p class="publish-info">Contains graphic content or not</p>
            </div>
            <h1 class="text-for-sidebar">REVIEWED BY</h1>
            <div class="user-profile">
                Reviewer Name
            </div>
            <h1 class="text-for-sidebar">Enjoyed this review?</h1>
            <div class="write-review">
                <h1 id="review-head">Review this book</h1>
                <span id="write-review-text">Share your thoughts with other readers now by</span>
                <button id="review-button">Write a review</button>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let text=document.querySelectorAll('.plain-text');
                for (let e of text) {
                    e.innerHTML = e.innerHTML.replace(/\\n/g, '<br></br>')
                }
            })
        </script>
</body>
</html>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span id="close-modal" class="close">&times;</span>
            <h5 class="modal-title">Submit Review</h5>
        </div>
        <div class="modal-body">
            <input type="text" name="reviewer_name" class="long-form" placeholder="Enter Your Name"/>
            <textarea type="text" name="reviewer_text" class="long-form" id="form-review" placeholder="Enter Your Review"></textarea>
            <button type="button" class="circular-btn">Submit</button>
        </div>
    </div>
</div>

<div class="delete-modal">
    <div class="delete-modal-content">
        <div class="delete-container">
            <h1 class = "delete-modal-title">Delete Book</h1>
            <p class = "delete-modal-text">Are you sure you want to delete this book?</p>

            <div class="delete-modal-buttons">
                <button type="button" class="delete-modal-btn" id="cancel-delete-btn">Cancel</button>
                <button type="button" class="delete-modal-btn" id="delete-book-btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script> // Modal for book deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    var openmodalbtn = document.getElementById("delete-button");

    // Get the delete button
    var deletebtn = document.getElementById("delete-book-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");
    
    openmodalbtn.onclick = function() {
        deletemodal.style.display = "block";
    }

    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deletemodal.style.display = "none";
    }

</script>

<script> // Popup Form Modal Script
    // Get modal
    var modal = document.getElementsByClassName("modal")[0];
    
    // Get open modal button
    var openbtn = document.getElementById("review-button");

    // Get close button
    var closebtn = document.getElementsByClassName("close")[0];

    // Get submit button
    var submitbtn = document.getElementsByClassName("circular-btn")[0];
    
    openbtn.onclick = function() {
        modal.style.display = "block";
    }

    closebtn.onclick = function() {
        modal.style.display = "none";
    }

    submitbtn.onclick = function() {
        modal.style.display = "none";
    }
    
</script>