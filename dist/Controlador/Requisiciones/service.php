<?php
include ("../../Confi/conexion.php");
$conexion = con();

$id = $_GET["id"];
$body = json_decode(file_get_contents("php://input"));

// Obtener el estado pendiente de aprobación
$q_estado = "select * from estado_requisicion where codigo = 'finalizado'";

$estado = null;
$r_estado = mysqli_query($conexion, $q_estado);

while ($e = mysqli_fetch_array($r_estado)) {
  $estado = $e["id"];
}

$fechaId = new DateTime();
$fecha = $fechaId->format('Y-m-d H:i:s');
// Actualizar requisición
$q_req = "update requisicion_suministro set estado_id = ".$estado.", despachado_por = ".$body->usuario.", fecha_despacho = '".$fecha."' where id = ".$id;

mysqli_query($conexion, $q_req);

$q_suministro = "";
// Guardar los suministros
$is_ok = true;
foreach ($body->suministros as $suministro) {
  $q_suministro = "update detalle_requisicion set cantidad_despachada = ".$suministro->cantidad." where id = ".$suministro->detalle_id;

  if (!mysqli_query($conexion, $q_suministro)) {
    $is_ok = false;
  }

  // Guardar salida de kardex requisicion
  $fechaActual = date_create();
  $fecha = date_format($fechaActual, "Y-m-d");
  $fechaCreacion = date_format($fechaActual, "Y-m-d H:i:s");
  $id2 = intval(microtime(true)*1000000);

  $sql_costos = 'select * from kardex where fk_ingreso_suministros = '.$suministro->suministro_id.' and cantidad_entrada != 0';
  $costos = mysqli_query($conexion, $sql_costos);

  $precio = 0;
  $count = 0;
  $total = 0;
  while ($costo = mysqli_fetch_array($costos)) {
    $precio += $costo['cantidad_entrada'] * $costo['precio_entrada'];
    $count += $costo['cantidad_entrada'];
  }
  $precio /= $count;
  $total = $precio * $suministro->cantidad;

  $q_kardex = "insert into kardex (id, fecha, concepto, movimiento, cantidad_entrada, precio_entrada, cantidad_salida, precio_salida, saldo_articulos, fondos_procedencia, fk_ingreso_suministros, fecha_creacion) values (".$id2.", '".$fecha."', 'Salida de requisicion: ".$id."', 0, 0, 0, ".$suministro->cantidad.", ".$total.", 0, ".$suministro->fondos_procedencia.", ".$suministro->suministro_id.", '".$fechaCreacion."')";

  if (!mysqli_query($conexion, $q_kardex)) {
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
