<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

$uri = $_SERVER['HTTP_REFERER'];

$sql = 'SELECT member_id FROM posts WHERE id=?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1,$_REQUEST['id']);
$stmt->execute();
$result = $stmt->fetch();

if ($result['member_id'] != $_SESSION['id']) {
    header('Location ../../index.php');
    exit();
}

$sql = 'DELETE FROM posts WHERE id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();

header('Location: ../../index.php');
exit();