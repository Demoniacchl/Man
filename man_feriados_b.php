<?php
session_start();
error_reporting(1);

include_once "conex.php";
$link = conectarse();

if (isset($_POST['id'])) {
    $idRegistro = $_POST['id'];
    
    // Preparar la sentencia SQL
    $stmt = $link->prepare("DELETE FROM gd_feriados WHERE fer_id = ?");
    if (!$stmt) {
        echo json_encode(['error' => true, 'message' => "Error al preparar la sentencia: " . mysqli_error($link)]);
        exit;
    }

    // Vincular los parámetros
    $stmt->bind_param("i", $idRegistro);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo json_encode(['error' => false, 'message' => "Datos Borrados correctamente"]);
    } else {
        echo json_encode(['error' => true, 'message' => "Error al ejecutar la consulta: " . $stmt->error]);
    }
    // Cerrar la sentencia y la conexión
    $stmt->close();
    $link->close();
}


