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
<div class="main-content first">
  <div class="gen-header cluster-h">
    <h2>Daftar Buku Yang Dibuat User</h2>
  </div>
  <div class="author">
    <div class="author-info-userbooks">
      <img src="https://tse4.mm.bing.net/th?id=OIP._arhxJRyb58rGEtxa_v_1QHaHa&pid=Api&P=0&h=180" alt="Author Image">
      <h3>Nama User</h3>
    </div>
  </div>
  <div class="userbooks-section">
    <div class="userbooks-item">
      <img src="https://tse4.mm.bing.net/th?id=OIP.IH2L5_sOrKWryeyEhn9CtQHaFx&pid=Api&P=0&h=180" alt="Author Image">
      <h3>Title 2</h3>
      <form method="POST" action="/">
        <input type="hidden" name="usebooks_btn" value="Title 2">
        <button class="btn btn-yellow userbooks" type="submit" name="subscribe_button">Detail</button>
      </form>
    </div>
    <div class="userbooks-item">
      <img src="https://tse4.mm.bing.net/th?id=OIP.IH2L5_sOrKWryeyEhn9CtQHaFx&pid=Api&P=0&h=180" alt="Author Image">
      <h3>Title 2</h3>
      <form method="POST" action="/">
        <input type="hidden" name="usebooks_btn" value="Title 2">
        <button class="btn btn-yellow userbooks" type="submit" name="subscribe_button">Detail</button>
      </form>
    </div>
    <div class="userbooks-item">
      <img src="https://tse4.mm.bing.net/th?id=OIP.IH2L5_sOrKWryeyEhn9CtQHaFx&pid=Api&P=0&h=180" alt="Author Image">
      <h3>Title 2</h3>
      <form method="POST" action="/">
        <input type="hidden" name="usebooks_btn" value="Title 2">
        <button class="btn btn-yellow userbooks" type="submit" name="subscribe_button">Detail</button>
      </form>
    </div>
    <div class="userbooks-item">
      <img src="https://tse4.mm.bing.net/th?id=OIP.IH2L5_sOrKWryeyEhn9CtQHaFx&pid=Api&P=0&h=180" alt="Author Image">
      <h3>Title 2</h3>
      <form method="POST" action="/">
        <input type="hidden" name="usebooks_btn" value="Title 2">
        <button class="btn btn-yellow userbooks" type="submit" name="subscribe_button">Detail</button>
      </form>
    </div>
  </div>
</html>