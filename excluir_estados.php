<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM estados WHERE id_estado=$id";
    $conn->query($sql);
    header('Location: index.php');
}
?>

<form action="excluir_estados.php" method="POST">
    <input type="number" name="id" placeholder="ID do Estado" required>
    <button type="submit">Excluir Estado</button>
</form>

<link rel="stylesheet" href="style.css">