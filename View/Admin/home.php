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
</head>
<body>
    <br>
    <h1 style="text-align: center;">Xin chào Admin: <?php echo $_COOKIE['user_name'] ?></h1>
    <br>
    <div style="display: flex; justify-content: center;">
        <div style="border: 1px solid black; width: 40%; padding-left: 40px; padding-bottom: 20px; padding-right: 20px;">
            <h3 style="text-align: center;">Thông tin cá nhân</h3>
            <?php
                if (isset($_COOKIE['user_id'])) {
                    $db = new Database();
                    $result = $db->getInfo($_COOKIE['user_id']);
                    if ($result != false) { ?>
                        <p>Họ và tên: <?php echo $result['full_name'] ?></p>
                        <p>Địa chỉ: <?php
                            if ($result['address'] != null) {
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