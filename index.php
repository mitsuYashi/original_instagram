<?php

require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

$sql = 'SELECT DISTINCT p.id post_id, p.picture_path, p.member_id post_member_id, p.created, p.filter, p.discription, m.id, m.user_id, m.icon_path FROM posts p LEFT OUTER JOIN follow f ON p.member_id = f.follow_member_id JOIN members m ON p.member_id = m.id WHERE f.member_id = ? OR p.member_id = ? ORDER BY p.id DESC LIMIT 6';
$stmt = $db->prepare($sql);
$stmt->bindParam(1,$_SESSION['id']);
$stmt->bindParam(2,$_SESSION['id']);
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
            
            <form action="" method="post" class="inputBox">
                <input type="text" name="serch" autofocus>
                <label class="pos_ab lab_ani">user serch</label>
                <!-- <input type="submit" value="検索"> -->
            </form>
        
            <div id="innerSerch">
                <?php

                foreach ($stmt as $posts) {
                    
                ?>
                <div class="post_img">

                    <div class="prf_img cir">
                        <a href="profile.php?id=<?php echo hsc($posts['post_member_id']) ?>">
                            <img src="images/visual_picture/<?php echo hsc($posts['icon_path']) ?>"><span>@<?php echo hsc($posts['user_id']) ?></span>
                        </a>
                    </div>
                    

                    <div class="img">
                        <a href="picture.php?id=<?php echo hsc($posts['post_id']) ?>">
                            <div class="img_pic"><img src="images/picture/<?php echo hsc($posts['picture_path']) ?>" alt="<?php echo hsc($posts['picture_path']) ?>"  class="<?php echo hsc($posts['filter']) ?>" ></div>
                            <p class="discri"><?php echo hsc($posts['discription']) ?></p>
                        </a>
                    </div>

                </div>

                <?php } ?>

                <a href="dm.php"><div id="send_dm" class="cir"></div></a>
            </div>

        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="node_modules/axios/lib/axios.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/serch_request.js"></script>
</body>
</html>