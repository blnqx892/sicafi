<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 //$sql="SELECT * from usuarios order by nombre ASC";
$sql="SELECT 
  a.id, a.codigo_institucional 
from asignacion_activo a 
where a.id not in (
  SELECT
      aa.id
  from mantenimiento_activos ma
  inner join asignacion_activo aa on ma.fk_asignacion_activo = aa.id
  where ma.tipo_registro like 'Descargo'
) order by a.codigo_institucional ASC";
//var_dump($sql);
  $result = mysqli_query($conexion, $sql);
 // var_dump(mysqli_query($conexion, $sql));


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id'    => $row['id'],
      'name' => $row['codigo_institucional'],
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>