<?php
use config\AppConfig;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <img class="blur-bg" src="<?=$book_data['image_path'];?>" alt="background with the blurred book cover">
        <header class="gen-header cluster-h book-header">
            <img class="book-cover-image" src="<?=$book_data['image_path'];?>" alt="picture of the book cover">
            <div class="book-cluster">
                <p><?=$book_data['genre'];?></p>
                <h1><?=$book_data['title'];?></h1>
                <h2><?=$author_data['name'];?></h2>
                <div>
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
        </div>
        <div class="pusher" style="flex:2"></div>
        <div class="author-info">
            <p class="blurb">About the author</p>
            <a class="btn btn-grey authorname-wrap" onclick="location.href='/userbooks?aid=<?=$author_data['author_id']?>'">
                <div class="image-container">
                    <img src="/storage/assets/profile.svg" alt="illustration of the author">
                </div>
                <div class="cluster-v" style="min-height:100%">
                    <div class="pusher"></div>
                        <p class="authorname"><?=$author_data['name'];?></p>
                    <div class="pusher"></div>
                </div>
            </a>
            <p class="authorbio"><?=$author_data['bio'];?></p>
        </div>
    </div>
    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    
    <script defer type="text/javascript" src="/public/js/bookdetail.js"></script>
</body>



</html> 