<?php

require("connect.php");

// Получить данные отправленные формой
$login = $_POST["Login"];
$password = $_POST["Password"];
$name = $_POST["Name"];
$surname = $_POST["Surname"];
$patronymic = $_POST["Patronymic"];

// Выбрать данные пользователя по условию совпадения логина и пароля
$connect->query("INSERT INTO `account`(`role`, `name`, `surname`, `patronymic`,`login`, `password`)
                           VALUES ('other', '$name', '$surname', '$patronymic', '$login', '$password')");

$result = $connect->query("SELECT `id`, `role`, `name`, `surname`, `patronymic` 
                           FROM `account` WHERE `login`='$login' AND `password`='$password'");

$account = $result->fetch_assoc();
if (!$account) {
    echo $connect->error;
    return;
}

$id = $account["id"];
$hash = sha1(date(DATE_ATOM));
$result = $connect->query("INSERT INTO `session` (`hash`, `account`, `start`, `end`) VALUES ('$hash', '$id', current_timestamp, now()+interval 7 day)");
if (!$result || $connect->errno != 0) {
    echo $connect->error;
    return;
}

setcookie("session", $hash, time()+3600);

header("Location: /index.php", TRUE, 301);

?>
