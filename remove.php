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
    <title>Instagram</title>
    <link rel="stylesheet" role="text/css" href="css/reset.css">
    <link rel="stylesheet" role="text/css" href="css/main.css">

</head>
<body>

    <?php include('include/header.html'); ?>
    <div id="wrap">

        <main id="remove">

            <div id="h_100"></div>

            <p>このアカウントを消去しますか?<br>
                消去する場合このアカウントでは2度とログインすることができなくなります。
            </p>

            <div class="flex selecter">
                <a href="plofile_chg.php"><button>いいえ</button></a>
                <a href="join/login.php"><button>はい</button></a>
            </div>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    
    <script src="js/main.js"></script>
</body>
</html>