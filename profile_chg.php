<?php

require('./resource/db_connect.php');
require('./resource/functions.php');

session_start();
if (empty($_SESSION)){
    header('Location: join/login.php');
    exit();
}

$error['img'] = '';
$error['user_id'] = '';

$stmt = $db->prepare('SELECT * FROM members WHERE id = ?');
$stmt->bindParam(1,$_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch();

if (!empty($_POST) || !empty($_FILES)) {
    
    $prf_chg = $_POST;

    if (empty($_POST['user_id']) || $_POST['user_id'] == $user['user_id']) {

        $prf_chg['user_id'] = $user['user_id'];

    } else {

        $sql = 'SELECT COUNT(*) cnt FROM members WHERE user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $prf_chg['user_id']);
        $stmt->execute();
        $user_id_ck = $stmt->fetch();

        print_r($user_id_ck['cnt']);

        if ($user_id_ck['cnt'] >= 1) {
            $error['user_id'] = 'duplicate';
        }

    }

    if (empty($_POST['name'])) {

        $prf_chg['name'] = $user['name'];

    }

    if ($_FILES['visual_picture']['name'] == '') {

        $img = $user['icon_path'];

    } else {

        $filename = $_FILES['visual_picture']['name'];
        $ext = substr($filename, -3);

        if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif' && $ext != 'ebp') {
            $error['img'] = 'type';
        } else {
            $error['img'] = '';
            $img = date('YmdHis').$filename;
            move_uploaded_file($_FILES['visual_picture']['tmp_name'], './images/visual_picture/' .$img);
        }

    }

    if ($error['img'] != 'type' && $error['user_id'] != 'duplicate') {

        if ($prf_chg['password'] != '') {

            if ($prf_chg['password'] == $prf_chg['password_ck']) {
                
                $pass = sha1($prf_chg['password']);

                $sql = 'UPDATE members SET name = ?, icon_path = ?, user_id = ?, password = ? WHERE id = ?';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(1, $prf_chg['name']);
                $stmt->bindParam(2, $img);
                $stmt->bindParam(3, $prf_chg['user_id']);
                $stmt->bindParam(4, $pass);
                $stmt->bindParam(5, $_SESSION['id']);
                $stmt->execute();

                header('Location: profile.php?id='.$_SESSION['id']);

            }
        } else {

            $sql = 'UPDATE members SET name = ?, icon_path = ?, user_id = ? WHERE id = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $prf_chg['name']);
            $stmt->bindParam(2, $img);
            $stmt->bindParam(3, $prf_chg['user_id']);
            $stmt->bindParam(4, $_SESSION['id']);
            $stmt->execute();

            header('Location: profile.php?id='.$_SESSION['id']);
            exit();
        }
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

        <main id="pro_chg">

            <div id="h_100"></div>

            <form action="" method="post" enctype="multipart/form-data">
                <dd>
                    <p class="error <?php if ($error['user_id'] != 'duplicate') { echo 'hidden_text';} ?>">※このユーザーIDは使用されています</p>
                    <label>ユーザーID</label>
                    <input type="text" name="user_id" value="<?php echo hsc($user['user_id']) ?>">
                </dd>
                <dd>
                    <label>名前</label>
                    <input type="text" name="name" value="<?php echo hsc($user['name']) ?>">
                </dd>
                <dd>
                    <label>変更したいパスワード</label>
                    <input type="password" name="password">
                </dd>
                <dd>
                    <label>パスワード確認用</label>
                    <input type="password" name="password_ck">
                </dd>
                <dd>
                    <label>アイコン変更</label>
                    <input type="file" name="visual_picture">
                </dd>
                <?php

                if (isset($error) && $error['img'] == 'type') {
                    echo '<p class="error prf_error pos_ab">※この拡張子は対応していません</p>';
                }

                ?>
                <dd>
                    <a href="api/auth/log_out.php" class="pos_ab">ログアウト</a>
                    <a href="remove.php" class="pos_ab">退会</a>
                    <input type="submit" value="変更" class="btn-flat-border">
                </dd>
            </form>

            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>