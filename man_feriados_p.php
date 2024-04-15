<?php 
session_start(); 
error_reporting(1);
	   include ("conex.php");
	   $link=conectarse();
     

	   $f_nombre 		= $_POST['f_nombre'];
	   $f_fecha			= $_POST['f_fecha'];
	   $f_op			= $_POST['f_op'];

	   $id_fer=$_GET['id_fer'];

	   if ($id_fer > 0) $f_op="b";

	   // OPCION AGREGAR NUEVO

	   if ($f_op=="a"){

			$consulta="INSERT INTO `gd_feriados` (`fer_id`, `fer_fecha`, `fer_nombre`) VALUES (NULL, '$f_fecha', '$f_nombre')";

		    if (mysqli_query($link, $consulta)) {
          echo json_encode(['error' => false, 'message' => "Datos insertados correctamente"]);
        } else {
            echo json_encode(['error' => true, 'message' => "Error: " . mysqli_error($link)]);
        }}
	    if ($f_op=="b"){

				   $consulta="DELETE FROM `gd_feriados`

							 WHERE  `fer_id` = $id_fer";
				   mysqli_query($link,$consulta);
	   }