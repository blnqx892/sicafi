<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$id = $_POST['id'];

$sql="SELECT * from mobiliario_otros where id='$id'";

  $result = mysqli_query($conexion, $sql);
 // var_dump(mysqli_query($conexion, $sql));
  //var_dump($sql);//ver consulta


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id' => $row['id'],
      'fecha' => $row['fecha'],
      'nombre' => $row['nombre'],
      'modelo' => $row['modelo'],
      'valor'=> $row['valor'],
      'descrim'=> $row['descripcion'],
      
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
?>
