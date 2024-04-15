<?php 
session_start(); 
error_reporting(1);
include ("conex.php");
$link=conectarse();
     

if (isset($_POST['id'])) {
   $idRegistro = $_POST['id'];
   $consulta="DELETE FROM gd_feriados WHERE fer_id = $idRegistro";
   //mysqli_query($link,$consulta);

    if (mysqli_query($link, $consulta)) {
         echo json_encode(['error' => false, 'message' => "Datos Borrados correctamente"]);
    } else {
         echo json_encode(['error' => true, 'message' => "Error: $consulta" . mysqli_error($link)]);
    } 
 }

	    

	?>


