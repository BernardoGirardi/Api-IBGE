<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);

    $sql = "INSERT INTO estados (nome, sigla, imagem) VALUES ('$nome', '$sigla', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.html');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
