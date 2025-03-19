<?php
// Página de Gerenciamento de Categorias
require_once '../../controllers/CategoriaController.php';

$categorias = CategoriaController::listar();
?>

<h2>Gerenciar Categorias</h2>

<a href="admin.php?pagina=criar_categoria">+ Nova Categoria</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($categorias as $categoria) : ?>
        <tr>
            <td><?= $categoria['id'] ?></td>
            <td><?= $categoria['nome'] ?></td>
            <td><?= $categoria['descricao'] ?></td>
            <td>
                <a href="admin.php?pagina=editar_categoria&id=<?= $categoria['id'] ?>">Editar</a> |
                <a href="admin.php?pagina=excluir_categoria&id=<?= $categoria['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
