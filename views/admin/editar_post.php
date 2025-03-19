<?php
// 📌 Página para Editar Posts
<?php
require_once '../middlewares/AdminMiddleware.php';
AdminMiddleware::verificarAdmin();

require_once '../../models/PostModel.php';

$id = $_GET['id'] ?? null;
$post = PostModel::buscarPorId($id);

if (!$post) {
    echo "<p>Post não encontrado!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    
    // Processar upload da nova imagem (opcional)
    $imagem = $post['imagem'];
    if (!empty($_FILES['imagem']['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        $caminhoImagem = '../../public/uploads/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = 'uploads/' . $nomeImagem;
        }
    }

    if (PostModel::atualizar($id, $titulo, $conteudo, $imagem)) {
        echo "<p>Post atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar post.</p>";
    }
}
?>

<h2>Editar Post</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" value="<?= $post['titulo'] ?>" required>
    
    <label>Conteúdo:</label>
    <textarea name="conteudo" required><?= $post['conteudo'] ?></textarea>
    
    <label>Imagem Atual:</label>
    <?php if ($post['imagem']) : ?>
        <img src="../../public/<?= $post['imagem'] ?>" width="150">
    <?php endif; ?>
    
    <label>Nova Imagem (opcional):</label>
    <input type="file" name="imagem">
    
    <button type="submit">Salvar</button>
</form>
<a href="admin.php?pagina=posts">Voltar</a>

