<?php
use app\controllers\TopBar;
use app\models\UserModel;

?>

<div class="top-bar">
    <nav class="top-bar-contents">
        <a class="cluster-h cluster-logo" name="clickable logo of the company, leads to the homepage"
        onclick="location.href='/home'">
            <img src="/storage/assets/logo.svg" alt="Logo of company" style="width: 55px; height: 55px; background: transparent">
            </img>
            <p class="web-title">
                Baca.a
            </p>
        </a>
        
        <div class="cluster-h cluster-search">
            <div class="input-container input-container-sm" <?php if(isset($inadminpage)) echo 'hidden'?>>
                <div class="input-bar input-bar-sm">
                    <input id="topbar-search" type="text" class="input input-sm" placeholder="Search...">
                </div>
                <div id="topbar-search-result" class="search-result-sm"></div>
            </div>

            <?php
            if (isset($_SESSION['user_id'])) {
                if(isset($inadminpage)){
                    include "../app/components/AdminCluster.php";
                }
                else{
                    $usermodel = new UserModel();
                    $name = $usermodel->fetchUserByID($_SESSION['user_id'])['name'];
                    
                    echo '<div class="cluster-h cluster-login">';
                    echo '<a class="book-container" style="background-color: transparent;border:none" onclick="location.href=\'/search\'">';                    
                    echo '<img class="book-image" src="/storage/assets/search.svg" alt="illustration of a magnifying glass for search">';
                    echo '</a>';
                    if($_SESSION['permissions']){
                        echo '<a class="btn btn-sm btn-yellow" onclick="location.href=\'/admin\'">Dashboard</a>';
                    }
                    echo '<a class="btn btn-sm btn-grey" onclick="location.href=\'/profile\'">' . $name . '</a>';
                    echo '<a class="book-container" style="background-color: transparent;border:none" onclick="location.href=\'/profile\'">';
                    
                    // +TODO: User images
                    echo '<img class="book-image" src="/storage/assets/profile.svg" alt="illustration of a user">';
                    
                    echo '</a>';
                    echo '</div>';
                }
            } else{
                echo '<div class="cluster-h cluster-login">';
                echo '<a class="book-container" style="background-color: transparent;border:none" onclick="location.href=\'/search\'">';                    
                echo '<img class="book-image" src="/storage/assets/search.svg" alt="illustration of a magnifying glass for search">';
                echo '</a>';
                echo '<a class="btn btn-sm btn-grey" onclick="location.href=\'/login\'">Log in</a>';
                echo '<a class="btn btn-sm btn-yellow" onclick="location.href=\'/register\'">Sign up</a>';
                echo '</div>';
            }
            ?>

        </div>
        <button class="btn btn-menu-sm"
            onclick=showSmallMenu()>
            <img src="/storage/assets/menu3line.svg" alt="Menu button" style="width:100%; height:100%;" alt="illustration of the button to open small popup menu">
            </img>
        </button>
    </nav>
    
    <?php
    if (isset($_SESSION['user_id'])) {
        if($_SESSION['permissions']){
            if(isset($inadminpage)){
                echo '<div id="popup-container" class="menu-popup-wrap" style="height:320px">';
                echo '<div id="popup-menu" class="menu-popup-sm">';
                echo '<a class="btn popup-btn-sm" onclick="location.href=\'/admin/books\'">';
                echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to admin books page"> Books';
                echo '</a>';
                echo '<a class="btn popup-btn-sm" onclick="location.href=\'/admin/users\'">';
                echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to admin users page"> Users';
                echo '</a>';
                echo '<a class="btn popup-btn-sm" onclick="location.href=\'/admin/reviews\'">';
                echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to admin reviews page"> Reviews';
                echo '</a>';
            }
            else{
                echo '<div id="popup-container" class="menu-popup-wrap">';
                echo '<div id="popup-menu" class="menu-popup-sm">';
                echo '<a class="btn popup-btn-sm" onclick="location.href=\'/admin\'">';
                echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to admin page"> Dashboard';
                echo '</a>';
            }
        }
        else{
            echo '<div id="popup-container" class="menu-popup-wrap" style="height:128px">';
            echo '<div id="popup-menu" class="menu-popup-sm">';
        }
        echo '<a class="btn popup-btn-sm" onclick="location.href=\'/profile\'">';
        echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to profile page"> Profile';
        echo '</a>';
        echo '<a class="btn popup-btn-sm" onclick="location.href=\'/search\'">';
        echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button to search page"> Search';
        echo '</a>';
        echo '</div></div>';
    } else{
        echo '<div id="popup-container" class="menu-popup-wrap">';
        echo '<div id="popup-menu" class="menu-popup-sm">';
        echo '<a class="btn popup-btn-sm" onclick="location.href=\'/login\'">';
        echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button"> Log in';
        echo '</a>';
        echo '<a class="btn popup-btn-sm" onclick="location.href=\'/register\'">';
        echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button"> Sign up';
        echo '</a>';
        echo '<a class="btn popup-btn-sm" onclick="location.href=\'/search\'">';
        echo '<img class="popup-btn-icn" src="/storage/assets/menu3line.svg" alt="Menu button"> Search';
        echo '</a>';
        echo '</div></div>';
    }
    ?>


    <script defer type="text/javascript" src="/public/js/util.js"></script>
    <script defer type="text/javascript" src="/public/js/topbar.js"></script>
</div>