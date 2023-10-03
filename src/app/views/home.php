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
        <header class="home-header">
            <h1>Start Exploring</h1>
            <p>Here's what our reviewers think you should read this today</p>
            <p id="currentdate" style="color:#9b9b9b;text-align:right">date</p>
        </header>
        <section class="book-rec">
            <?php
                extract($bookfeatured);
                include 'app/components/BookFeatured.php';
            ?> 
        </section>
    </div>


    <div style="background-color:#f9f9f9">
        <!-- TODO: Implement pagination -->
        <section id="content-booklist" class="main-content">
            <h2>Book List</h1>
            <div class="book-list">
                <div class="book-grid">
                    <?php
                        foreach ($booktable as $bookdata) {
                            extract($bookdata);
                            include 'app/components/BookGridEntry.php';
                        }
                    ?> 
                </div>

                <!-- $pagelen = ceil($booklen / AppConfig::ENTRIES_PER_PAGE);
                echo $pagelen; -->
                <!-- <div class="page-nav">
                    <div class="pusher"></div>
                    <button class="btn page-nav-btn-l">
                        &lt Prev
                    </button>
                    <div class="page-nav-btn-clstr">
                        <div class="pusher"></div>
                        <button class="btn page-nav-btn-on">
                            1
                        </button>
                        <button class="btn page-nav-btn">
                            2
                        </button>
                        <button class="btn page-nav-btn">
                            3
                        </button>
                        <button class="btn page-nav-btn">
                            4
                        </button>
                        <button class="btn page-nav-btn">
                            5
                        </button>
                        <div class="pusher"></div>
                    </div>
                    <button class="btn page-nav-btn-r">
                        Next >
                    </button>
                    <div class="pusher"></div>
                </div>
            </div> -->


            <div class="page-nav">
                <div class="pusher"></div>
                
                
                <?php
                    $pagelen = intval(ceil($booklen / AppConfig::ENTRIES_PER_PAGE));
                    $buttonconfig;
                    if($currentpage === 1){
                        $buttonconfig = '<button class="btn page-nav-btn-lr-n">';
                    }
                    else{
                        $buttonconfig = '<button class="btn page-nav-btn-lr"
                                            onclick="location.href=\'home?page=' . 1 . '\'">';
                    }
                    echo $buttonconfig . "&lt First </button>";
                ?>
                <div class="page-nav-btn-clstr">
                    <div class="pusher"></div>
                    <?php
                        if($pagelen <= 5){
                            for ($i=1; $i <= $pagelen; $i++) { 
                                if($i === $currentpage){
                                    $buttonconfig = '<button class="btn page-nav-btn-on">';
                                }
                                else{
                                    $buttonconfig = '<button class="btn page-nav-btn"
                                                        onclick="location.href=\'home?page=' . $i . '\'">';
                                }
                                echo $buttonconfig . $i ."</button>";
                            }
                        }
                        else{
                            $offsetL = $currentpage - 2;
                            $offsetR = $currentpage + 2;

                            if($offsetL <= 0){
                                for ($i = 1; $i <= 5; $i++) { 
                                    if($i === $currentpage){
                                        $buttonconfig = '<button class="btn page-nav-btn-on">';
                                    }
                                    else{
                                        $buttonconfig = '<button class="btn page-nav-btn"
                                                            onclick="location.href=\'home?page=' . $i . '\'">';
                                    }
                                    echo $buttonconfig . $i ."</button>";
                                }
                            }
                            else if($offsetR >= $pagelen){
                                for ($i = $pagelen - 4; $i <= $pagelen; $i++){ 
                                    if($i === $currentpage){
                                        $buttonconfig = '<button class="btn page-nav-btn-on">';
                                    }
                                    else{
                                        $buttonconfig = '<button class="btn page-nav-btn"
                                                            onclick="location.href=\'home?page=' . $i . '\'">';
                                    }
                                    echo $buttonconfig . $i ."</button>";
                                }
                            }else{
                                for ($i = $currentpage - 2; $i <= $currentpage + 2; $i++){ 
                                    if($i === $currentpage){
                                        $buttonconfig = '<button class="btn page-nav-btn-on">';
                                    }
                                    else{
                                        $buttonconfig = '<button class="btn page-nav-btn"
                                                            onclick="location.href=\'home?page=' . $i . '\'">';
                                    }
                                    echo $buttonconfig . $i ."</button>";
                                }
                            }
                        }
                    ?>
                    <div class="pusher"></div>
                </div>
                <?php
                    if($currentpage === $pagelen){
                        $buttonconfig = '<button class="btn page-nav-btn-lr-n">';
                    }
                    else{
                        $buttonconfig = '<button class="btn page-nav-btn-lr"
                                            onclick="location.href=\'home?page=' . $pagelen . '\'">';
                    }
                    echo $buttonconfig . "Last > </button>";
                ?>
                <div class="pusher"></div>
            </div>

            
        </section>
    </div>

    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
</body>

<script src="public/js/home.js"></script>
</html>


