<?php
include "db.php";

$id =(int)$_GET['id'];
mysqli_query($db, "UPDATE `img` SET likes=likes + 1 WHERE id = {$id}");
$result = mysqli_query($db, "SELECT * FROM `img` WHERE id = {$id}");

$message = "";
if ($result->num_rows != 0) {
    $item = mysqli_fetch_assoc($result);
} else {
    $message = "Изображения нет в Базе Данных!";
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div id="main">
    <a href="/">Главная</a>
    <div class="post_title">
        <h2>Моя галерея</h2>
    </div>
    <div class="gallery">
        <?if (empty($message)): ?>
        Просмотров:<?=$item['likes']?><br>
                <img src="/gallery_img/big/<?= $item['filename'] ?>">
        <? else: ?>
        <div style="color: red"><?=$message?></div>
        <? endif;?>
    </div>
</div>

</body>

</html>
