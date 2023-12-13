<?php
$conexion = mysqli_connect("localhost", "root", "", "sicafi");

 function con(){
  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "sicafi";

     $con = mysqli_connect($server,$user,$pass) or die ("Error a Conectar en la BD".mysqli_connect_error());
     mysqli_select_db($con, $db) or die ("Error a Conectar en la BD".mysqli_connect_error());
     return $con;
}
?>
