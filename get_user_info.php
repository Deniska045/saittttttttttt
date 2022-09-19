<?php

function getUserInfo()
{
    $connect = new mysqli("localhost", "root", "", "mydb");
    if ($connect->connect_errno != 0) {
        die($connect->connect_error);
    }

    $hashSession = $_COOKIE["session"];
    if (!$hashSession) return null;

    $result = $connect->query("SELECT `id`, `role`, `name` FROM `account` AS a
                            INNER JOIN `session` AS s
                            ON a.`id`=s.`account`
                            WHERE s.`hash`='$hashSession' AND s.`end`>now()");
    if (!$result) {
        echo $connect->error;
        return;
    }

    if ($result->num_rows == 0) {
        $result = $connect->query("UPDATE `session` SET `end`=now() WHERE `hash`='$hashSession'");
        if (!$result) {
            echo $connect->error;
            return;
        }

        setcookie("session", "", 0);

        header("Location: /index.php", TRUE, 301);
        return;
    }

    $user = $result->fetch_assoc();
    if (!$user) {
        echo $connect->error;
        return;
    }

    return $user;
}
