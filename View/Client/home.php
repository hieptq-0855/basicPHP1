<?php
    require('../../Middleware/checkClient.php');
    use Database\Database;
    require('../../Database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="../../Public/CSS/style.css">
</head>
<body class="flex-justify-center">
    <div class="width-50">
        <br>
        <h1 class="text-center">Xin chào: <?php echo $_SESSION['user_name'] ?></h1>
        <?php
            require_once('../Layout/show-information.php');
        ?>
        <br>
        <div class="flex-justify-center">
            <a href="../../index.php?controller=Controller&function=doLogout"><button>Đăng xuất</button></a>
        </div>
    </div>
</body>
</html>
