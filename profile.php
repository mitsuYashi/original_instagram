<?php

require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if (empty($_SESSION)){
    header('Location: join/login.php');
    exit();
}


$sql = 'SELECT m.id, m.name, m.user_id, m.icon_path, IFNULL(p.picture_path, 0) p_path, p.id p_id, p.filter FROM members m LEFT JOIN posts p ON m.id = p.member_id WHERE m.id = ? ORDER BY p.id DESC LIMIT 9';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->execute();
$user = $stmt->fetch();

$sql = 'SELECT COUNT(*) p_cnt FROM posts WHERE member_id = ?';
$stmt2 = $db->prepare($sql);
$stmt2->bindParam(1, $_REQUEST['id']);
$stmt2->execute();
$post_n = $stmt2->fetch();

$sql = 'SELECT COUNT(*) cnt FROM follow WHERE member_id = ?';
$stmt3 = $db->prepare($sql);
$stmt3->bindParam(1, $_REQUEST['id']);
$stmt3->execute();
$follow = $stmt3->fetch();

$sql = 'SELECT COUNT(*) cnt FROM follow WHERE follow_member_id = ?';
$stmt4 = $db->prepare($sql);
$stmt4->bindParam(1, $_REQUEST['id']);
$stmt4->execute();
$follower = $stmt4->fetch();

$sql = 'SELECT COUNT(*) cnt FROM follow WHERE follow_member_id = ? AND member_id = ?';
$stmt5 = $db->prepare($sql);
$stmt5->bindParam(1, $_REQUEST['id']);
$stmt5->bindParam(2, $_SESSION['id']);
$stmt5->execute();
$e_follow = $stmt5->fetch();

if (empty($user)) {
    header('Location: index.php');
    exit();
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

        <main id="plofile">

            <div id="h_100"></div>

            <div class="prf_img cir">
                <img src="images/visual_picture/<?php if (!empty($user)) { echo $user['icon_path']; }else{ echo 'icon.png'; } ?>">
                <div class="flex">
                    <span><?php if (!empty($user)) { echo hsc($user['name']); } ?></span>
                    <span>@<?php if (!empty($user)) { echo hsc($user['user_id']); } ?></span>
                </div>
            </div>

            <?php if (!empty($user) && $user['id'] == $_SESSION['id']) { // 自分のページか検証 ?>
            <a href="profile_chg.php"><div class="plo_edi cir pos_ab"></div></a>

            <?php } elseif ($e_follow['cnt'] > 0) { // フォローしているか検証 ?>
                <a href="./api/auth/follow.php?id=<?php echo $user['id'] ?>"><div class="e_fol pos_ab" id="follow">フォロー解除</div></a>
            <?php }else{ // フォローしていない場合 ?>
                <a href="./api/auth/follow.php?id=<?php echo $user['id'] ?>"><div class="fol pos_ab" id="follow">フォロー</div></a>
            <?php } ?>

            <div class="bor"></div>

            <div class="contain flex">
                <a href="post_all.php?id=<?php echo $user['id']; ?>"><div>post<div><?php echo $post_n['p_cnt']; ?></div></div></a>
                <a href="follow.php?id=<?php echo $user['id'].'&follow=0'; ?>"><div>follow<div><?php echo $follow['cnt']; ?></div></div></a>
                <a href="follow.php?id=<?php echo $user['id'].'&follow=1'; ?>"><div>follower<div><?php echo $follower['cnt']; ?></div></div></a>
            </div>

            <div class="bor"></div>

            <div class="gg_box">
                <?php if (!empty($user) && $user['p_path'] != 0) { ?>
                <a href="picture.php?id=<?php echo $user['p_id'] ?>"><img src="images/picture/<?php echo $user['p_path']; ?>" alt="<?php echo $user['p_path']; ?>" class="<?php echo $user['filter'] ?>"></a>
                <?php } ?>
                <?php foreach ($stmt as $posts) { ?>
                <a href="picture.php?id=<?php echo $posts['p_id'] ?>"><img src="images/picture/<?php echo $posts['p_path']; ?>" alt="<?php echo $posts['p_path']; ?>" class="<?php echo $posts['filter'] ?>"></a>
                <?php } ?>
            </div>

            <?php 
                if ($post_n['p_cnt'] > 9) {
            ?>
                <a href="post_all.php?id=<?php echo $user["id"]; ?>" id="post_ri">全ての投稿を見る</a>
            <?php
            }
            ?>
            
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>

</body>
</html>