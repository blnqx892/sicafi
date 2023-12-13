<?php
include "../../Confi/conexion.php";
$conexion = con();

$suministro = $_GET["suministro"];

$query = "select * from kardex where fk_ingreso_suministros = ".$suministro." order by fecha_creacion";

$result = mysqli_query($conexion, $query);

$response = array();

while ($item = mysqli_fetch_array($result)) {
  $response[] = array(
    'id' => $item['id'],
    "fecha" => $item["fecha"],
    "concepto" => $item["concepto"],
    "tipo_movimiento" => $item["cantidad_entrada"] != 0 ? "entrada" : "salida",
    "cantidad" => $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : $item["cantidad_salida"],
    "cantidad_entrada" => $item["cantidad_entrada"],
    "cantidad_salida" => $item["cantidad_salida"],
    "precio_entrada" => $item["precio_entrada"],
    "precio_salida" => $item["precio_salida"],
    "fondos_procedencia" => $item["fondos_procedencia"],
    "fk_ingreso_suministro" => $item["fk_ingreso_suministros"]
  );
}

echo json_encode($response);
