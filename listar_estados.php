<?php
$conn = new mysqli('localhost', 'root', '', 'cidades_estados');
$result = $conn->query("SELECT * FROM estados");

echo '<div class="view-states">';
while ($row = $result->fetch_assoc()) {
    $sigla = $row['sigla'];
    $imagem = $row['imagem'];
    echo "<p><img src='$imagem' alt='$sigla'> ID: " . $row['id_estado'] . " - Nome: " . $row['nome'] . " - Sigla: " . $row['sigla'] . "</p>";
}
echo '</div>';
$conn->close();
?>
