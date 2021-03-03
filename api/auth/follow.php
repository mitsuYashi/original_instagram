<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../join/login.php');
    exit();
}

$sql = 'SELECT COUNT(*) cnt FROM follow WHERE follow_member_id = ? AND member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->execute();
$e_follow = $stmt->fetch();

$insert = 'INSERT INTO follow(follow_member_id, member_id, created) VALUES (?, ?, now())';
$delete = 'DELETE FROM follow WHERE follow_member_id = ? AND member_id = ?';

if ($e_follow['cnt'] > 0) {
    $stmt = $db->prepare($delete);
    $stmt->bindParam(1, $_REQUEST['id']);
    $stmt->bindParam(2, $_SESSION['id']);
    $stmt->execute();
} else {
    $stmt = $db->prepare($insert);
    $stmt->bindParam(1, $_REQUEST['id']);
    $stmt->bindParam(2, $_SESSION['id']);
    $stmt->execute();
}

$id = $_REQUEST['id'];

header('Location: ./../../profile.php?id='.$id);
