<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$codigo = $_POST['codigo'];

$sql="
  SELECT ingreso_entradas.nombre_adquisicion,
  ingreso_entradas.id as ingreso_entrada_id,
  ingreso_entradas.costo_adquisicion,
  categorias.vida_util,
  ingreso_entradas.color,
  ingreso_entradas.modelo,
  ingreso_entradas.serie_adquisicion,
  ingreso_entradas.marca,
  asignacion_activo.codigo_institucional,
  unidades.nombre_unidad,
  asignacion_activo.id,
  categorias.categoria,
  asignacion_activo.encargado_bien as encargado,
  usuarios.id as id_jefe
FROM asignacion_activo
  INNER JOIN ingreso_entradas ON ingreso_entradas.id = asignacion_activo.fk_ingreso_entradas
  INNER JOIN usuarios ON usuarios.id = asignacion_activo.fk_usuarios
  INNER JOIN unidades ON unidades.id = usuarios.fk_unidades
  LEFT JOIN  categorias ON ingreso_entradas.fk_categoria = categorias.id
WHERE asignacion_activo.id ='$codigo'";

 
  $result = mysqli_query($conexion, $sql);
  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'nombre_adquisicion' => $row['nombre_adquisicion'],
      'ingreso_entrada_id' => $row['ingreso_entrada_id'],
      'costo_adquisicion' => $row['costo_adquisicion'],
      'vida_util' => $row['vida_util'],
      'color' => $row['color'],
      'modelo' => $row['modelo'],
      'serie_adquisicion' => $row['serie_adquisicion'],
      'marca' => $row['marca'],
      'codigo_institucional' => $row['codigo_institucional'],
      'nombre_unidad' => $row['nombre_unidad'],
      'categoria' => $row['categoria'],
      'encargado' => $row['encargado'],
      'id_jefe' => $row['id_jefe'],
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
?>