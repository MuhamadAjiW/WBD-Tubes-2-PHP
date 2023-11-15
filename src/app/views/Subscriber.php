<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Premium</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="/storage/assets/logo.svg" alt="Stylized Background">
<div class="main-content first">
  <div class="gen-header cluster-h">
    <h2>Daftar Author Yang Bisa Di Subscribe</h2>
  </div>
  <div class="subscribe-section">
    <?php
    if (is_array($data)) {
      foreach ($data as $key => $value) {
          if (is_array($value) && isset($value['username'])) {
              echo '<div class="author-info">';
              echo '<img src="https://tse4.mm.bing.net/th?id=OIP._arhxJRyb58rGEtxa_v_1QHaHa&pid=Api&P=0&h=180" alt="Author Image">';
              echo '<h3>' . $value["username"] . '</h3>';
              echo '<form method="POST" action="/subscribe">';
              echo '<input type="hidden" name="user_number" value="' . $value["username"] . '">';
              echo '<button class="btn btn-yellow" type="submit" name="subscribe_button">Subscribe</button>';
              echo '</form>';
              echo '</div>';
          }
      }
  } else {
      echo 'Data tidak valid atau kosong.';
  }
    ?>
  </div>
</div>
</html>
