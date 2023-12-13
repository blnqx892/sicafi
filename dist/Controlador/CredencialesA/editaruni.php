<?php
session_start();
include("../../Confi/conexion.php");
$conexion = con();

$nombreUnid = $_POST["nombreUnid"];
$id = $_POST['_id'];

$sql = "UPDATE unidades SET nombre_unidad='$nombreUnid' WHERE id = '$id'";
//var_dump($sql); /* para que pruebes por qué el error */
// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $sql);

//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se modifico la información de unidad','$nom',now())";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////

// Cerrar la conexión
mysqli_close($conexion);

$json = array();
if ($resultado) {
    $json[] = array(
        'success' => 1,
        'title' => 'Éxito',
        'mensaje' => '¡Registro guardado con éxito!'
    );
} else {
    $json[] = array(
        'title' => "Error",
        'mensaje' => "¡Surgió un error!"
    );
}
$jsonstring = json_encode($json[0]);
echo $jsonstring;

//////////CAPTURA DATOS PARA BITACORA
//$usuari=$_SESSION['usuarioActivo'];
//$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
//$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se edito los datos de una unidad','$nom',now())";
//mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////


?>
