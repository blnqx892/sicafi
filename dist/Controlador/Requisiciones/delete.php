<?php
include "../../Confi/conexion.php";
$conexion = con();

$body = json_decode(file_get_contents("php://input"));

// Eliminar todos los detalles de una requsición
$sql1 = "delete from detalle_requisicion where requisicion_id = ".$body->id;
$sql2 = "delete from requisicion_suministro where id = ".$body->id;

$response["statusCode"] = 500;
$response["message"] = "Algo salió mal, no se pudo eliminar";

if (mysqli_query($conexion, $sql1)) {
  $response["statusCode"] = 500;
  $response["message"] = "Algo salió mal, no se pudo eliminar";

  if (mysqli_query($conexion, $sql2)) {
    $response["statusCode"] = 200;
    $response["message"] = "Registro eliminado";
  }
}

echo json_encode($response);
