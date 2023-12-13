<?php
include "../../Confi/conexion.php";
$conexion = con();

$id = $_GET["id"];

$query = "select * from ingreso_suministros where id = ".$id;

$result = mysqli_query($conexion, $query);

$response = null;

while ($item = mysqli_fetch_array($result)) {
  $response = array(
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
    "categoria_id" => $item["categoria_id"]
  );
}

echo json_encode($response);
