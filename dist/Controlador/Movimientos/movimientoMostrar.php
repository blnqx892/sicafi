<?php
include("../../Confi/conexion.php");
$con = con();


$sql = "SELECT DISTINCT tipo_registro
        FROM mantenimiento_activos
        ORDER BY tipo_registro ASC";

$result = mysqli_query($con, $sql);

$json = array();
$i = 0;

while ($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
        'id'    => $i,
        'name' => $row['tipo_registro']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>
