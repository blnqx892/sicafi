<?php
session_start();
include("../../Confi/conexion.php");
  $conexion = con();

      $fechaM=$_POST["fecham"];
      $nombreM=$_POST["nombrem"];
      $modeloM=$_POST["modelom"];
      $valorM=$_POST["valorm"];
      $descriM=$_POST["descrim"];
      $id    = $_POST["_id"];

    $sql= " UPDATE mobiliario_otros SET fecha='$fechaM',nombre='$nombreM',modelo='$modeloM',
    valor='$valorM',descripcion='$descriM' WHERE id = $id";

    // Ejecutar la consulta SQL
    $resultado  = mysqli_query($conexion, $sql);

   //////////CAPTURA DATOS PARA BITACORA
   $usuari=$_SESSION['usuarioActivo'];
   $nom=$usuari['nombre']. ' ' .$usuari['apellido'];
   $sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se modifico la información de un inmueble','$nom',now())";
   mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
   ///////////////////////////////////////////////

    // Cerrar la conexión
    mysqli_close($conexion);

    //echo "Los datos se han insertado correctamente";
    $json = array();
            if ($resultado) {
                $json[] = array(
                    'success'=>1,
                    'title' => 'Exito',
                    'mensaje'=>'Registro modificado con exito!'
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

//$conexion = con();
//$usuari = $_SESSION['usuarioActivo'];
//$nom = $usuari['nombre'] . ' ' . $usuari['apellido'];
//
//$sql = "INSERT INTO bitacora (evento, usuario, fecha_creacion) VALUES (?, ?, now())";
//$stmt = mysqli_prepare($conexion, $sql);
//
//// Verificar si la preparación de la consulta fue exitosa
//if ($stmt) {
//    // Asociar parámetros y ejecutar la consulta
//    mysqli_stmt_bind_param($stmt, "ss", $evento, $nom);
//    $evento = "Se edito los datos de un bien en mobiliario";
//    mysqli_stmt_execute($stmt);
//
//    // Verificar si la inserción fue exitosa
//    if (mysqli_stmt_affected_rows($stmt) > 0) {
//        echo "Registro en la bitácora exitoso";
//    } else {
//        echo "Error al registrar en la bitácora";
//    }
//
//    // Cerrar la sentencia preparada
//    mysqli_stmt_close($stmt);
//} else {
//    echo "Error al preparar la consulta";
//}
//
//// Cerrar la conexión
//mysqli_close($conexion);

?>
