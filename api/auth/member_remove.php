<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

$sql = 'DELETE FROM members WHERE id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->execute();

$sql = 'DELETE FROM posts WHERE member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->execute();

$sql = 'DELETE FROM follow WHERE member_id = ? OR follow_member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->execute();

$sql = 'DELETE FROM comment WHERE sent_member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->execute();

if (isset($_COOKIE['user_id'])) {
    
    // Cookie情報も削除
    setcookie('user_id', '', time()-3600, '/');
    setcookie('password', '', time()-3600, '/');

}
session_destroy();

header('Location: ../../join/login.php');
exit();