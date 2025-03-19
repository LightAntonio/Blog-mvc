<?php
session_start();

class AdminMiddleware {
    public static function verificarAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['role'] !== 'admin') {
            header("Location: /erro403.php");
            exit();
        }
    }
}
?>
