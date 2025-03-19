<?php
// 📌Página para Excluir Posts
require_once '../middlewares/AdminMiddleware.php';
AdminMiddleware::verificarAdmin(); // 🔒 Protege a página

require_once '../../models/PostModel.php';

$id = $_GET['id'] ?? null;

if ($id && PostModel::excluir($id)) {
    echo "<p>Post excluído com sucesso!</p>";
} else {
    echo "<p>Erro ao excluir post.</p>";
}

echo '<a href="admin.php?pagina=posts">Voltar</a>';
?>
