<?php

    $connect = new mysqli("localhost", "root", "", "mydb");
    if ($connect->connect_errno != 0) {
        die($connect->connect_error);
    }

?>