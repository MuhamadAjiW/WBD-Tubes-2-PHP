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
  <div class="book-grid">
    <?php
    if (is_array($data)) {
      foreach ($data as $key => $value) {
          if (is_array($value) && isset($value['username'])) {
              echo '<div class="author-info">';
              echo '<img src="https://tse4.mm.bing.net/th?id=OIP._arhxJRyb58rGEtxa_v_1QHaHa&pid=Api&P=0&h=180" alt="Author Image">';
              echo '<h3>' . $value["username"] . '</h3>';
              
              if(!isset($value['status'])){
                echo '<form method="POST" action="/subscribe">';
                echo '<input type="hidden" name="author_id" value="' . $value["author_id"] . '">';
                echo '<button class="btn btn-yellow" type="submit" name="subscribe_button">Subscribe</button>';
                echo '</form>';
              } else{
                switch ($value['status']) {
                  case 'PENDING':
                    echo 'Request pending';
                    break;
                  case 'ACCEPTED':
                    echo 'Request accepted';
                    //TODO: add button to go to booklist
                    break;
                  case 'REJECTED':
                    echo 'Request rejected';
                    //TODO: Do what?
                    break;
                  
                  default:
                    echo '<form method="POST" action="/subscribe">';
                    echo '<input type="hidden" name="author_id" value="' . $value["author_id"] . '">';
                    echo '<button class="btn btn-yellow" type="submit" name="subscribe_button">Subscribe</button>';
                    echo '</form>';
                    break;
                }
              }
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
