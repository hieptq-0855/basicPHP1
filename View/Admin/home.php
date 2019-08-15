<?php
    require('../../Middleware/checkAdmin.php');
    use Database\Database;
    require('../../Database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="../../Public/style.css">
</head>
<body>
    <br>
    <h1 class="text-center">Xin chào Admin: <?php echo $_SESSION['user_name'] ?></h1>
    <br>
    <div class="flex-justify-center">
        <div class="user-information-style">
            <h3 class="text-center">Thông tin cá nhân</h3>
            <?php
                if (isset($_SESSION['user_id'])) {
                    $db = new Database();
                    $result = $db->getInfo($_SESSION['user_id']);
                    if ($result) { ?>
                        <p>Họ và tên: <?php echo $result['full_name'] ?></p>
                        <p>Địa chỉ: <?php
                            if ($result['address']) {
                                echo $result['address'];
                            } else {
                                echo "Chưa cập nhật";
                            } ?>
                        </p>
                        <p>Ngày sinh: <?php echo $result['birth'] ?></p>
            <?php
                    }
                }
            ?>

        </div>
    </div>

</body>
</html>
