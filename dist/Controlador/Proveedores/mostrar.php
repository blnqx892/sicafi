<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT * from proveedores order by proveedor ASC";


  $result = mysqli_query($conexion, $sql);
 // var_dump(mysqli_query($conexion, $sql));


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id'    => $row['id'],
      'name' => $row['proveedor']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>
