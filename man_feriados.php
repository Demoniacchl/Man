<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Man_feriados</title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<?php
include_once "lib_title.php";
?>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="assets/img/favicon.png" rel="icon"> <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">  <link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<script>
function convertirAMayusculas(input) {
input.value = input.value.toUpperCase();
}
</script>
</head>
<body>
<?php
include_once "conex.php";
$link=conectarse();
$ses_usu_id     = $_SESSION['ses_id'];
$ses_usu_nombre = $_SESSION['ses_nombre'];
$ses_usu_ape_p  = $_SESSION['ses_ape_p'];
$ses_usu_ape_m  = $_SESSION['ses_ape_m'];
$ses_usu_cargo  = $_SESSION['ses_cargo'];
$ses_div_id	   = $_SESSION['ses_div_id'];
$ses_nivel	   = $_SESSION['ses_nivel'];
if ($ses_usu_id==""){
?>
<script>location.href='index.php';</script>
<?php
}
$des_mes[1]="ENERO";
$des_mes[2]="FEBRERO";
$des_mes[3]="MARZO";
$des_mes[4]="ABRIL";
$des_mes[5]="MAYO";
$des_mes[6]="JUNIO";
$des_mes[7]="JULIO";
$des_mes[8]="AGOSTO";
$des_mes[9]="SEPTIEMBRE";
$des_mes[10]="OCTUBRE";
$des_mes[11]="NOVIEMBRE";
$des_mes[12]="DICIEMBRE";
?>
<?php include_once "lib_header.php";?>
<?php include_once "lib_sidebar.php";?>
<main id="main" class="main">
<div class="pagetitle">
<h1>Feriados</h1>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="menu.php">Home</a></li>
<li class="breadcrumb-item">Configuración</li>
<li class="breadcrumb-item">Feriados</li>
</ol>
</nav>
</div><!-- End Page Title -->
<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h5 class="card-title">Ingresar Nuevo Feriado</h5>     
<form class="row g-3" name="FormFeriados" id="FormFeriados"   method="POST" action="#" enctype="multipart/form-data">
<div class="col-md-3">
<div class="form-floating">
<input type="date" name="f_fecha" class="form-control" id="f_fecha" placeholder="Fecha" required>
<label for="floatingEmail">Fecha</label>
</div>
</div>
<div class="col-md-6">
<div class="form-floating">
<input type="text" class="form-control" name="f_nombre" id="f_nombre" placeholder="Nombre Feriado" oninput="convertirAMayusculas(this)" required>
<label for="floatingPassword">Nombre</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating">
<input type="hidden" name="f_op" value="a">
<button type="submit" class="btn btn-primary">Agregar.</button>
</div>
</div>                      
</form>
</div>
</div>
<div class="card">
<div class="card-body" id="contenedorTabla">
</div>
</div>
</div>
</div>
</section>
</main>
<?php include_once "lib_footer.php"; ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
<script>
$(document).ready(function() {
// Esto asegura que la tabla se actualice inmediatamente cuando la página se carga.
actualizarTabla();
// Aquí puedes poner también el resto de tu código de inicialización, como el manejo del envío de formularios.
});
$(document).ready(function() {
$('#FormFeriados').submit(function(e) {
e.preventDefault();
var formData = new FormData(this); // Utiliza FormData para recoger el archivo y otros datos
$.ajax({
type: "POST",
url: "man_feriados_p.php",
data: formData,
processData: false, // Importante para el manejo de FormData
contentType: false, // Importante para el manejo de FormData
dataType: "json", // Esperando respuesta en formato JSON
success: function(response) {
if(response.error) {
alert("Error: " + response.message); // Mostrar mensaje de error
} else {
alert("Éxito: " + response.message); // Mostrar mensaje de éxito
$('#FormFeriados')[0].reset();
actualizarTabla();
}
},
error: function() {
alert("Hubo un error al enviar los datos al servidor");
}
});
});
$(document).on('click', '#btnEliminar1', function() {
var idRegistro = $(this).data('idregistro'); // Obtiene el ID del registro a eliminar
if(confirm('¿Estás seguro de que deseas eliminar este registro?')) {
$.ajax({
url: 'man_feriados_b.php', // El script PHP que maneja la eliminación
type: 'POST',
data: { id: idRegistro },
dataType: "json",
success: function(response) {
if(response.error) {
alert("Error: " + response.message); // Mostrar mensaje de error
} else {
alert("Éxito: " + response.message); // Mostrar mensaje de éxito
// $('#FormFeriados')[0].reset();
actualizarTabla();
}
// Aquí puedes elegir qué hacer después de la eliminación exitosa.
// Por ejemplo, podrías querer actualizar la tabla o mostrar un mensaje.
// alert("Registro eliminado con éxito");
// actualizarTabla(); // Suponiendo que tienes una función para actualizar la tabla
},
error: function() {
alert("Hubo un error al eliminar el registro");
}
});
}
});
});
function actualizarTabla() {
$.ajax({
url: 'man_feriados_tabla.php',
type: 'GET',
success: function(data) {
$('#contenedorTabla').html(data); // Reemplaza el contenido del div con la nueva tabla
},
error: function() {
alert('Error al obtener los datos.');
}
});
}
</script>
</html>
