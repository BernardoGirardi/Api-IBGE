<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');
$result = $conn->query("SELECT cidades.id_cidade, cidades.nome AS cidade, estados.nome AS estado 
FROM cidades 
INNER JOIN estados ON cidades.id_estado = estados.id_estado");

while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id_cidade'] . " - Cidade: " . $row['cidade'] . " - Estado: " . $row['estado'] . "<br>";
}
?>

<link rel="stylesheet" href="style.css">