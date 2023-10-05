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
