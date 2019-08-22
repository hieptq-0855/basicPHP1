<?php
    require('../../Middleware/checkAdmin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="../../Public/CSS/style.css">
</head>
<body>
    <div class="flex-justify-center">
        <div class="width-50">
            <?php
                require_once('../Layout/menu.php');
            ?>
            <br>
            <h1 class="text-center">Xin chào Admin: <?php echo $_SESSION['user_name'] ?></h1>
            <?php
                require_once('../Layout/show-information.php');
            ?>
        </div>
    </div>
</body>
</html>
