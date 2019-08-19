<?php
require('../../Middleware/checkAdmin.php');
use Database\Database;
require('../../Database/database.php');

if (!isset($_GET['id'])) {
    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật người dùng</title>

    <link rel="stylesheet" href="../../Public/style.css">
</head>
<body>
<div class="flex-justify-center">
    <div class="width-50">
        <?php
            require_once('../Layout/menu.php');
        ?>
        <br>
        <h1 class="text-center">Cập nhật người dùng</h1>
        <br>
        <div class="flex-justify-center">
            <div class="update-form-container">
                <?php
                    $db = new Database();
                    $user = $db->findUser($_GET['id']);
                    if ($user) {
                ?>
                        <form action="../../index.php?controller=Controller&function=doUpdateUser" method="POST">
                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                            <lable>Họ và tên</lable>
                            <input type="text" value="<?php echo $user['full_name']; ?>" name="full_name" required>
                            <lable>Địa chỉ</lable>
                            <input type="text" value="<?php echo $user['address']; ?>" name="address" required>
                            <lable>Ngày sinh</lable>
                            <input type="date" value="<?php echo $user['birth']; ?>" name="birth" required>
                            <input type="submit" name="submit" value="Cập nhật">
                        </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
