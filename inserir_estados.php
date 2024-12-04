<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    
    if (!empty($_FILES["imagem"]["name"]) && move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
        $sql = "UPDATE estados SET nome='$nome', sigla='$sigla', imagem='$target_file' WHERE id_estado=$id";
    } else {
        $sql = "UPDATE estados SET nome='$nome', sigla='$sigla' WHERE id_estado=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Estado</h1>
    </header>

    <main>
        <form action="inserir_estados.php" method="POST" enctype="multipart/form-data">
            <input type="number" name="id" placeholder="ID do Estado" required>
            <input type="text" name="nome" placeholder="Novo Nome">
            <input type="text" name="sigla" placeholder="Nova Sigla">
            <input type="file" name="imagem">
            <button type="submit" class="btn btn-edit">Editar Estados</button>
        </form>
    </main>
</body>
</html>

