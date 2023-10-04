<?php use config\AppConfig;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div id="content-header" class="main-content first">
        <header class="gen-header">
            <h1>Start Exploring</h1>
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
        <!-- TODO: Implement pagination -->
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
</body>

<script src="public/js/home.js"></script>
</html>


