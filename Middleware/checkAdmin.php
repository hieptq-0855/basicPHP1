<?php
if (isset($_COOKIE['user_role'])) {
    if ($_COOKIE['user_role'] != 2) {
        Header('Location: ../../index.php');
    }
}
