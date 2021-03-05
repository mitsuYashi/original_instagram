<?php
require('./resource/db_connect.php');
require('./resource/functions.php');
session_start();
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

        <main id="help">

            <div id="h_100"></div>

            <h1>help</h2>
            <div class="menu">
                
                <label for="menu_bar02">本サイトについて</label>
                <input type="checkbox" id="menu_bar02" class="accordion" />
                <ul id="links02">
                    <li>本サイトは写真の共有、ダウンロードを目的としたサイトです</li>
                    <li>無断転載など、著作権に反することを厳禁とします</li>
                    <li>ただし、投稿者や著作者の許諾がある場合許可されます</li>
                    <li>公序良俗に反する利用はお止めください</li>
                </ul>
                <label for="menu_bar01">投稿について</label>
                <input type="checkbox" id="menu_bar01" class="accordion" />
                <ul id="links01">
                    <li>拡張子がjpg,png,gif,webpの画像のみ投稿ができます</li>
                    <li>画像にはフィルターを全7種から選択することが可能です</li>
                    <li>投稿は自由にダウンロード、コメントをすることができます</li>
                    <li>ダウンロード、コメントは匿名です</li>
                </ul>
                </ul>
            </div>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>