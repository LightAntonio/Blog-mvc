<?php
// Gerencia lógica dos posts
require_once '../middlewares/AuthMiddleware.php';

AuthMiddleware::verificarAutenticacao(); // 🔒 Bloqueia acesso se não estiver logado

class PostController {
    public function criar() {
        echo "Formulário para criar um post!";
    }
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}



?>
