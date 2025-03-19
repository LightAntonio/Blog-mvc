<?php
// Página de Gerenciamento de Posts

require_once '../middlewares/AdminMiddleware.php';
AdminMiddleware::verificarAdmin(); // 🔒 Protege a página

require_once '../../models/PostModel.php'; // Modelo dos posts

$posts = PostModel::listarTodos(); // Busca todos os posts
?>

<h2>Gerenciar Posts</h2>
<a href="admin.php?pagina=criar_post">+ Criar Novo Post</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Imagem</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($posts as $post) : ?>
        <tr>
            <td><?= $post['id'] ?></td>
            <td>
                <?php if ($post['imagem']) : ?>
                    <img src="../../public/<?= $post['imagem'] ?>" width="50">
                <?php endif; ?>
            </td>
            <td><?= $post['titulo'] ?></td>
            <td><?= $post['autor'] ?></td>
            <td><?= date('d/m/Y', strtotime($post['data_criacao'])) ?></td>
            <td>
                <a href="admin.php?pagina=editar_post&id=<?= $post['id'] ?>">Editar</a> |
                <a href="admin.php?pagina=excluir_post&id=<?= $post['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

