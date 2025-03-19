<?php 
// Lida com categorias

require_once 'models/CategoriaModel.php';

class CategoriaController {
    public static function listar() {
        return CategoriaModel::listar();
    }

    public static function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];

            if (CategoriaModel::criar($nome, $descricao)) {
                header("Location: admin.php?pagina=categorias");
                exit;
            } else {
                echo "Erro ao criar categoria!";
            }
        }
    }

    public static function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];

            if (CategoriaModel::atualizar($id, $nome, $descricao)) {
                header("Location: admin.php?pagina=categorias");
                exit;
            } else {
                echo "Erro ao atualizar categoria!";
            }
        }
    }

    public static function excluir() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            CategoriaModel::excluir($id);
            header("Location: admin.php?pagina=categorias");
            exit;
        }
    }
}
