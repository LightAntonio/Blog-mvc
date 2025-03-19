<?php
// Formulários de Criar e Editar Categorias
require_once '../../controllers/CategoriaController.php'; ?>
<h2>Nova Categoria</h2>

<form method="POST" action="admin.php?pagina=criar_categoria">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    
    <label>Descrição:</label>
    <textarea name="descricao"></textarea>
    
    <button type="submit">Salvar</button>
</form>
<a href="admin.php?pagina=categorias">Voltar</a>

<?php CategoriaController::criar(); ?>
