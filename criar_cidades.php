<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $id_estado = $_POST['id_estado'];
    $sql = "INSERT INTO cidades (nome, id_estado) VALUES ('$nome', '$id_estado')";
    $conn->query($sql);
    header('Location: index.php');
}
?>

<link rel="stylesheet" href="style.css">