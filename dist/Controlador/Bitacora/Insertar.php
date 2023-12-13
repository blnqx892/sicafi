<?php
session_start();
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];

// Incluir el archivo que contiene la configuración de la conexión a la base de datos
 include("../../Confi/conexion.php");
 $conexion = con();

//////////CAPTURA DATOS PARA BITACORA
$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Registró un nuevo bien','$nom',now())";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////
?>
