<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cidades_estados';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Falha na conexão: " . $conn->connect_error]));
}

$response = ['success' => false, 'message' => 'Erro desconhecido'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $sql = "DELETE FROM estados";

    if ($conn->query($sql) === TRUE) {
        $response = ['success' => true, 'message' => 'Banco de dados limpo com sucesso.'];
        logMessage("Banco de dados limpo com sucesso.");
    } else {
        $response = ['success' => false, 'message' => "Erro ao limpar o banco de dados: " . $conn->error];
        logMessage("Erro ao limpar o banco de dados: " . $conn->error);
    }

    $conn->close();
}

echo json_encode($response);

function logMessage($message) {
    $logFile = 'log.txt';
    $currentDateTime = date('Y-m-d H:i:s');
    $logMessage = "$currentDateTime - $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}
?>
