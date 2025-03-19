<?php
// Exibe lista de posts
<?php
require_once 'models/PostModel.php';
require_once 'models/CategoriaModel.php';

$categoria_id = $_GET['categoria'] ?? null;

if ($categoria_id) {
    $posts = PostModel::listarPorCategoria($categoria_id);
    $categoria = CategoriaModel::buscarPorId($categoria_id);
    echo "<h2>Posts na categoria: " . $categoria['nome'] . "</h2>";
} else {
    $posts = PostModel::listarTodos();
    echo "<h2>Todos os Posts</h2>";
}
?>

<ul>
    <?php foreach ($posts as $post) : ?>
        <li>
            <a href="index.php?pagina=ver_post&id=<?= $post['id'] ?>">
                <?= $post['titulo'] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
