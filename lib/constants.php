<?php

// add slash / at the end
define('BASE_URL','http://'.$_SERVER['SERVER_NAME'].'/b_card/');
define('TIMEZONE', 'Asia/Kolkata');
date_default_timezone_set(TIMEZONE);
// $base_path = $_SERVER['SERVER_NAME'].'/'.basename(__DIR__);

// database prefix if you use in local
define('DB_PREFIX', 'hikmah_');
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'hikmah_app'); 

// database prefix if you use in LIVE
/*define('DB_PREFIX', 'kid_');
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'alamaana_salim');
define('DB_PASSWORD', 'salim123');
define('DB_DATABASE', 'iou_app');*/

// define database tables
define('TABLE_USERS', DB_PREFIX.'user_list');
define('TABLE_CONTACTS', DB_PREFIX.'contact_details');
define('TABLE_TAGS', DB_PREFIX.'tag_list');
?>