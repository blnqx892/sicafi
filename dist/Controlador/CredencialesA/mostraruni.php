<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT * from unidades order by nombre_unidad ASC";


  $result = mysqli_query($conexion, $sql);
 // var_dump(mysqli_query($conexion, $sql));


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id'    => $row['id'],
      'name' => $row['nombre_unidad']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>