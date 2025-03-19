<?php
require_once '../middlewares/AdminMiddleware.php';
AdminMiddleware::verificarAdmin();

require_once '../../models/PostModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $autor = $_SESSION['usuario'];
    
    // Processar upload da imagem
    $imagem = null;
    if (!empty($_FILES['imagem']['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nomeImagem = uniqid() . '.' . $extensao;
        $caminhoImagem = '../../public/uploads/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = 'uploads/' . $nomeImagem;
        }
    }

    if (PostModel::criar($titulo, $conteudo, $autor, $imagem)) {
        echo "<p>Post criado com sucesso!</p>";
    } else {
        echo "<p>Erro ao criar post.</p>";
    }
}
?>

<h2>Criar Novo Post</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" required>
    
    <label>Conteúdo:</label>
    <textarea name="conteudo" required></textarea>
    
    <label>Imagem:</label>
    <input type="file" name="imagem">
    
    <button type="submit">Salvar</button>
</form>
<a href="admin.php?pagina=posts">Voltar</a>
