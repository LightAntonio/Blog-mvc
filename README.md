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
├── controllers/
│   ├── PostController.php   # Gerencia lógica dos posts
│   ├── UsuarioController.php # Gerencia lógica dos usuários
│   ├── ComentarioController.php # Lida com comentários
│   └── CategoriaController.php # Lida com categorias
├── public/
│   ├── index.php            # Ponto de entrada da aplicação
│   └── assets/
│       ├── css/             # Arquivos de estilo
│       └── js/              # Scripts JavaScript
├── routes.php                # Gerenciamento de rotas
└── .htaccess                 # Configuração de URL amigável (para Apache)
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
