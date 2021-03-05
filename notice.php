<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

$stmt = $db->prepare('SELECT f.created, m.user_id, m.icon_path, m.id FROM follow f JOIN members m ON f.member_id = m.id WHERE f.follow_member_id = ? ORDER BY f.id DESC');
$stmt->bindParam(1, $_SESSION['id']);
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

        <main id="notice">

            <div id="h_100"></div>

            <?php foreach ($stmt as $follow) { ?>
            <a href="profile.php?id=<?php echo $follow['id'] ?>" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/<?php echo $follow['icon_path'] ?>">
                    <div class="flex">
                        <span>@<?php echo $follow['user_id'] ?> さんが</span>
                        <span width="300px">あなたをフォローしました</span>
                        <div class="timeStamp pos_ab">
                        <?php
                            $date = new DateTime('now');
                            $date2 = new DateTime($follow['created']);
                            
                            $diff = $date->diff($date2);
                            
                            if ($diff->format('%Y') >= 1) {
                                echo $diff->format('%Y年前');
                            } elseif ($diff->format('%m') >= 1) {
                                echo $diff->format('%mか月前');
                            } elseif ($diff->format('%d') >= 1) {
                                echo $diff->format('%d日前');
                            } elseif ($diff->format('%h') >= 1) {
                                echo $diff->format('%h時間前');
                            } else {
                                echo $diff->format('%i分前');
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </a>
                <?php
                // if ($stmt->fetch() == NULL) {
                //     echo '<p style="margin-left: 100px;">通知はありません</p>';
                // }
                ?>
            <?php } ?>

        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>