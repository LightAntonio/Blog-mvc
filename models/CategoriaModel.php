<?php
//Gerencia categorias
<?php
require_once 'config/database.php';

class CategoriaModel {
    public static function listar() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM categorias ORDER BY nome ASC";
        return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function criar($nome, $descricao) {
        $conn = Database::conectar();
        $sql = "INSERT INTO categorias (nome, descricao) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$nome, $descricao]);
    }

    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM categorias WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizar($id, $nome, $descricao) {
        $conn = Database::conectar();
        $sql = "UPDATE categorias SET nome = ?, descricao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$nome, $descricao, $id]);
    }

    public static function excluir($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM categorias WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>