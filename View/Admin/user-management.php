<?php
    require('../../Middleware/checkAdmin.php');
    use Database\Database;
    require('../../Database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>

    <link rel="stylesheet" href="../../Public/style.css">
</head>
<body>
<div class="flex-justify-center">
    <div class="width-50">
        <?php
        require_once('../Layout/menu.php');
        ?>
        <br>
        <h1 class="text-center">Danh sách người dùng</h1>
        <div>
            <table id="user-table">
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Địa chỉ</th>
                    <th>Ngày sinh</th>
                    <th>Tên đăng nhập</th>
                    <th>Tùy chọn</th>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
