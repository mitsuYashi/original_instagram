<?php

require('./../../resource/db_connect.php');
require('./../../resource/functions.php');
session_start();

$sql = 'INSERT INTO posts_dow(posts_id, member_id) VALUES(?, ?)';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->execute();

$filepath = '../../images/picture/'.$_REQUEST['path'];
 
// リネーム後のファイル名
$filename = $_REQUEST['path'];
 
// ファイルタイプを指定
header('Content-Type: application/force-download');
 
// ファイルサイズを取得し、ダウンロードの進捗を表示
header('Content-Length: '.filesize($filepath));
 
// ファイルのダウンロード、リネームを指示
header('Content-Disposition: attachment; filename="'.$filename.'"');
 
// ファイルを読み込みダウンロードを実行
readfile($filepath);
