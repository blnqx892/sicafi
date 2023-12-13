<?php
session_start();
include "../../Confi/conexion.php";
$conexion = con();

$body = json_decode(file_get_contents("php://input"));

$query = "select * from kardex where fk_ingreso_suministros = ".$body->id;

$result = mysqli_query($conexion, $query);

$suministros = 0;

while ($item = mysqli_fetch_array($result)) {
  $suministros += $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : ($item["cantidad_salida"] * -1);
}

$response = null;

if ($suministros > 0) {
  $response["statusCode"] = 99;
  $response["message"] = "El suministro tiene: ".$suministros." item(s) en existencia";
} else {
  $sql2 = "delete from kardex where fk_ingreso_suministros = ".$body->id;
  $sql3 = "delete from ingreso_suministros where id = ".$body->id;

//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se elimino un suministro','$nom',now())";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////

  $response["statusCode"] = 500;
  $response["message"] = "Algo salió mal, no se pudo guardar";

  if (mysqli_query($conexion, $sql2)) {
    $response["statusCode"] = 500;
    $response["message"] = "Algo salió mal, no se pudo guardar";

    if (mysqli_query($conexion, $sql3)) {
      $response["statusCode"] = 200;
      $response["message"] = "Registro eliminado";
    }
  }
}

echo json_encode($response);
