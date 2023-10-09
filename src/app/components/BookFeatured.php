<a class="book-container" style="background-color: transparent;border:none" name="clickable image of the featured book"
    onclick="location.href='\detail?bid=<?=$book_id?>'">
    <img class="book-image" src="<?=$image_path?>" alt="image of the featured book's book cover">
</a>
<div class="book-rec-desc">
    <p class="title-text"><?=$title?></p>
    <p class="subtitle-text">By <?=$name?></p>
    <p class="desc-text">
        <?=$synopsis?>
    </p>
</div>