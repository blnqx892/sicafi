<?php
session_start();
include ("../../Confi/conexion.php");
$conexion = con();

$body = json_decode(file_get_contents("php://input"));

$fechaId = new DateTime();
$timestamp = $fechaId->getTimestamp();

$query = "insert
into ingreso_suministros (
                          id,
                          codigo_barra,
                          nombre_suministro,
                          presentacion,
                          existencia_minima,
                          existencia_maxima,
                          categoria_id
) values (
          ".$timestamp.",
          '".$body->codigo_barra."',
          '".$body->nombre_suministro."',
          '".$body->presentacion."',
          ".$body->existencia_minima.",
          ".$body->existencia_maxima.",
          '.$body->categoria_id.'
)";

//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se ingreso un nuevo suministro','$nom',now())";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////

$response["statusCode"] = 500;
$response["message"] = "Algo salió mal, no se pudo guardar";

if (mysqli_query($conexion, $query)) {
  $response["statusCode"] = 200;
  $response["data"] = $timestamp;
  $response["message"] = "Registro guardado exitosamente";
}

echo json_encode($response);
