<?php
session_start();
if (isset($_COOKIE['tendangnhap']) && ($_COOKIE['tendangnhap'])) {
    setcookie("tendangnhap", "", time() - 30 * 24 * 60 * 60, '/');
    setcookie("matkhau", "", time() - 30 * 24 * 60 * 60, '/');
    header('Location: index.php?dangxuat=1');
}
