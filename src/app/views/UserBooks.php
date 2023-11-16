<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookUser</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="/storage/assets/logo.svg" alt="Stylized Background">
<body class="gen-body">
  <div class="main-content first">
    <div class="gen-header">
      <h1>User Premium</h1>
    </div>
    <section id="author-info" class="main-content">
      <div class="author-info-userbooks">
        <img src="/storage/assets/profile.svg" alt="Author Image" style="width: 200px;margin-top: 25px">
        <h2><?=$authorData['name']?></h2>
      </div>
    </section>
    <section class="bio" style="border-bottom: 1px solid #e9e9e9">
      <h3>Biografi</h3>
      <p><?=$authorData['bio']?></p>
    </section>
    <section id="content-booklist">
    <?php
      if (is_array($bookData)) {
        if(empty($bookData)){
          echo "<p>Penulis ini belum membuat buku apa - apa</p>";
        } else{       
          echo '<div class="book-grid">';
          foreach ($bookData as $key => $value) {
              echo '<a class="book-grid-mem" name="clickable gridmember with image and brief description" onclick="location.href=\'/detailprem?bid=' . $value['bookp_id'] . '\'">';
              echo '<img class="book-image" src="' . $value['image_path'] . '" alt="image of the book cover">';
              echo '<p class="book-grid-mem-t">' . $value['title'] . '</p>';
              echo '<p class="book-grid-mem-auth">' . $value['genre'] . '</p>';
              echo '<p class="book-grid-mem-auth">' . $value['release_date'] . '</p>';
              if($value['graphic_cntn']) echo '<p class="book-grid-mem-auth">Graphic Content</p>';
              echo '</a>';
          }
        }
        echo "</div>";
      } else {
          echo 'Data tidak valid atau kosong.';
      }
        ?>
    </section>
</body>
</html>