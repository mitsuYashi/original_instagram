<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if (empty($_SESSION)){
    header('Location: join/login.php');
    exit();
}

$sql = 'SELECT id, picture_path, `filter` FROM posts WHERE member_id = ? ORDER BY id DESC';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();

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

            <div class="gg_box">
                <?php foreach ($stmt as $posts) { ?>
                <a href="picture.php?id=<?php echo $posts['id'] ?>"><img src="images/picture/<?php echo $posts['picture_path']; ?>" alt="<?= $posts['picture_path'] ?>"  class="<?php echo $posts['filter'] ?>"></a>
                <?php } ?>
            </div>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>