<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM cidades WHERE id_cidade=$id";
    $conn->query($sql);
    header('Location: index.php');
}
?>

<form action="excluir_cidades.php" method="POST">
    <input type="number" name="id" placeholder="ID da Cidade" required>
    <button type="submit">Excluir Cidade</button>
</form>

<link rel="stylesheet" href="style.css">