<?php
include "../../Confi/conexion.php";
$conexion = con();

$query = "select * from ingreso_suministros order by nombre_suministro";

$result = mysqli_query($conexion, $query);

$response = array();

while ($item = mysqli_fetch_array($result)) {
  $sql_stock = "select * from kardex where fk_ingreso_suministros = ".$item["id"];
  $kardex = mysqli_query($conexion, $sql_stock);

  $stock = 0;

  while ($it = mysqli_fetch_array($kardex)) {
    $stock += $it["cantidad_entrada"] != 0 ? $it["cantidad_entrada"] : ($it["cantidad_salida"] * -1);
  }

  $response[] = array(
    'id' => $item['id'],
    "codigo_barra" => $item["codigo_barra"],
    "nombre_suministro" => $item["nombre_suministro"],
    "presentacion" => $item["presentacion"],
    "unidad_medida" => $item["unidad_medida"],
    "existencia_minima" => $item["existencia_minima"],
    "existencia_maxima" => $item["existencia_maxima"],
    "almacen" => $item["almacen"],
    "estante" => $item["estante"],
    "entrepano" => $item["entrepaño"],
    "casilla" => $item["casilla"],
    "categoria_id" => $item["categoria_id"],
    "stock" => $stock
  );
}

echo json_encode($response);
