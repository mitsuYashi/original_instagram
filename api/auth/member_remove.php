<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

$sql = 'DELETE FROM members WHERE id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->execute();

$sql2 = 'DELETE FROM posts WHERE member_id = ?';
$stmt2 = $db->prepare($sql2);
$stmt2->bindParam(1, $_SESSION['id']);
$stmt2->execute();

$sql3 = 'DELETE FROM follow WHERE member_id = ? OR follow_member_id = ?';
$stmt3 = $db->prepare($sql3);
$stmt3->bindParam(1, $_SESSION['id']);
$stmt3->bindParam(2, $_SESSION['id']);
$stmt3->execute();

$sql4 = 'DELETE FROM comment WHERE sent_member_id = ?';
$stmt4 = $db->prepare($sql4);
$stmt4->bindParam(1, $_SESSION['id']);
$stmt4->execute();

if (isset($_COOKIE['user_id'])) {
    
    // Cookie情報も削除
    setcookie('user_id', '', time()-3600, '/');
    setcookie('password', '', time()-3600, '/');

}
session_destroy();

header('Location: ../../join/login.php');
exit();