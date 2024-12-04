<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cidades_estados';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM log ORDER BY datahora DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Logs de Chamadas da API</h2><ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row["idlog"] . " - Data/Hora: " . $row["datahora"] . " - Número de Registros: " . $row["numeroregistros"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum log encontrado.";
}

$conn->close();
?>
