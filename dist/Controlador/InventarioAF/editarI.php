<?php
session_start();
include("../../Confi/conexion.php");
$conexion = con();


$prov = $_POST["prove"];
$nombre = $_POST["nombreC"];
$serie = $_POST["serie"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$color = $_POST["color"];
$numerom = $_POST["numeromo"];
$numerocha = $_POST["numerochasis"];
$numerop = $_POST["numeropla"];
$capaci = $_POST["capa"];
$id    = $_POST["_id_inventario"];


$sql= "UPDATE asignacion_activo
INNER JOIN ingreso_entradas on ingreso_entradas.id = asignacion_activo.fk_ingreso_entradas
SET
  fk_proveedores='$prov',
  nombre_adquisicion='$nombre',
  serie_adquisicion='$serie',
  numero_motor='$numerom',
  numero_chasis='$numerocha',
  numero_placa='$numerop',
  capacidad='$capaci',
  marca='$marca',
  modelo='$modelo',
  color='$color'
WHERE asignacion_activo.id='$id'";

      //////////CAPTURA DATOS PARA BITACORA
      $usuari=$_SESSION['usuarioActivo'];
      $nom=$usuari['nombre']. ' ' .$usuari['apellido'];
      $sql1 = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se edito un registro de inventario','$nom',now())";
      mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
      ///////////////////////////////////////////

      //var_dump($sql); /*para que proves porq el error */
    // Ejecutar la consulta SQL
    $resultado    = mysqli_query($conexion, $sql);
   // Cerrar la conexión
   mysqli_close($conexion);
    //echo "Los datos se han insertado correctamente";
    $json = array();
            if ($resultado) {
                $json[] = array(
                    'success'=>1,
                    'title' => 'Exito',
                    'mensaje'=>'Registro editado con exito!'
                  );
                 // echo 1;
            } else {
                $json[] = array(
                    'title' => "Error",
                    'mensaje'=>"Surgió un error!"
                  );
            }
           $jsonstring = json_encode($json[0]);
           echo $jsonstring;
?>
