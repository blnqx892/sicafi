<?php
include ("../../Confi/conexion.php");
$conexion = con();

$id = $_GET["id"];
$body = json_decode(file_get_contents("php://input"));

// Obtener el estado pendiente de aprobación
$q_estado = "select * from estado_requisicion where codigo = 'pendiente.despacho'";

$estado = null;
$r_estado = mysqli_query($conexion, $q_estado);

while ($e = mysqli_fetch_array($r_estado)) {
  $estado = $e["id"];
}

$fechaId = new DateTime();
$fecha = $fechaId->format('Y-m-d H:i:s');

// Actualizar requisición
$q_req = "update requisicion_suministro set estado_id = ".$estado.", aprobado_por = ".$body->usuario.", fecha_aprobacion = '".$fecha."' where id = ".$id;

mysqli_query($conexion, $q_req);

$q_suministro = "";
// Guardar los suministros
$is_ok = true;
foreach ($body->suministros as $suministro) {
  $q_suministro = "update detalle_requisicion set cantidad_aprobada = ".$suministro->cantidad." where id = ".$suministro->detalle_id;
  if (!mysqli_query($conexion, $q_suministro)) {
    $is_ok = false;
  }
}

if ($is_ok) {
  $response["statusCode"] = 200;
  $response["data"] = $id;
  $response["message"] = "Registro guardado";
} else {
  $response["statusCode"] = 500;
  $response["message"] = "Algo salió mal, no se pudo guardar";
}



echo json_encode($response);
