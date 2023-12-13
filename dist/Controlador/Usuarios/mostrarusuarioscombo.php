<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 //$sql="SELECT * from usuarios order by nombre ASC";
 $sql="SELECT usuarios.id as id_usuario,
    unidades.nombre_unidad, usuarios.nombre, usuarios.apellido
 from usuarios 
 INNER JOIN unidades on unidades.id = usuarios.fk_unidades  
 where  usuarios.estado ='Activo'
 Order by nombre ASC";

  $result = mysqli_query($conexion, $sql);
 // var_dump(mysqli_query($conexion, $sql));


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id'    => $row['id_usuario'],
      'nombre' => $row['nombre'],
      'apellido'=> $row['apellido'],
      'unidad'=> $row['nombre_unidad'],      
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>