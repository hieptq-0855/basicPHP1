<?php
session_start();
if (isset($_SESSION['user_role'])) {
    if ((int) $_SESSION['user_role'] !== 1) {
        header('Location: ../../index.php');
    }
}
