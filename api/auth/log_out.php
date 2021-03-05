<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');

session_start();
session_destroy();

if (isset($_COOKIE['user_id'])) {
    
    // Cookie情報も削除
    setcookie('user_id', '', time()-3600, '/');
    setcookie('password', '', time()-3600, '/');

}

header('Location: ../../join/login.php');
exit();