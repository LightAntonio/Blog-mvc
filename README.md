# Estrutura do Projeto
blog-mvc/
├── config/
│   └── database.php       # Configuração de conexão ao banco de dados
├── models/
│   ├── PostModel.php      # Gerencia posts
│   ├── UsuarioModel.php   # Gerencia usuários
│   ├── ComentarioModel.php # Gerencia comentários
│   └── CategoriaModel.php # Gerencia categorias
├── views/
│   ├── layout/
│   │   ├── header.php      # Cabeçalho do blog
│   │   ├── footer.php      # Rodapé do blog
│   └── posts/
│       ├── listar.php      # Exibe lista de posts
│       ├── ver.php         # Exibe um post individual
│       └── criar.php       # Formulário para criar post
    └── postsCategoria/
        ├── tecnologia/
        │   ├── 2025/
        │   │   ├── janeiro/
        │   │   │   ├── post1.php
        │   │   │   ├── post2.php
        │   │   └── fevereiro/
        │   │       ├── post3.php
        ├── saude/
            ├── 2025/
        │   │   ├── janeiro/
        │   │   │   ├── post1.php
        │   │   │   ├── post2.php
        │   │   └── fevereiro/
        │   │       ├── post3.php
        ├── viagens/

    └── rascunhos/
        ├── tecnologia/
        │   ├── post-tecnologia1.txt
        │   ├── post-tecnologia2.txt
        ├── saude/
        │   ├── post-saude1.txt

├── controllers/
    ├── PostController.php   # Gerencia lógica dos posts
    ├── UsuarioController.php # Gerencia lógica dos usuários
    ├── ComentarioController.php # Lida com comentários
    └── CategoriaController.php # Lida com categorias
├── public/
    ├── index.php            # Ponto de entrada da aplicação
    └── assets/
        ├── css/             # Arquivos de estilo
        └── js/              # Scripts JavaScript
        ├── imagens/
        ├── videos/
        └── documentos/
    └── uploads /
        
├── helpers 
    ├── formataData.php            # Para formatar datas.
    └── sanitizaInput.php          #Para sanitizar entradas de usuários.
    └── slug.php                   #Para gerar slugs de URLs amigáveis.
├── routes/
    ├── web.php          # Rotas principais (páginas públicas)
    ├── api.php          # Rotas para API (caso use JSON)
    ├── admin.php        # Rotas de administração
    └── auth.php         # Rotas de autenticação (login, logout)
├── logs/
    ├── acesso.log
    ├── erro.log
    └── analytics/
├── modules/
    ├── auth/            # Gerenciar login e autenticação
    ├── post/            # Funções específicas de posts
    ├── comentario/      # Funções de comentários
    └── usuario/         # Gerenciamento de usuários

├── middlewares/
│   ├── AuthMiddleware.php   # Middleware para autenticação
│   ├── AdminMiddleware.php  # Middleware para admin (se necessário)

├── admin/
│   │   ├── dashboard.php   # Página inicial do painel
│   │   ├── posts.php       # Gerenciar posts
│   │   ├── usuarios.php    # Gerenciar usuários
│   │   ├── comentarios.php # Moderação de comentários
│   │   ├── categorias.php  # Gerenciar categorias
│   │   ├── config.php      # Configurações gerais
│   │   ├── login.php       # Tela de login do admin
│   │   ├── layout/
│   │   │   ├── header.php  # Cabeçalho do admin
│   │   │   ├── sidebar.php # Menu lateral
│   │   │   ├── footer.php  # Rodapé do admin
composer.json
.htaccess                 # Configuração de URL amigável (para Apache)

# Detalhes de Cada Componente
1. Banco de Dados
O banco pode conter as seguintes tabelas principais:
usuarios: Para autenticar e gerenciar autores/admins.
posts: Para armazenar os posts do blog.
categorias: Para classificar os posts.
comentarios: Para permitir feedback dos leitores.

2. Modelos (Models)
PostModel.php (exemplo para gerenciar posts):
class PostModel {
    private $conn;
    private $table_name = "posts";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarPosts() {
        $query = "SELECT * FROM {$this->table_name} ORDER BY data_criacao DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criarPost($titulo, $conteudo, $autor_id, $categoria_id) {
        $query = "INSERT INTO {$this->table_name} (titulo, conteudo, autor_id, categoria_id) VALUES (:titulo, :conteudo, :autor_id, :categoria_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":conteudo", $conteudo);
        $stmt->bindParam(":autor_id", $autor_id);
        $stmt->bindParam(":categoria_id", $categoria_id);
        return $stmt->execute();
    }
}
3. Controladores (Controllers)
PostController.php (exemplo para gerenciar lógica dos posts):
class PostController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function listarPosts() {
        $posts = $this->model->listarPosts();
        $this->view->exibirPosts($posts);
    }

    public function criarPost($titulo, $conteudo, $autor_id, $categoria_id) {
        if ($this->model->criarPost($titulo, $conteudo, $autor_id, $categoria_id)) {
            echo "Post criado com sucesso!";
        } else {
            echo "Erro ao criar post.";
        }
    }
}
4. Visões (Views)
posts/listar.php (exemplo para listar posts):
class PostView {
    public function exibirPosts($posts) {
        foreach ($posts as $post) {
            echo "<h2>{$post['titulo']}</h2>";
            echo "<p>{$post['conteudo']}</p>";
            echo "<small>Autor: {$post['autor_id']} | Data: {$post['data_criacao']}</small><hr>";
        }
    }
}
5. Rotas (routes.php)
Configurações de rotas simples para direcionar URLs:
$rota = $_GET['rota'] ?? 'home';
switch ($rota) {
    case 'listar':
        $controller->listarPosts();
        break;
    case 'criar':
        $controller->criarPost($_POST['titulo'], $_POST['conteudo'], $_POST['autor_id'], $_POST['categoria_id']);
        break;
    default:
        echo "Bem-vindo ao blog!";
}
6. Cache ou Otimização
Para reduzir a sobrecarga de requisições ao banco de dados, use pasta de cache para armazenar conteúdo estático gerado automaticamente
cache/posts/
├── pagina1.html
├── pagina2.html
└── categorias/
7. Arquivo de Logs e Analytics
Conforme o número de visitantes cresce, você pode implementar logs ou ferramentas de análise
logs/
├── acesso.log
├── erro.log
└── analytics/
8. Separação de Módulos
A criação de módulos separados por funcionalidade também ajuda a manter a organização
modules/
├── auth/            # Gerenciar login e autenticação
├── post/            # Funções específicas de posts
├── comentario/      # Funções de comentários
└── usuario/         # Gerenciamento de usuários
# ✅ Agora o que já temos funcionando?

✔ Upload de imagens nos posts 📸
✔ Atualização de imagem na edição de posts 🛠
✔ Exibição das imagens na listagem de posts 👀
✔ Painel Admin separado do site
✔ Rotas organizadas (admin.php)
✔ Middleware para restringir acesso
✔ Dashboard inicial com atalhos
✔ Layout básico (header, sidebar, footer)
✔ Página para listar posts 📌
✔ Botão para criar novos posts ✍
✔ Editar posts existentes 🛠
✔ Excluir posts ❌
✔ Proteção para admin 🔒
✔ CRUD de Categorias 📂
✔ Associação de Posts às Categorias 🔗
✔ Categorias na Listagem de Posts 🏷
