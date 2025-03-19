<?php
require_once '../views/admin/layout/header.php';
require_once '../views/admin/layout/sidebar.php';
?>

<h2>Painel de Administração</h2>
<p>Bem-vindo, admin! Aqui você pode gerenciar o conteúdo do blog.</p>

<ul>
    <li><a href="admin.php?pagina=posts">Gerenciar Posts</a></li>
    <li><a href="admin.php?pagina=usuarios">Gerenciar Usuários</a></li>
    <li><a href="admin.php?pagina=comentarios">Moderar Comentários</a></li>
    <li><a href="admin.php?pagina=categorias">Gerenciar Categorias</a></li>
    <li><a href="admin.php?pagina=config">Configurações</a></li>
</ul>

<?php require_once '../views/admin/layout/footer.php'; ?>
