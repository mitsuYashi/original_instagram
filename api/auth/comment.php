<?php
require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

if (empty($_POST)) {
    header('Location: ../../index.php');
    exit();
}

$sql = 'INSERT INTO comment(message, sent_member_id, post_id, created) VALUES(?,?,?,now())';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_POST['comment']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->bindParam(3, $_POST['img_id']);
$stmt->execute();

header('Location: ../../picture.php?id='.$_POST['img_id']);
exit();