<?php

$header_sql = 'SELECT icon_path FROM members WHERE id = ?';
$header_stmt = $db->prepare($header_sql);
$header_stmt->bindParam(1, $_SESSION['id']);
$header_stmt->execute();
$header_user = $header_stmt->fetch();

?>
<header>
    <div id="stick">
        <nav>
            <h1><a href="index.php">INSTAtata</a></h1>
            <ul>
                <li><a href="index.php"><img src="images/icon/home.png"></a></li>
                <li><a href="post.php"><img src="images/icon/post.png"></a></li>
                <li><a href="notice.php"><img src="images/icon/notice.png"></a></li>
                <li><a href="help.php"><img src="images/icon/help.png"></a></li>
                <li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><img src="images/visual_picture/<?= hsc($header_user['icon_path']) ?>" alt="<?= hsc($header_user['icon_path']) ?>"></a></li>
            </ul>
        </nav>
    </div>
</header>