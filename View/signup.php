<?php
require_once('../Middleware/loginMiddleware.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
<br>
<div class="row d-flex justify-content-center">
    <h2>Đăng ký</h2>
</div>
<br>
<?php
    if (isset($_SESSION['errors'])) {
?>
        <div class="row d-flex justify-content-center">
            <div class="error-alert">
                <?php
                    foreach($_SESSION['errors'] as $error) {
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
<div class="row d-flex justify-content-center">
    <div class="col-md-5">
        <form method="POST" action="../index.php?controller=Controller&function=doSignUp">
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="full_name" placeholder="Nhập họ tên" maxlength="50">
            </div>
            <div class="form-group">
                <label>Ngày sinh</label>
                <input type="date" class="form-control" name="birth">
            </div>
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" class="form-control" name="user_name" placeholder="Nhập tên đăng nhập" maxlength="50">
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" maxlength="50" required>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" maxlength="50" required>
            </div>
            <div class="row justify-content-center">
                <button type="submit" name="signup" class="btn btn-primary">Đăng ký</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
