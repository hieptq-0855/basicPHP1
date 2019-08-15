<?php
session_start();
if (isset($_SESSION['user_role'])) {
    if ((int) $_SESSION['user_role'] !== 2) {
        header('Location: ../../index.php');
    }
}
