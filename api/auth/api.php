<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

if(empty($_POST['input_val'])){
    exit(); // POSTが空だったら終了する
}

$sql = 'SELECT DISTINCT p.id post_id, p.picture_path, p.member_id post_member_id, p.created, p.filter, m.id, m.user_id, m.icon_path FROM posts p LEFT OUTER JOIN follow f ON p.member_id = f.follow_member_id JOIN members m ON p.member_id = m.id WHERE f.member_id = ? OR p.member_id = ? ORDER BY p.id DESC LIMIT ?, 6';
$stmt = $db->prepare($sql);
$stmt->bindParam(1,$_SESSION['id'], PDO::PARAM_INT);
$stmt->bindParam(2,$_SESSION['id'], PDO::PARAM_INT);
$stmt->bindParam(3,$_POST['input_val'], PDO::PARAM_INT);
$stmt->execute();

echo json_encode($stmt->fetchAll());
exit();