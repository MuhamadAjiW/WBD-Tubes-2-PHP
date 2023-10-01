<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/bookdetail.css" />
</head>
<body>
    <div class="top-wrapper">
    <img class="blur-bg" src="../../storage/images/book_cover.jpeg">
        <div class="book-info">
            <div class="book-cover">
                <img class="book-cover-image" src="../../storage/images/book_cover.jpeg">
            </div>
            <div class ="book-contents">
                <h1 class='book-genre'>Romance</h1>
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