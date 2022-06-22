<?php
$path_big = IMG_BIG . $_FILES["image"]["name"];
$path_small = IMG_SMALL . $_FILES["image"]["name"];


// Проверка расширения файлов

$imageinfo = getimagesize($_FILES['image']['tmp_name']);

if ($imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg'){
    echo "Неверное содержание файла, можно загружать только jpg-файлы";
    exit;
}

// Проверка на размер файла


if ($_FILES["image"]["size"] > 1024 * 5 * 1024){
    echo("Размер файла не более 5 мб");
    exit;
}

// Проверка расширения файла


$blacklist = [".php", ".phtml", ".php3", ".php4"];
foreach ($blacklist as $item) {
    if (preg_match("/$item\$/i", $_FILES['image']['name'])){
        echo "Загрузка php-файлов заперщена!";
        exit;
    }
}


if (move_uploaded_file($_FILES["image"]["tmp_name"], $path_big)) {

    $filename = mysqli_real_escape_string($db, $_FILES['image']['name']);
    mysqli_query($db, "INSERT INTO `img`(`filename`) VALUES ('$filename')");

    $image = new SimpleImage();
    $image->load($path_big);
    $image->resizeToWidth(150);
    $image->save($path_small);
    header("Location: /");
};