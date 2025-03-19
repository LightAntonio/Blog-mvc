<?php
require_once '../../controllers/CategoriaController.php';

$id = $_GET['id'] ?? null;
$categoria = CategoriaModel::buscarPorId($id);

if (!$categoria) {
    echo "<p>Categoria não encontrada!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CategoriaController::atualizar();
}
?>

<h2>Editar Categoria</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
    
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $categoria['nome'] ?>" required>
    
    <label>Descrição:</label>
    <textarea name="descricao"><?= $categoria['descricao'] ?></textarea>
    
    <button type="submit">Salvar</button>
</form>
<a href="admin.php?pagina=categorias">Voltar</a>
