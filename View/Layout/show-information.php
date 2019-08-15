<br>
<div class="flex-justify-center">
    <div class="user-information-style">
        <h3 class="text-center">Thông tin cá nhân</h3>
        <?php
            use Database\Database;
            if (isset($_SESSION['user_id'])) {
                $db = new Database();
                $result = $db->getInfo($_SESSION['user_id']);
                if ($result) {
        ?>
                <p>Họ và tên: <?php echo $result['full_name'] ?></p>
                <p>Địa chỉ:
                    <?php
                        if ($result['address']) {
                            echo $result['address'];
                        } else {
                            echo "Chưa cập nhật";
                        }
                    ?>
                </p>
                <p>Ngày sinh: <?php echo $result['birth'] ?></p>
        <?php
                }
            }
        ?>
    </div>
</div>
