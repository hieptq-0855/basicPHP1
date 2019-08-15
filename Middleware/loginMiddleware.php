<?php
session_start();
use http\Header;

if (isset($_SESSION['user_id'])) {
    Header('Location: ../index.php');
}
