<?php
//Cabeçalho do blog
require_once 'models/CategoriaModel.php'; ?>
<nav>
    <ul>
        <li><a href="index.php">Início</a></li>
        <?php foreach (CategoriaModel::listar() as $categoria) : ?>
            <li><a href="index.php?categoria=<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
