<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sql = "UPDATE cidades SET nome='$nome' WHERE id_cidade=$id";
    $conn->query($sql);
    header('Location: index.php');
}
?>

<form action="inserir_cidades.php" method="POST">
    <input type="number" name="id" placeholder="ID da Cidade" required>
    <input type="text" name="nome" placeholder="Novo Nome">
    <button type="submit">Atualizar Cidade</button>
</form>

<link rel="stylesheet" href="style.css">
