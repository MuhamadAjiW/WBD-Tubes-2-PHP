<?php use config\AppConfig;?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <header class="gen-header">
            <h1 class="gen-h1 ">Search</h1>
            <p>What kind of book are you looking for?</p>
        </header>
        <div class="input-container">
            <div class="input-bar">
                <input id="query-input" type="text" class="input" placeholder="Search..."
                value="<?php if($querydata['query']) echo htmlspecialchars($querydata['query'], ENT_QUOTES, 'UTF-8');?>">
            </div>
        </div>
        <section class="filter-cluster">
            <h2>Filter</h2>
            
            <div class="select-container">
                <label>Select Genre</label>
                <select id="genre-select" name="genre" onchange="changeGenre()">
                    <option value="all" <?php if($querydata['genre'] === "all") echo "selected";?>>All</option>
                    <?php
                        foreach ($genrelist as $g) {
                            $genreentry = $g['genre'];
                            echo '<option value="' . $genreentry . '"';
                            if($querydata["genre"] === $genreentry) echo "selected";
                            echo '>' . $genreentry . '</option>';
                        }
                    ?>                    
                </select>
            </div>

            <div class="select-container">
                <label>Sort by</label>
                <select id="sort-select" name="sort" onchange="changeSort()">
                    <option value="title" <?php if($querydata['sort'] === "title") echo "selected";?>>Title</option>
                    <option value="genre" <?php if($querydata['sort'] === "genre") echo "selected";?>>Genre</option>
                    <option value="rating_avg" <?php if($querydata['sort'] === "rating_avg") echo "selected";?>>Rating</option>
                    <option value="name" <?php if($querydata['sort'] === "name") echo "selected";?>>Author</option>
                    <option value="release_date" <?php if($querydata['sort'] === "release_date") echo "selected";?>>Release Date</option>
                </select>
            </div>
            
            <div class="toggle-container">
                <div class="cluster-h">
                    <input id="desc-input" class="toggle" type="checkbox"  onchange="changeDesc()"
                        <?php if($querydata['desc']) echo "checked";?>
                    ></input>
                    <label>Descending</label>
                </div>    
                <div class="cluster-h">
                    <input id="graphic-input" class="toggle" type="checkbox" onchange="changeHgcntn()"
                        <?php if($querydata['not_graphic_cntn']) echo "checked";?>
                    ></input>
                    <label>Hide graphic content</label>
                </div>
            </div>
        </section>
        <section id="result-booklist">
            <h2>Search Result</h2>
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
                    'pagelen' => intval(ceil($booklen / AppConfig::ENTRIES_MAIN_SEARCH)),
                    'currentpage' => $currentpage,
                    'clickfunction' => 'changePage',
                ];
                extract($data);
                include '../app/components/PageIndex.php';
            ?>
        </section>
    </div>

    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    <script src="/public/js/util.js"></script>
    <script src="/public/js/search.js"></script>
</body>
</html>
