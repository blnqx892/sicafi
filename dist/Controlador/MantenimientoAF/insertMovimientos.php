<?php
session_start();
include("../../Confi/conexion.php");
$conexion = con();

   $fechaM               = $_POST["fechaMovimiento"];
   $observacionM         = $_POST["observa"] ;
   $tipoMovimiento       = $_POST["tipomovi"] ;
   $fk_asignacion_activo = $_POST["_id_asigna"] ?? '';
   $fk_unidades          = $_POST["nombre_u"] ?? '';
   $tipoRegistro         = $_POST["tiporegis"] ?? null;

   $sql = "call INSERT_MANTENIMIENTO_DESCARGO(
    '$fechaM',
    '$observacionM',
    '$tipoMovimiento',
    '$tipoRegistro',
    '$fk_asignacion_activo',
    '$fk_unidades'
   );";

    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo'];
    $nom=$usuari['nombre']. ' ' .$usuari['apellido'];
    $sql1 = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se ejecuto un movimiento en activo fijo','$nom',now())";
    mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $sql);

    //echo "Los datos se han insertado correctamente";
    $json = array();
            if ($resultado) {
                $json[] = array(
                    'success'=>1,
                    'title' => 'Exito',
                    'mensaje'=>'Registro descargado con exito!'
                  );
                 // echo 1;
            } else {
                $json[] = array(
                    'title' => "Error",
                    'mensaje'=>"Algo salió mal, no se pudo guardar!"
                  );
            }
           $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>
