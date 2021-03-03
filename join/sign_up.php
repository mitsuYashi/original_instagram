<?php

ini_set('display_errors', 0);
require('../resource/db_connect.php');

session_start();

if (!empty($_POST)) {

    $member_mail = $db->prepare('SELECT COUNT(*) cnt FROM members WHERE mail = ?');
    $member_mail->bindParam(1,$_POST['mail']);
    $member_mail->execute();
    $record = $member_mail->fetch();

    $member_userid = $db->prepare('SELECT COUNT(*) cnt FROM members WHERE user_id = ?');
    $member_userid->bindParam(1,$_POST['user_id']);
    $member_userid->execute();
    $re = $member_userid->fetch();

    if ($record['cnt'] > 0) {
        $error['mail'] = 'duplicate';
    }

    if ($re['cnt'] > 0) {
        $error['user_id'] = 'duplicate';
    }
}

if (empty($error)) {
    if (!empty($_POST)) {
        if ($_POST['password'] == $_POST['password_ck']) {
            $_SESSION['join'] = $_POST;
        
            header('Location: sign_up_ck.php');
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
    <title>会員登録</title>

    <link rel="stylesheet" role="text/css" href="../css/reset.css">
    <link rel="stylesheet" role="text/css" href="../css/join.css">
</head>
<body id="sign_up">
    
    <div id="wrapper">
        <div id="wrap">
            <h1>会員登録</h1>
            <div id="formBox">
                <form action="" method="POST">
                    <dd class="inputBox">
                        <label>メールアドレス</label>
                        <input type="email" size="35" name="mail" id="mail">
                    </dd>
                    <p class="error <?php if ($error['mail'] != 'duplicate') { echo 'hidden_text';} ?>">※このメールアドレスはすでに登録済みです</p>
                    <dd class="inputBox">
                        <label>ユーザーID</label>
                        <input type="text" pattern="^[0-9A-Za-z]+$" size="35" name="user_id" maxlength="15" id="user_id">
                    </dd>
                    <p class="error pos_ab <?php if ($error['user_id'] != 'duplicate') { echo 'hidden_text';} ?>">※このIDは使用済みです</p>
                    <p class="error">※半角英数字のみ</p>
                    <dd class="inputBox">
                        <label>名前</label>
                        <input type="text" size="35" name="name" maxlength="30" id="name">
                    </dd>
                    <p class="error hidden_text"></p>
                    <dd class="inputBox">
                        <label>パスワード</label>
                        <input type="password" size="35" name="password" id="password">
                    </dd>
                    <p class="error">※パスワードは4文字以上にしてください</p>
                    <dd class="inputBox">
                        <label>パスワード確認用</label>
                        <input type="password" size="35" name="password_ck" id="chk_password">
                    </dd>
                    <p class="error hidden_text" id="not_pass">※パスワードが違います</p>
                    <dd>
                        <input type="submit" value="登録" id="submit" disabled class="btn-flat-border">
                    </dd>
                </form>
            </div>
        </div>
    </div>

    <script>
        // DOM
        const mail = document.getElementById('mail');
        const user_id = document.getElementById('user_id');
        const name = document.getElementById('name');
        const password = document.getElementById('password');
        const chk_password = document.getElementById('chk_password');
        const submit = document.getElementById('submit');
        const not_pass = document.getElementById('not_pass')

        const input_tag = [mail, user_id, name, password, chk_password];
        console.log(input_tag[0].value);

        for (let i = 0; i < 5; i++) {
            input_tag[i].addEventListener("keyup", () => {
                if (password.value == chk_password.value) {
                    not_pass.classList.add('hidden_text')

                    if (input_tag[0].value != '' && input_tag[1].value != '' && input_tag[2].value != '' && input_tag[3].value != '' && input_tag[4].value != '' && input_tag[3].value.length >= 4) {
                        submit.disabled = false;
                    }else {
                        submit.disabled = true;
                    }
                } else {
                    submit.disabled = true;
                    not_pass.classList.remove('hidden_text');
                }
            });
        }
        
    </script>
</body>
</html>