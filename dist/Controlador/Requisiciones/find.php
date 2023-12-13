<?php
include "../../Confi/conexion.php";
$conexion = con();

$id = $_GET["id"];

$query = "select * from requisicion_suministro where id = ".$id;

$result = mysqli_query($conexion, $query);

$response = null;

while ($item = mysqli_fetch_array($result)) {
  $response = array(
    'id' => $item['id'],
    "unidad_id" => $item["unidad_id"],
    "fecha_requisicion" => $item["fecha_requisicion"]
  );
}

$query_detalle = "select dq.id, dq.cantidad_solicitada, dq.cantidad_aprobada, dq.cantidad_despachada, s.id as suministro_id, s.nombre_suministro from detalle_requisicion dq inner join ingreso_suministros s on dq.suministro_id = s.id where dq.requisicion_id = ".$id;

$result2 = mysqli_query($conexion, $query_detalle);

$detalle = array();

while ($item2 = mysqli_fetch_array($result2)) {
  $query_stock = "select * from kardex where fk_ingreso_suministros = ".$item2["suministro_id"];
  $kardex = mysqli_query($conexion, $query_stock);

  $stock = 0;

  while ($it = mysqli_fetch_array($kardex)) {
    $stock += $it["cantidad_entrada"] != 0 ? $it["cantidad_entrada"] : ($it["cantidad_salida"] * -1);
  }
  $detalle[] = array(
    'id' => $item2["id"],
    'cantidad_solicitada' => $item2["cantidad_solicitada"],
    'cantidad_aprobada' => $item2["cantidad_aprobada"],
    'cantidad_despachada' => $item2["cantidad_despachada"],
    'suministro_id' => $item2["suministro_id"],
    'nombre_suministro' => $item2["nombre_suministro"],
    'stock' => $stock
  );
}

$response["suministros"] = $detalle;

echo json_encode($response);
