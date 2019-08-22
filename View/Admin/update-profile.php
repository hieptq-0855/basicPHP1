<?php
    require('../../Middleware/checkAdmin.php');
    use Database\Database;
    require('../../Database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thông tin cá nhân</title>

    <link rel="stylesheet" href="../../Public/CSS/style.css">
</head>
<body>
    <div class="flex-justify-center">
        <div class="width-50">
            <?php
                require_once('../Layout/menu.php');
            ?>
            <br>
            <h1 class="text-center">Cập nhật thông tin cá nhân</h1>
            <br>
            <div class="flex-justify-center">
                <div class="update-form-container">
                    <?php
                        $db = new Database();
                        $user = $db->findInfoUser($_SESSION['user_id']);
                        if ($user) {
                    ?>
                            <form action="../../index.php?controller=Controller&function=doUpdateUser" method="POST">
                                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                <label>Họ và tên</label>
                                <input type="text" value="<?php echo $user['full_name']; ?>" name="full_name"
                                       maxlength="50" required>
                                <label>Địa chỉ</label>
                                <input type="text" value="<?php echo $user['address']; ?>" name="address"
                                       maxlength="100">
                                <label>Ngày sinh</label>
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
