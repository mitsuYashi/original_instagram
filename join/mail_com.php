<?php
App::uses('CakeEmail', 'Network/Email');
$content = array('url' => $url);
$email = new CakeEmail();
$email->from('reonroen@gmail.com')
     ->to($post_email)
     ->template('text_email')//テンプレートファイル名指定
     ->viewVars($content)//text_email.ctp内の$url変数はコントローラ内のviewVarsメソッドで渡した値を利用
     ->subject('パスワード再設定')
     ->send();//メール送信
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>

    <link rel="stylesheet" role="text/css" href="../css/reset.css">
    <link rel="stylesheet" role="text/css" href="../css/join.css">
</head>
<body id="login">
    
    <div id="wrapper">
        <div id="wrap">
            <h1>パスワード再設定</h1>
                <p>メールが送信されました</p>
        </div>
    </div>

</body>
</html>