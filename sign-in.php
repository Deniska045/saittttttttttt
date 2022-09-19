<?php

require("connect.php");

// Получить данные отправленные формой
$login = $_POST["Login"];
$password = $_POST["Password"];

// Выбрать данные пользователя по условию совпадения логина и пароля
$result = $connect->query("SELECT `id`, `role`, `name`, `surname`, `patronymic` 
                           FROM `account` WHERE `login`='$login' AND `password`='$password'");

// Проверить, что результат выбора вернул строку(-и)
if ($result->num_rows == 0) {
    echo "нет данных";
    return;
}

// Вытащить данные результата запроса в виде ассоциативного массива
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
