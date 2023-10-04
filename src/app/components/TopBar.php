<?php use app\controllers\TopBar;?>

<div class="top-bar">
    <nav class="top-bar-contents">
        <button class="cluster-h cluster-logo"
        onclick="location.href='/home'">
            <img src="storage/assets/logo.svg" alt="Logo of company" style="width: 55px; height: 55px; background: transparent">
            </img>
            <p class="web-title">
                Baca.a
            </p>
        </button>
        
        <div class="cluster-h cluster-search">
            <div class="input-container input-container-sm">
                <div class="input-bar input-bar-sm">
                    <input id="topbar-search" type="text" class="input input-sm" placeholder="Search...">
                </div>
                <div id="topbar-search-result" class="search-result-sm">
                    <!-- placeholder -->
                    <!-- <button class="search-entry-sm" onclick="window.location.href = '/detail?bid=1'">
                        <div class="book-container">
                            <img class="book-image" src="/storage/images/image1.jpg" alt="image of title">
                        </div>
                        <div class="cluster-v">
                            <div class="pusher"></div>
                                <p class="search-entry-sm-t">title</p>
                                <p class="search-entry-sm-a">By author</p>
                            <div class="pusher"></div>
                        </div>
                    </button> -->
                    <!-- placeholder -->
                </div>
            </div>
    <!-- TODO: make template -->
            <div class="cluster-h cluster-login">
                <button class="btn btn-sm btn-grey"
                    onclick="location.href='/login'">
                    Log in
                </button>
                <button class="btn btn-sm btn-yellow" onclick="location.href='/register'">
                    Sign up
                </button>
            </div>
    <!-- make template -->
        </div>
        <button class="btn btn-menu-sm"
            onclick=showSmallMenu()>
            <img src="storage/assets/menu3line.svg" alt="Menu button" style="width:100%; height:100%;">
            </img>
        </button>
    </nav>
    <div id="popup-menu" class="menu-popup-sm">
        <button class="btn popup-btn-sm"
            onclick="location.href='/login'">
            <img class="popup-btn-icn" src="storage/assets/menu3line.svg" alt="Menu button">
            Log in
        </button>
        <button class="btn popup-btn-sm"
            onclick="location.href='/register'">
            <img class="popup-btn-icn" src="storage/assets/menu3line.svg" alt="Menu button">
            Sign up
        </button>
        <button class="btn popup-btn-sm"
            onclick="location.href='/search'">
            <img class="popup-btn-icn" src="storage/assets/menu3line.svg" alt="Menu button">
            Search
        </button>
    </div>

    <script src="public/js/util.js"></script>
    <script src="public/js/topbar.js"></script>

</div>