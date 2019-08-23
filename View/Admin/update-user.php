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

    <link rel="stylesheet" href="../../Public/CSS/style.css">
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
            <div class="flex-justify-center">
                <div class="update-form-container">
                    <?php
                        $db = new Database();
                        $user = $db->findUser($_GET['id']);
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
