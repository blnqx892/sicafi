<?php
include("../../Confi/conexion.php");
$con = con();

// Verificamos si se recibió el parámetro tipoMovimientoId por POST
if (isset($_POST['tipoMovimientoId'])) {
    $tipoMovimientoId = $_POST['tipoMovimientoId'];

    $tipoMovimientoId = mysqli_real_escape_string($con, $tipoMovimientoId);

    // Consulta SQL
    $sql = "SELECT asignacion_activo.codigo_institucional
    FROM asignacion_activo
    INNER JOIN mantenimiento_activos ON asignacion_activo.id = mantenimiento_activos.fk_asignacion_activo
    WHERE mantenimiento_activos.tipo_registro = '$tipoMovimientoId'";


    echo "Consulta SQL: " . $sql; // Salida de depuración

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Error en la consulta: " . mysqli_error($con);
    } else {
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row['codigo_institucional'];
        }

        var_dump($json); // Salida de depuración

        // Eliminar cualquier salida de depuración antes de la respuesta JSON
        ob_clean();

        $jsonstring = json_encode($json);
        echo $jsonstring;
        exit;
    }
} else {
    // Si no se recibió el parámetro esperado, devolvemos un arreglo vacío
    echo json_encode([]);
}
?>
