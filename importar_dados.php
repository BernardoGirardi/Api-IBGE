<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cidades_estados';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    logMessage("Falha na conexão: " . $conn->connect_error);
    die("Falha na conexão: " . $conn->connect_error);
}

$api_url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

$response = file_get_contents($api_url);

if ($response === FALSE) {
    logMessage("Erro ao consumir a API.");
    die("Erro ao consumir a API.");
}

$estados = json_decode($response, true);

$numeroRegistros = count($estados);
logApiCall($numeroRegistros); 

foreach ($estados as $estado) {
    $nome = $estado['nome'];
    $sigla = $estado['sigla'];
    $id = $estado['id'];
    
    $check_sql = "SELECT * FROM estados WHERE sigla = '$sigla'";
    $result = $conn->query($check_sql);

    if ($result->num_rows == 0) {
        $sql = "INSERT INTO estados (id_estado, nome, sigla) VALUES ('$id', '$nome', '$sigla')";
        if ($conn->query($sql)) {
            logMessage("Estado $nome inserido com sucesso.");
        } else {
            logMessage("Erro ao inserir estado $nome: " . $conn->error);
        }
    } else {
        logMessage("Estado $nome já existe no banco de dados.");
    }
}

echo "Estados importados com sucesso!";
logMessage("Importação de estados concluída com sucesso.");
$conn->close();

function logMessage($message) {
    $logFile = 'log.txt';
    $currentDateTime = date('Y-m-d H:i:s');
    $logMessage = "$currentDateTime - $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function logApiCall($numeroRegistros) {
    global $conn;
    $sql = "INSERT INTO log (numeroregistros) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $numeroRegistros);
    if ($stmt->execute()) {
        logMessage("Log da chamada da API registrado com sucesso.");
    } else {
        logMessage("Erro ao registrar log da chamada da API: " . $stmt->error);
    }
    $stmt->close();
}

function displayLogs() {
    global $conn;
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
}

displayLogs();
?>
