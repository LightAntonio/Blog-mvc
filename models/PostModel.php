<?php
require_once '../config/database.php';

class PostModel {
    public static function listarTodos() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM posts ORDER BY data_criacao DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($titulo, $conteudo, $autor, $imagem) {
        $conn = Database::conectar();
        $sql = "INSERT INTO posts (titulo, conteudo, autor, imagem, data_criacao) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$titulo, $conteudo, $autor, $imagem]);
    }

    public static function atualizar($id, $titulo, $conteudo, $imagem = null) {
        $conn = Database::conectar();
        if ($imagem) {
            $sql = "UPDATE posts SET titulo = ?, conteudo = ?, imagem = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$titulo, $conteudo, $imagem, $id]);
        } else {
            $sql = "UPDATE posts SET titulo = ?, conteudo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$titulo, $conteudo, $id]);
        }
    }

    public static function excluir($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
