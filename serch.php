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

    <?php include('include/header.php'); ?>
    <div id="wrap">

        <main class="serch">

            <div id="h_100"></div>

            <form action="serch.php" method="post">
                <input type="text" name="serch" placeholder="">
                <input type="submit" value="検索">
            </form>

            <a href="your_profile.php" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/icon.png">
                    <div class="flex">
                        <span>名前</span>
                        <span>@userID</span>
                    </div>
                </div>
            </a>

            <a href="your_profile.php" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/icon.png">
                    <div class="flex">
                        <span>名前</span>
                        <span>@userID</span>
                    </div>
                </div>
            </a>

            <a href="your_profile.php" class="prf">
                <div class="prf_img cir">
                    <img src="images/visual_picture/icon.png">
                    <div class="flex">
                        <span>名前</span>
                        <span>@userID</span>
                    </div>
                </div>
            </a>

            <div class="gg_box">
                <a href="picture.php"><img src="images/picture/g-01.jpg" alt=""></a>
                <a href="picture.php"><img src="images/picture/g-02.jpg" alt=""></a>
                <a href="picture.php"><img src="images/picture/g-03.jpg" alt=""></a>
                <a href="picture.php"><img src="images/picture/g-04.jpg" alt=""></a>
                <a href="picture.php"><img src="images/picture/g-01.jpg" alt=""></a>
                <a href="picture.php"><img src="images/picture/g-02.jpg" alt=""></a>
            
        </main>

        <?php include('include/footer.html'); ?>
    </div>
        

    
    <script src="js/serch_request.js"></script>
</body>
</html>