<?php

namespace config;

class AppConfig{
    public const REDIRECT = 'REDIRECT';
    public const REL_DATA = 'REL_DATA';
    public const TOP_BAR = 'TOP_BAR';
    public const FOOTER = 'FOOTER';
    public const TOP_BAR_PATH = '../app/components/TopBar.php';
    public const FOOTER_PATH = '../app/components/Footer.php';
    public const DOMAIN_NAME = 'localhost';

    public const REVIEWS_PER_LOAD = 5;
    public const ENTRIES_PER_PAGE = 4;
    public const ENTRIES_SMALL_SEARCH = 5;
    public const ENTRIES_MAIN_SEARCH = 8;
    public const FEATURED_SEED = 3310;
    public const INACTIVITY_THRESHOLD = 86400; //kelogout otomatis kalo ga remember sehari inactive atau sampe browser di close
    public const REMEMBER_THRESHOLD = 2592000; //cookienya bakal masih valid sebulan
}

?>