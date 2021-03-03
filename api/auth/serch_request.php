<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

if(empty($_POST['input_val'])){
    exit(); // POSTが空だったら終了する
} else{
    $input_val = '%'.$_POST['input_val'].'%';
}

// $sql = 'SELECT m.id, m.icon_path, m.name, m.user_id, p.id, p.picture_path FROM members m OUTER JOIN posts p WHERE m.name LIKE ? OR p.discription LIKE ?';
$sql = 'SELECT id, icon_path, name, user_id FROM members WHERE name LIKE ? OR user_id LIKE ?'; 
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $input_val, PDO::PARAM_STR);
$stmt->bindParam(2, $input_val, PDO::PARAM_STR);
$stmt->execute();

// $sql2 = 'SELECT id, picture_path, filter FROM posts WHERE discription LIKE ?'; 
// $stmt2 = $db->prepare($sql2);
// $stmt2->bindParam(1, $_POST['input_val'], PDO::PARAM_STR);
// $stmt2->execute();

echo json_encode($stmt->fetchAll());
// echo json_encode($stmt2->fetchAll());
exit();