<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("IMG_BIG", ROOT . "/gallery_img/big/");
define("IMG_SMALL", ROOT . "/gallery_img/small/");

include "classSimpleImage.php";
include "db.php";

$result = mysqli_query($db, "select * from img ORDER BY likes DESC ");


if (isset($_POST['load'])) {
    include "upload.php";
    } else {
        echo "ERROR<br>";
    };

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
     <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
    <div id="main">
        <div class="post_title">
            <h2>Моя галерея</h2>
        </div>
        <div class="gallery">
            <?if ($result->num_rows != 0):?>
            <?php foreach ($result as $item):?>
                <a class="photo" href="/image.php?id=<?= $item['id'] ?>">
                    <img src="/gallery_img/small/<?= $item['filename'] ?>" width="150"></a>
                <?= $item['likes'] ?>
            <?php endforeach; ?>
            <? else: ?>
                Галерея пуста.
            <? endif; ?>
        </div>
        Загрузить изображения:
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" value="Загрузить" name="load">
        </form>
    </div>

</body>

</html>