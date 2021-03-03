<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

$uri = $_SERVER['HTTP_REFERER'];

$sql = 'SELECT member_id, picture_path FROM posts WHERE id=?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1,$_REQUEST['id']);
$stmt->execute();
$result = $stmt->fetch();
print_r($result['picture_path']);

if ($result['member_id'] != $_SESSION['id']) {
    header('Location ../../index.php');
    exit();
}

unlink('../../images/picture/'.$result['picture_path']);

$sql = 'DELETE FROM comment WHERE post_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();

$sql = 'DELETE FROM posts WHERE id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();

header('Location: ../../index.php');
exit();