<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

// 相互フォロー判定
$sql = 'SELECT m.id, m.icon_path, m.user_id FROM members m JOIN (SELECT subq_A.follow_member_id FROM (SELECT member_id, follow_member_id FROM follow WHERE member_id = ?) subq_A JOIN (SELECT member_id, follow_member_id FROM follow WHERE follow_member_id = ?) subq_B ON subq_A.follow_member_id = subq_B.member_id) subq_C ON subq_C.follow_member_id = m.id';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->execute();


// 未読件数
$num = 'SELECT COUNT(*) cnt FROM dm WHERE created >= (SELECT visited FROM dm_time d_t WHERE d_t.member_id = ? AND d_t.sent_member_id = ?) AND member_id = ? AND acc_member_id = ?';
// $stmt2 = $db->prepare($num);
// $stmt2->bindParam(1, $_SESSION['id']);
// $stmt2->bindParam(2, $_REQUEST['id']);
// $stmt2->bindParam(3, $_REQUEST['id']);
// $stmt2->bindParam(4, $_SESSION['id']);
// $stmt2->execute();

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

        <main id="dm">
            <div id="h_100"></div>

            <?php 
            foreach ($stmt as $value) { 
                $stmt2 = $db->prepare($num);
                $stmt2->bindParam(1, $_SESSION['id']);
                $stmt2->bindParam(2, $value['id']);
                $stmt2->bindParam(3, $value['id']);
                $stmt2->bindParam(4, $_SESSION['id']);
                $stmt2->execute();
                $cnt = $stmt2->fetch();
            ?>
            <a href="message.php?id=<?php echo $value['id'] ?>" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/<?php echo $value['icon_path'] ?>">
                    <div class="flex">
                        <span>@<?php echo $value['user_id'] ?></span>
                    </div>
                    <?php if ($cnt['cnt'] > 0) { ?>
                        <div class="pos_ab dm_count"><?php echo $cnt['cnt'] ?></div>
                    <?php } ?>
                </div>
            </a>

            <div class="bor"></div>

            <?php } ?>



        </main>

        <?php include('include/footer.html'); ?>
    </div>

    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-firestore.js"></script>    
    
</body>
</html>