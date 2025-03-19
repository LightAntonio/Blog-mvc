<?php
// Arquivo: middlewares/AuthMiddleware.php

session_start();

class AuthMiddleware {
    public static function verificarAutenticacao() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /login.php");
            exit();
        }
    }
}
?>
