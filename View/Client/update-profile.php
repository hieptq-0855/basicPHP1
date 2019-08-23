<?php
require('../../Middleware/checkClient.php');
use Database\Database;
require('../../Database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin</title>

    <link rel="stylesheet" href="../../Public/CSS/style.css">
</head>
<body class="flex-justify-center">
    <div class="width-50">
        <br>
        <h1 class="text-center">Cập nhật thông tin cá nhân</h1>
        <br>
        <?php
        if (isset($_SESSION['errors'])) {
            ?>
            <div class="flex-justify-center">
                <div class="error-alert width-60">
                    <?php
                    foreach ($_SESSION['errors'] as $error) {
                        ?>
                        <p><?php echo $error; ?></p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <br>
            <?php
        }
        unset($_SESSION['errors']);
        ?>
        <?php
            $db = new Database();
            $user = $db->findInfoUser($_SESSION['user_id']);
            if ($user) {
        ?>
                <form action="../../index.php?controller=Controller&function=doUserUpdateProfile" method="post"
                      class="user-update-form">
                    <div class="flex-justify-center">
                        <div class="user-information-style user-update-style">
                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                            <label>Họ và tên</label>
                            <input type="text" value="<?php echo $user['full_name']; ?>" name="full_name"
                                maxlength="50" required>
                            <br>
                            <label>Địa chỉ</label>
                            <input type="text" value="<?php echo $user['address']; ?>" name="address" maxlength="100">
                            <br>
                            <label>Ngày sinh</label>
                            <input type="date" value="<?php echo $user['birth']; ?>" name="birth" required>
                        </div>
                    </div>
                    <br>
                    <div class="flex-justify-center">
                        <input type="submit" name="submit" value="Cập nhật">
                        &nbsp;
                        <a href="../../index.php"><button>Quay lại</button></a>
                    </div>
                </form>
        <?php
            }
        ?>
    </div>
</body>
</html>
