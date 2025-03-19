<?php
require_once '../middlewares/AdminMiddleware.php';

AdminMiddleware::verificarAdmin(); // 🔒 Só permite admin acessar

// Definir rotas do painel
$rota = $_GET['pagina'] ?? 'dashboard';

switch ($rota) {
    case 'posts':
        require '../views/admin/posts.php';
        break;
    case 'usuarios':
        require '../views/admin/usuarios.php';
        break;
    case 'comentarios':
        require '../views/admin/comentarios.php';
        break;
    case 'categorias':
        require '../views/admin/categorias.php';
        break;
    case 'config':
        require '../views/admin/config.php';
        break;
    default:
        require '../views/admin/dashboard.php';
        break;
}
?>
