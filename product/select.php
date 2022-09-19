<?php

require_once("connect.php");

$result = $connect->query("SELECT `name`, `description`, `price`, `count`, `image` FROM `product` ORDER BY `name`");
if (!$result) {
    echo "Нет данных";
    return;
}

if ($result->num_rows > 0) {
?>
    <table class="products">
        <tr>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Изображение</th>
        </tr>
        <?php
        while ($data = $result->fetch_assoc()) {
        ?><tr>
                <td><?php echo $data["name"]; ?> </td>
                <td><?php echo $data["description"]; ?> </td>
                <td><?php echo $data["price"]; ?> </td>
                <td><?php echo $data["count"]; ?> </td>
                <td style="width:260px"><img src="../image/<?php echo $data["image"]; ?>" /></td>
            </tr><?php
                }
                    ?>
    </table><?php
        }

    "SELECT b.`id_product`, t.`name`, t.`price`, t.`info` FROM `basket` b
    INNER JOIN `tru` t ON b.`id_product` = t.`id`
     WHERE `id_user`=$id_user"