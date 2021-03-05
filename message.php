<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

if (!isset($_REQUEST['id'])) {
    header('Location: dm.php');
    exit();
}

$sql = 'SELECT * FROM dm_time WHERE member_id = ? AND sent_member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->bindParam(2, $_REQUEST['id']);
$stmt->execute();
$time = $stmt->fetch();

if (empty($time)) {
    $sql = 'INSERT INTO dm_time(member_id, sent_member_id, visited) VALUES(?, ?, now())';
    
} else {
    $sql = 'UPDATE dm_time SET visited = now() WHERE member_id = ? AND sent_member_id = ?';   
}
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->bindParam(2, $_REQUEST['id']);
$stmt->execute();



// 相互フォローじゃない場合-----
$sql = 'SELECT subq_A.follow_member_id f_m_id FROM (SELECT member_id, follow_member_id FROM follow WHERE member_id = ?) AS subq_A JOIN (SELECT member_id, follow_member_id FROM follow WHERE follow_member_id = ?) AS subq_B ON subq_A.follow_member_id = subq_B.member_id';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_SESSION['id']);
$stmt->bindParam(2, $_SESSION['id']);
$stmt->execute();

$flg = 0;
foreach ($stmt as $value) {
    if ($value['f_m_id'] == $_REQUEST['id']) {
        $flg = 1;
    }
}
if ($flg == 0){
    header('Location: dm.php');
}
// -----

$sql = 'SELECT message, member_id, acc_member_id, created FROM dm WHERE acc_member_id = ? OR member_id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $_REQUEST['id']);
$stmt->bindParam(2, $_REQUEST['id']);
$stmt->execute();

$sql2 = 'SELECT id, icon_path, user_id FROM members WHERE id = ?';
$stmt2 = $db->prepare($sql2);
$stmt2->bindParam(1, $_REQUEST['id']);
$stmt2->execute();
$user = $stmt2->fetch();


if (!empty($_POST)) {
    $sql3 = 'INSERT INTO dm(message, member_id, acc_member_id, created) VALUES(?, ?, ?, now())';
    $stmt3 = $db->prepare($sql3);
    $stmt3->bindParam(1, $_POST['message']);
    $stmt3->bindParam(2, $_SESSION['id']);
    $stmt3->bindParam(3, $_REQUEST['id']);
    $stmt3->execute();

    header('Location: message.php?id='.$_REQUEST['id']);
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

        <main id="message">
            <div id="h_100"></div>

            <a href="dm.php">&laquo; 戻る</a>

            <a href="profile.php?id=<?php echo $user['id'] ?>" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/<?php echo $user['icon_path'] ?>">
                    <div class="flex">
                        <span>@<?php echo $user['user_id'] ?></span>
                    </div>
                </div>
            </a>

            <div class="flex">
                <?php foreach ($stmt as $value) { 
                    if ($value['member_id'] == $_SESSION['id'] && $value['acc_member_id'] == $_REQUEST['id']) {
                        echo '<div class="my_mes">'.$value['message'].'</div>';   
                    } elseif ($value['member_id'] == $_REQUEST['id'] && $value['acc_member_id'] == $_SESSION['id']) {
                        echo '<div class="you_mes">'.$value['message'].'</div>';
                    }
                } ?>
            </div>

                <form action="" method="post">
                    <input type="text" name="message" placeholder="メッセージを入力" autofocus>
                    <button>送信</button>
                </form>

        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
</body>
</html>