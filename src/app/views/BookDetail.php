<?php use config\AppConfig; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <img class="blur-bg" src="<?=$book_data['image_path'];?>">
        <header class="gen-header cluster-h book-header">
            <img class="book-cover-image" src="<?=$book_data['image_path'];?>">
            <div class="book-cluster">
                <p><?=$book_data['genre'];?></p>
                <h1><?=$book_data['title'];?></h1>
                <h2><?=$author_data['name'];?></h2>
                <div>
                    <button id="review-button" class="btn btn-yellow" type="button"></i>Write a review</button>
                    <!-- +TODO: Implement -->
                    <button id="save-button" class="btn btn-grey" type='button' onclick="location.href='/error/501'"></i>Save to library</button>
                
                </div>
                <audio class="audioplayer" controls> 
                    <source src="<?=$book_data['audio_path'];?>" type="audio/mpeg"> 
                </audio> 
            </div>
        </header>
    </div>
    <div class="main-content main-detail">
        <div class="synopsis-reviews">
            <section class="synopsis">
                <h2>Synopsis</h2>
                <p class="synopsis-text"><?=$book_data['synopsis'];?></p>
            </section>
            <section class="reviews" id="review-block">
                <h2>Reviews</h2>
                <?php
                foreach ($review_data as $review) {
                    extract($review);
                    include "../app/components/ReviewEntry.php";
                }
                ?>
            </section>
            <?php
            if($review_count > AppConfig::REVIEWS_PER_LOAD){
                echo '<button class="btn btn-grey" id="load-more" style="margin:15px 0">Load more</button>';
            }
            ?>
        </div>
        <div class="pusher" style="flex:2"></div>
        <div class="author-info">
            <p class="blurb">About the author</p>
            <div class="authorname-wrap">
                <div class="image-container">
                    <img src="/storage/assets/profile.svg" alt="illustration of the author">
                </div>
                <div class="cluster-v" style="min-height:100%">
                    <div class="pusher"></div>
                        <p class="authorname"><?=$author_data['name'];?></p>
                    <div class="pusher"></div>
                </div>
            </div>
            <p class="authorbio"><?=$author_data['bio'];?></p>
        </div>
    </div>
    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
</body>

<!-- TODO: Check if user has reviewed the book -->
<div id="reviewmodal" class="fullscreen centered modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Submit Review</h5>
            <span id="close-review" class="close-review">&times;</span>
        </div>
        <form class="modal-body" method="POST">
            <textarea type="text" class="reviewer-form" id="form-review" placeholder="Enter Your Review"></textarea>
            <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                <label for="ratingval">Score:</label>
                <input id="ratingval" name="ratingval" type="number"  class="form-input" placeholder="1-5" min="1" max="5">
                <div class="pusher"></div>
                <button id="submit-review" type="button" class="btn btn-yellow submit-review-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="/public/js/bookdetail.js"></script>

    <!-- <div class="body-wrapper">
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
                    <div class="first-section">
                        <div class="user-profile" id="reviewer-profile">
                            Testimoni Review
                        </div>
                        <span class="rating-score">Score: 4.3/5</span>
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="first-section">
                        <div class="user-profile" id="reviewer-profile">
                            Testimoni Review
                        </div>
                        <span class="rating-score">Score: 4.3/5</span>
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="first-section">
                        <div class="user-profile" id="reviewer-profile">
                            Testimoni Review
                        </div>
                        <span class="rating-score">Score: 4.3/5</span>
                    </div>
                    <div class="one-line-review">
                        Buku ini emang sangat bagus dan rekomended banget buat dibaca
                    </div>
                    <div class="review-date">
                        Reviewed On Monday, 24 May 2021 02:10:08 PM
                    </div>
                </div>
                <div class="review-box">
                    <div class="first-section">
                        <div class="user-profile" id="reviewer-profile">
                            Testimoni Review
                        </div>
                        <span class="rating-score">Score: 4.3/5</span>
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
<?php if(file_exists($FOOTER)) include_once($FOOTER);?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let text=document.querySelectorAll('.plain-text');
    for (let e of text) {
        e.innerHTML = e.innerHTML.replace(/\\n/g, '<br></br>')
    }
})
</script>

</html>

<script>
    // Get modal
    var modal = document.getElementsByClassName("modal")[0];
    
    // Get open modal button
    var openbtn = document.getElementById("review-button");

    // Get close button
    var closebtn = document.getElementsByClassName("close")[0];

    // Get submit button
    var submitbtn = document.getElementsByClassName("submit-review-btn")[0];
    
    openbtn.onclick = function() {
        modal.style.display = "block";
    }

    closebtn.onclick = function() {
        modal.style.display = "none";
    }

    submitbtn.onclick = function() {
        modal.style.display = "none";
    }
    
</script> -->
