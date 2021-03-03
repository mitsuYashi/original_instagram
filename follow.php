<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if ($_REQUEST['follow'] == 0) {
    $sql = 'SELECT f.follow_member_id f_id, m.name, m.user_id, m.icon_path FROM follow f JOIN members m ON f.follow_member_id = m.id WHERE f.member_id = ?';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $_REQUEST['id']);
    $stmt->execute();
} elseif($_REQUEST['follow'] == 1) {
    $sql = 'SELECT f.member_id f_id, m.name, m.user_id, m.icon_path FROM follow f JOIN members m ON f.member_id = m.id WHERE f.follow_member_id = ?';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $_REQUEST['id']);
    $stmt->execute();
} else {
    header('Location: profile.php?id='.$_REQUEST['id']);
    exit();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" role="text/css" href="css/reset.css">
    <link rel="stylesheet" role="text/css" href="css/main.css">

</head>
<body>

    <?php include('include/header.php'); ?>
    <div id="wrap">

        <main id="follow">

            <div id="h_100"></div>

            <div class="flex select">
                <a href="?id=<?= $_REQUEST['id'].'&follow=0' ?>">フォロー</a> 
                <a href="?id=<?= $_REQUEST['id'].'&follow=1' ?>">フォロワー</a> 
            </div>

            <div class="bor"></div>

            <?php foreach ($stmt as $follow) { ?>
            <a href="profile.php?id=<?php echo $follow['f_id'] ?>" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/<?php echo $follow['icon_path'] ?>">
                    <div class="flex">
                        <span><?php echo $follow['name']; ?></span>
                        <span><?php echo $follow['user_id'] ?></span>
                    </div>
                </div>
            </a>
            <?php } ?>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
</body>
</html>