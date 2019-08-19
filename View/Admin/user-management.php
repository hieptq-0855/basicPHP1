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
                <?php
                    $db = new Database();
                    $users = $db->getUserInformationList();
                    $stt = 1;
                    foreach ($users as $user) {
                ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $user['full_name']; ?></td>
                            <td>
                                <?php
                                    if ($user['address']) {
                                        echo $user['address'];
                                    } else {
                                        echo "Chưa cập nhật";
                                    }
                                ?>
                            </td>
                            <td><?php echo $user['birth']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td>
                                <a href="../../index.php?controller=ViewController&function=returnUpdateUser&id=<?php echo $user['id'] ?>">
                                    <button class="option-button">Sửa</button>
                                </a>
                                <button class="option-button" id="deleteButton" value="<?php echo $user['id'] ?>">Xóa</button>
                            </td>
                        </tr>
                <?php
                        $stt ++;
                    }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
