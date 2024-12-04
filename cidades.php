<?php
include './config.php';

$estado_id = $_GET['estado_id'];
$sql = "SELECT id, nome FROM cidades WHERE estado_id=$estado_id";
$result = $conn->query($sql);

$cidades = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cidades[] = $row;
    }
}
echo json_encode($cidades);
?>
