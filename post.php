<?php

require('./resource/db_connect.php');
require('./resource/functions.php');

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

if (!empty($_FILES)) {
    $filename = $_FILES['img']['name'];

    if (!empty($filename)) {
        $ext = substr($filename, -3);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif' && $ext != 'ebp') {
            $error['img'] = 'type';
        }
    }

    if (!isset($error) && $error['img'] != 'type') {
        $img = date('YmdHis').$filename;
        move_uploaded_file($_FILES['img']['tmp_name'], './images/picture/' .$img);

        $stmt = $db->prepare('INSERT INTO posts(member_id, picture_path, created) VALUES(?,?,now())');
        $stmt->bindParam(1,$_SESSION['id']);
        $stmt->bindParam(2,$img);
        $stmt->execute();

        $stmt = $db->prepare('SELECT id FROM posts WHERE picture_path = ?');
        $stmt->bindParam(1, $img);
        $stmt->execute();
        $result = $stmt->fetch();

        header('Location: edit.php?id='.$result['id']);
        exit();
    }
}
 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICTshadow</title>
    <link rel="stylesheet" role="text/css" href="css/reset.css">
    <link rel="stylesheet" role="text/css" href="css/main.css">

</head>
<body>

    <?php include('include/header.php'); ?>
    <div id="wrap">

        <main>

            <div id="h_100"></div>

            <div class="flex">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="img">
                <input type="submit" value="投稿">
            </form>
            </div>
            
            <?php

                if (isset($error) && $error['img'] == 'type') {
                    echo '<p class="error">※この拡張子は対応していません</p>';
                }

            ?>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>