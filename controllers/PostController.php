<?php
// Gerencia lógica dos posts
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
