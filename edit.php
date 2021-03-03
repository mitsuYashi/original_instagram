<?php

require('./resource/db_connect.php');
require('./resource/functions.php');

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./join/login.php');
    exit();
}

$sql = 'SELECT picture_path, member_id, discription, filter FROM posts WHERE id=?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1,$_REQUEST['id']);
$stmt->execute();
$result = $stmt->fetch();

if ($result['member_id'] != $_SESSION['id']) {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {

    $_SESSION['post'] = $_POST;
    $_SESSION['post']['id'] = $_REQUEST['id'];

    header('Location: ./api/auth/img_edit.php');
    exit();

}

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

        <main class="edit">

            <div id="h_100"></div>

            <div class="post_img detail_img">
                <div class="img">
                    <div class="img_pic"><img id="tar_img" src="images/picture/<?php echo $result['picture_path'] ?>" alt="<?php echo $result['picture_path'] ?>" class="<?= $result['filter']  ?>"></div>
                </div>
            </div>

            <form action="" method="post">
                <div id="select_filter">
                    <label class="pos_ab discri">説明文</label>
                    <textarea rows="10" cols="50" class="pos_ab" placeholder="ここに説明文を入力してください" autofocus name="discription"><?php echo $result['discription'] ?></textarea>
                    <span class="pos_ab">フィルター</span>
                    <select name="filter">
                        <option value="null" <?= $result['filter'] == null ? 'selected' : '' ?>>--選択なし--</option>
                        <option value="sepia" <?= $result['filter'] == 'sepia' ? 'selected' : '' ?>>sepia</option>
                        <option value="brightness" <?= $result['filter'] == 'brightness' ? 'selected' : '' ?>>brightness</option>
                        <option value="contrast" <?= $result['filter'] == 'contrast' ? 'selected' : '' ?>>contrast</option>
                        <option value="blur" <?= $result['filter'] == 'blur' ? 'selected' : '' ?>>blur</option>
                        <option value="grayscale" <?= $result['filter'] == 'grayscale' ? 'selected' : '' ?>>grayscale</option>
                        <option value="hue-rotate" <?= $result['filter'] == 'hue-rotate' ? 'selected' : '' ?>>hue-rotate</option>
                        <option value="invert" <?= $result['filter'] == 'invert' ? 'selected' : ''; ?>>invert</option>
                    </select>
                    <input type="submit" value="投稿">
                </div>
            </form>

            <a class="post_remove" href="./api/auth/post_remove.php?id=<?php echo $_REQUEST['id'] ?>">削除</a>

        </main>

        <?php include('include/footer.html'); ?>
    </div>
        
    <script src="js/edit.js"></script>

</body>
</html>