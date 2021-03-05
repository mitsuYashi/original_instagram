<?php

require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

// 投稿の取得
$sql = 'SELECT p.id p_id ,p.picture_path, p.filter, p.member_id, p.created, p.discription, m.user_id, m.icon_path, m.id FROM posts p JOIN members m ON p.member_id = m.id WHERE p.id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();
$post = $stmt->fetch();
$date = new DateTime($post['created']);
$post_created = $date->format('Y年m月d日');

if (empty($post)) {
    header('Location: index.php');
    exit();
}

// コメント
$sql2 = 'SELECT c.message, c.created FROM comment c WHERE c.post_id = ?';
$stmt2 = $db->prepare($sql2);
$stmt2->bindParam(1, $_REQUEST['id']);
$stmt2->execute();


// ダウンロード回数
$sql3 = 'SELECT COUNT(*) cnt FROM posts_dow WHERE posts_id = ?';
$stmt3 = $db->prepare($sql3);
$stmt3->bindParam(1, $_REQUEST['id']);
$stmt3->execute();
$cnt = $stmt3->fetch();

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

        <div class="post_img detail_img">

            <div class="prf_img cir">
                <a href="profile.php?id=<?php echo $post['id']; ?>">
                    <img src="images/visual_picture/<?php echo hsc($post['icon_path']); ?>"><span>@<?php echo hsc($post['user_id']); ?></span>
                </a>
            </div>


            <div class="img">

                <div class="img_pic"><img src="images/picture/<?php echo hsc($post['picture_path']); ?>" alt="<?php echo hsc($post['picture_path']); ?>" class="<?php echo hsc($post['filter']) ?>"></div>
                <p class="discri post_created"><?php echo hsc($post_created) ?></p>
                <p class="discri"><?php echo hsc($post['discription']) ?></p>
                <div class="com">
                    <?php 
                        foreach ($stmt2 as $value) { 
                            $date = new DateTime($value['created']);
                            $com_created = $date->format('Y-m-d');
                    ?>

                    <p><?php echo hsc($com_created. ' ' .$value['message']); ?></p>
                    <?php } ?>

                    <?php if ($post['member_id'] == $_SESSION['id']) { ?>
                    <a href="edit.php?id=<?php echo hsc($post['p_id']) ?>" class="pic_edi"><div class="pic_edi"></div></a>
                    <?php } ?>
                    <a href="./api/auth/img_download.php?path=<?php echo hsc($post['picture_path']) ?>&id=<?php echo hsc($post['p_id']) ?>" class="pic_dow"><div class="pic_dow"><?=$cnt['cnt'] ?></div></a>
                </div>

                <form action="./api/auth/comment.php" class="inputBox form_comment" method="post">
                    <input type="hidden" name="img_id" value="<?php echo hsc($post['p_id']) ?>">
                    <input type="text" name="comment" class="post_comment" autofocus>
                    <label class="lab_ani pic_com">コメント</label>
                    <input type="submit" value="送信">
                </form>
                    
            </div>


        </div>

        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
</body>
</html>