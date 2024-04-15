<?php
session_start();
error_reporting(1);
use Database\Conexion;
require_once "Database.php";
$db = new Conexion();
$link = $db->getLink();
if (isset($_POST['id'])) {
    $idRegistro = $_POST['id'];

    $stmt = $link->prepare("DELETE FROM gd_feriados WHERE fer_id = ?");
    if (!$stmt) {
        echo json_encode(['error' => true, 'message' => "Error al preparar la sentencia: " . mysqli_error($link)]);
        exit;
    }

    $stmt->bind_param("i", $idRegistro);

    if ($stmt->execute()) {
        echo json_encode(['error' => false, 'message' => "Datos Borrados correctamente"]);
    } else {
        echo json_encode(['error' => true, 'message' => "Error al ejecutar la consulta: " . $stmt->error]);
    }
    $stmt->close();
    $link->close();
}
