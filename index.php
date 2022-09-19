<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>

    <?php

    $hashSession = $_COOKIE["session"];
    if (!$hashSession) {
        include("sign-in-form.php");
    } else {
        include("get_user_info.php");
    ?>
        <h3>Привет, <?php echo $user["name"]; ?></h3>

        <form action="logout.php" method="POST">
            <input type="submit" value="выйти">
        </form>

        <?php include("product/select.php"); ?>

        <form enctype="multipart/form-data" action="product/add.php" method="POST" class="add-form">
            <input type="text" name="Name" placeholder="Наименование">
            <input type="text" name="Desc" placeholder="Описание">
            <input type="number" name="Price" placeholder="Цена">
            <input type="number" name="Count" placeholder="Количество">
            <input type="file" name="Image" placeholder="Изображение">
            <input type="submit" value="Добавить"/>
        </form>
    <?php

    }
    ?>

    <script src="assets/js/script.js"></script>

</body>

</html>