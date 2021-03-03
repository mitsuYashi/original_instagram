<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

if (!isset($_SESSION['post'])) {
    header('Location: ../../index.php');
    exit();
}

$sql = 'UPDATE posts SET `filter` = ?, discription = ? WHERE id =?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['post']['filter']);
$stmt->bindParam(2, $_SESSION['post']['discription']);
$stmt->bindParam(3, $_SESSION['post']['id']);
$stmt->execute();

unset($_SESSION['post']);

header('Location: ../../index.php');
exit();
