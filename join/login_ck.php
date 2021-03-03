<?php
require('../resource/db_connect.php');
require('../resource/functions.php');
session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if (!empty($_COOKIE['user_id'])) {
    header('Location: ../index.php');
}

$login = $db->prepare('SELECT user_id, name, icon_path FROM members WHERE id = ?');
$login->bindParam(1, $_SESSION['id']);
$login->execute();
$member = $login->fetch();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

    <link rel="stylesheet" role="text/css" href="../css/reset.css">
    <link rel="stylesheet" role="text/css" href="../css/join.css">
</head>
<body id="login_ck">
    
    <div id="wrapper">
        <div id="wrap">
            <h1>ログイン</h1>
            <div id="formBox">
                <form action="../index.php" method="POST">
                    <div id="vis"><img src="../images/visual_picture/<?php echo hsc($member['icon_path']) ?>"></div>
                    <p>@<?php echo hsc($member['user_id']); ?></p>
                    <p><?php echo hsc($member['name']); ?></p>
                    <input type="submit" value="ログイン" class="btn-flat-border">
                </form>
            </div>
        </div>
    </div>

</body>
</html>