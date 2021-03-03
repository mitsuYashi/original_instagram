<?php
// エラーの非表示設定
ini_set('display_errors', 0);

require('../resource/db_connect.php');
require('../resource/functions.php');
session_start();

if ($_COOKIE['user_id'] != '') {
    $_POST['user_id'] = $_COOKIE['user_id'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['save'] = 'on';
}


if (!empty($_POST)) {
    $post_pas = sha1($_POST['password']);

    $login = $db->prepare('SELECT * FROM members WHERE user_id = ? AND password = ?');
    $login->bindParam(1, $_POST['user_id']);
    $login->bindParam(2, $post_pas);
    $login->execute();
    $record = $login->fetch();
    

    if ($record) {

        $_SESSION['id'] = $record['id'];
        $_SESSION['time'] = time();

        // ログイン情報をcookieに保存
        if ($_POST['save'] == 'on') {
            setcookie('user_id', $_POST['user_id'], time()+60*60*24*14, '/');
            setcookie('password', $_POST['password'], time()+60+60*24*14, '/');
        }

        header('Location: login_ck.php');
        exit();
    } else {
        $error = 'type';
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

    <link rel="stylesheet" role="text/css" href="../css/reset.css">
    <link rel="stylesheet" role="text/css" href="../css/join.css">
</head>
<body id="login">
    
    <div id="wrapper">
        <div id="wrap">
            <h1>ログイン</h1>
            <div id="formBox">
            <?php if ($error == 'type') {
                echo "<p class='error pos_ab'>※入力されたユーザーIDもしくはパスワードは間違っています</p>";
            } ?>
                <form action="" method="POST">
                    <dd class="inputBox">
                        <input type="text" size="35" name="user_id" id="user_id" class="enable_ck">
                        <label class="lab_ani">ユーザーID</label>
                    </dd>
                    <dd class="inputBox">
                        <input type="password" size="35" name="password" id="password" class="enable_ck">
                        <label class="lab_ani">パスワード</label>
                        <div class="qMark">
                            ?
                            <div>
                                <a href="mail_com.php">パスワードを忘れた場合</a>
                            </div>
                        </div>
                    </dd>
                    <dd>
                        <input id="passwordCheck" type="checkbox" name="show" value="on" unchecked>
                        <label for="passwordCheck">パスワードを表示する</label>
                    </dd>
                    <dd>
                        <input id="save" type="checkbox" name="save" value="on">
                        <label for="save">次回からは自動的にログインする</label>
                    </dd>
                    <div class="box">
                        <a href="sign_up.php">新規会員登録</a>
                    </div>
                    <dd>
                        <input type="submit" value="ログイン" disabled id="submit" class="btn-flat-border">
                    </dd>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/password.js"></script>
    <script>

        // 入力欄チェック

        // DOM
        const password = document.getElementById('password');
        const user_id = document.getElementById('user_id');
        const submit = document.getElementById('submit');

        function text_chk($str){
            $str.addEventListener('keyup', () => {
                if (password.value != '' && user_id.value != '' && password.value.length >= 4) {
                    submit.disabled = false;
                }else {
                    submit.disabled = true;
                }
            });
        }

        text_chk(password);
        text_chk(user_id);

        const lab_ani = document.getElementsByClassName('lab_ani');
        const input_text = document.getElementsByClassName('enable_ck');

        function enable_text($str) {    
            input_text[$str].addEventListener('input', () => {
                if (input_text[$str].value != '') {
                    lab_ani[$str].classList.add('enable_lab_ani');
                } else {
                    lab_ani[$str].classList.remove('enable_lab_ani');
                }
            })
        }

        enable_text(0);
        enable_text(1);


    </script>
</body>
</html>