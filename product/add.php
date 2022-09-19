<?php

$name = $_POST["Name"];
$desc = $_POST["Desc"];
$price = $_POST["Price"];
$count = $_POST["Count"];
$image = $_FILES["Image"];

if (!isset($name) || !isset($desc) || !isset($price) || !isset($count) || !isset($image) || !isset($image)) {
    echo "400 Bad request";
    return;
}
if (strlen($name) == 0 || strlen($desc) == 0 || $price == 0 || $count == 0) {
    echo "Не все поля заполнены";
    return;
}

require_once("../connect.php");

$imageName = $image['name'];
$uploadFile = "../image/" . basename($imageName);
if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
    $imageName = null;
}
$result = $connect->query("INSERT INTO `product`(`name`, `description`, `price`, `count`, `image`) 
                            VALUES('$name','$desc',$price,$count,'$imageName')");
if (!$result) {
    echo $connect->error;
    return;
}

header("Location: /index.php", TRUE, 301);