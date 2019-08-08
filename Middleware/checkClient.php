<?php
if (isset($_COOKIE['user_role'])) {
    if ($_COOKIE['user_role'] != 1) {
        Header('Location: ../../index.php');
    }
}