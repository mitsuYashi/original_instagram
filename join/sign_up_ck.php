<?php

require('../resource/functions.php');
require('../resource/db_connect.php');
session_start();

if (!isset($_SESSION['join'])) {
    header('Location: sign_up.php');
    exit();
}

foreach ($_SESSION['join'] as $key => $value) {
    if (empty($value)) {
        header('Location: sign_up.php');
        exit();
    }
}

if (!empty($_POST)){


    try{
        // 正常な処理
        // 登録処理をする
        $stmt = $db->prepare('INSERT INTO members(name, icon_path, mail, password, user_id) VALUES(?,"icon.png",?,?,?)');
        
        // $name = $_SESSION['join']['name'];でもいい

        $stmt->bindParam(1,$_SESSION['join']['name']);
        $stmt->bindParam(2,$_SESSION['join']['mail']);
        $stmt->bindParam(3,sha1($_SESSION['join']['password']));
        $stmt->bindParam(4,$_SESSION['join']['user_id']);
        $stmt->execute();

        unset($_SESSION['join']);

        header('Location: login.php');
        exit();

    }catch (PDOException $e) {
        // 異常な処理
        $error='会員登録処理に失敗しました。管理者に連絡してください。';
    }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>

    <link rel="stylesheet" role="text/css" href="../css/reset.css">
    <link rel="stylesheet" role="text/css" href="../css/join.css">
</head>
<body id="sign_up_ck">
    
    <h1 id="PICTshadow">PICTshadow</h1>

    <div id="wrapper">
        <div id="wrap">
            <h1>会員登録</h1>
            <div id="formBox">
                <form action="" method="POST">
                    <input type="hidden" value="submit" name="action">
                    <dd>
                        <label>メールアドレス</label>
                        <p><?php echo hsc($_SESSION['join']['mail']) ?></p>
                    </dd>
                    <dd>
                        <label>ユーザーID</label>
                        <p><?php echo hsc($_SESSION['join']['user_id']) ?></p>
                    </dd>
                    <dd>
                        <label>名前</label>
                        <p><?php echo hsc($_SESSION['join']['name']) ?></p>
                    </dd>
                    <dd>
                        <label>パスワード</label>
                        <p>※表示しません</p>
                        
                    </dd>
                    <dd>
                        <input type="submit" value="登録" class="btn-flat-border">
                    </dd>
                </form>
            </div>
        </div>
    </div>

</body>
</html>