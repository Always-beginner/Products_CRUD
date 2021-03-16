<?php
$title = $_POST['title'];
$desc = $_POST['desc'];
$img = $_FILES['image'];
$price = $_POST['price'];


if (!$title) {
    $error[] = 'Product title is required ';
}
if (!$desc) {
    $error[] = 'Product Description is required ';
}
if (!$price) {
    $error[] = 'Product Price is required ';
}

if (!is_dir(__DIR__ . '/public/images')) {
    mkdir(__DIR__ . '/public/images');
}

if ($img && $img['tmp_name']) {
    $imgPath =  'images/' . randStr(8) . '/' . $img['name'];
    mkdir(dirname(__DIR__ . '/public/'  . $imgPath));
    move_uploaded_file($img['tmp_name'], __DIR__ . '/public/' . $imgPath);
} else {
    $imgPath =  $products['image'];
    // echo $products['image'];
}
