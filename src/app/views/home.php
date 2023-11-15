<?php
use app\models\UserModel;
use config\AppConfig;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div class="main-content first">
        <header class="gen-header">
            <?php
                if(isset($_SESSION['user_id'])){
                    $bookmodel = new UserModel();
                    $name = $bookmodel->fetchUserByID($_SESSION['user_id'])['name'];

                    echo '<h1 class="gen-h1 ">Hello ' . $name .'!</h1>';
                }
                else{
                    echo '<h1 class="gen-h1 ">Start Exploring</h1>';
                }
            ?>
        <form action="/subscriber" method="post">
            <button class="btn btn-yellow subscribe" type="submit" name="Premium">Daftar Premium</button>
        </form>


            <p>Here's what our reviewers think you should read this today</p>
            <p id="currentdate" style="color:#9b9b9b;text-align:right">date</p>
        </header>
        <section class="book-rec">
            <?php
                extract($bookfeatured);
                include '../app/components/BookFeatured.php';
            ?> 
        </section>
    </div>


    <div style="background-color:#f9f9f9">
        <section id="content-booklist" class="main-content">
            <h2>Book List</h2>
            <div class="book-list">
                <div class="book-grid">
                    <?php
                        foreach ($booktable as $bookdata) {
                            extract($bookdata);
                            include '../app/components/BookGridEntry.php';
                        }
                    ?> 
                </div>

            <?php
                $data = [
                    'pagelen' => intval(ceil($booklen / AppConfig::ENTRIES_PER_PAGE)),
                    'currentpage' => $currentpage,
                    'clickfunction' => 'changePage',
                ];
                extract($data);
                include '../app/components/PageIndex.php';
            ?>
        </section>
    </div>

    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    <script defer type="text/javascript" src="/public/js/home.js"></script>
</body>
</html>

