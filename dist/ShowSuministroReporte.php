<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->
<script src="js/JsBarcode.all.min.js"></script>
<link rel="stylesheet" href="Controlador/Suministros/imprimir.css">

<?php
    $id = $_GET["id"] or die('La url debe llevar un id como parámetro');
    $conexion=mysqli_connect('localhost','root', '', 'sicafi');
    $sql="SELECT * from ingreso_suministros where id=".$id;
    $nombre = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
?>

<body>
    <!-- IMPORTAR ARCHIVO MENU VERTICAL-->
    <?php include("menu/verti.php"); ?>
    <!-- ////////////////////////-->
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <!-- IMPORTAR ARCHIVO MENU HORIZONTAL-->
            <?php include("menu/hori.php");?>
            <!-- ////////////////////////-->
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <a href="index.php"><svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home">
                                    </use>
                                </svg></a>
                        </li>
                        <li class="breadcrumb-item">
                            <span>Suministros</span>
                        </li>
                        <li class="breadcrumb-item">
                            <span>Ver suministro</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <!-- CONTENEDOR-->
        <div class="body flex-grow-1 px-3" id="contenidoImprimir">
            <div class="container-lg">
                <!-- row-->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="my-auto">
                                        <strong>Kardex</strong>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <h3>Información de Kardex</h3>
                                </div>
                                <?php While($mostrar=mysqli_fetch_assoc($nombre)){?>

                                <div class="row mt-3" style="padding: 0rem 2rem;">

                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>Codigo:
                                                        <span class="fw-bold">
                                                            <?php echo $mostrar['codigo_barra'] ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td rowspan="4"
                                                    style="width: 34%; text-align: center; vertical-align: middle;">
                                                    <div class="membrete" id="">
                                                        <div>ALCALDÍA MUNICIPAL DE SAN VICENTE</div>
                                                        <div>CONTROL DE EXISTENCIA
                                                            DE SUMINISTROS</div>
                                                    </div>
                                                    <div
                                                        style="display: flex; justify-content: space-between; margin-top: 10px;">
                                                        <div style="width: 30%;">Estante:
                                                            <span class="fw-bold">
                                                                <?php
                                                        // Obtener el valor de $mostrar['estante']
                                                        $estante = $mostrar['estante'];

                                                        // Validar si $estante es nulo o vacío
                                                        if (empty($estante)) {
                                                            echo 'No definido';
                                                        } else {
                                                            // Si $estante no es nulo ni vacío, mostrar su valor
                                                            echo $estante;
                                                        }
                                                        ?>
                                                        </div>
                                                        <div style="width: 30%;">Entrepaño:
                                                            <span class="fw-bold">
                                                                <?php
                                                        // Obtener el valor de $mostrar['entrepaño']
                                                        $entrepano = $mostrar['entrepaño'];

                                                        // Validar si $entrepano es nulo o vacío
                                                        if (empty($entrepano)) {
                                                            echo 'No definido';
                                                        } else {
                                                            // Si $entrepano no es nulo ni vacío, mostrar su valor
                                                            echo $entrepano;
                                                        }
                                                        ?>
                                                            </span>
                                                        </div>
                                                        <div style="width: 30%;">Casilla:
                                                            <span class="fw-bold">
                                                                <?php
                                                            // Obtener el valor de $mostrar['casilla']
                                                            $casilla = $mostrar['casilla'];

                                                            // Validar si $casilla es nulo o vacío
                                                            if (empty($casilla)) {
                                                                echo 'No definido';
                                                            } else {
                                                                // Si $casilla no es nulo ni vacío, mostrar su valor
                                                                echo $casilla;
                                                            }
                                                            ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>Tarjeta numero:
                                                        <span class="fw-bold">
                                                            <?php echo $mostrar['numero_tarjeta'] ?>
                                                        </span>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>Nombre del Articulo:
                                                        <span class="fw-bold">
                                                            <?php echo $mostrar['nombre_suministro'] ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>Almacen:
                                                        <span class="fw-bold">
                                                            <?php
                                                            // Obtener el valor de $mostrar['almacen']
                                                            $almacen = $mostrar['almacen'];

                                                            // Validar si $almacen es nulo o vacío
                                                            if (empty($almacen)) {
                                                                echo 'El almacen no ha sido asignado';
                                                            } else {
                                                                // Si $almacen no es nulo ni vacío, mostrar su valor
                                                                echo '<span class="fw-bold">' . $almacen . '</span>';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>Presentación:
                                                        <span class="fw-bold">
                                                            <?php echo $mostrar['presentacion'] ?>
                                                        </span>
                                                    </div>

                                                    <div style="padding-top: 0.3rem;">Unidad de Medida:
                                                        <span class="fw-bold">
                                                            <?php
                                                        // Obtener el valor de $mostrar['unidad_medida']
                                                        $unidad_medida = $mostrar['unidad_medida'];

                                                        // Validar si $unidad_medida es nulo o vacío
                                                        if (empty($unidad_medida)) {
                                                            echo 'Unidad de medida no definida';
                                                        } else {
                                                            // Si $unidad_medida no es nulo ni vacío, mostrar su valor
                                                            echo '<span class="fw-bold">' . $unidad_medida . '</span>';
                                                        }
                                                        ?>
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>Existencias
                                                        <div style="display:flex; gap: 1rem;">
                                                            <div>Minima:
                                                                <span class="fw-bold">
                                                                    <?php echo $mostrar['existencia_minima'] ?>
                                                                </span>
                                                            </div>
                                                            <div>Maxima:
                                                                <span class="fw-bold">
                                                                    <?php echo $mostrar['existencia_maxima'] ?>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="tableKardex">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Concepto</th>
                                                <th scope="col">Fondos Procedencia</th>
                                                <th scope="col">Entradas
                                                    <div
                                                        style="display: flex; justify-content: space-between; margin-top: 10px;">
                                                        <div style="width: 50%;">Cantidad:
                                                        </div>
                                                        <div style="width: 50%;">Precio:
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="col">Salidas
                                                    <div
                                                        style="display: flex; justify-content: space-between; margin-top: 10px;">
                                                        <div style="width: 50%;">Cantidad:
                                                        </div>
                                                        <div style="width: 50%;">Precio:
                                                        </div>
                                                    </div>

                                                </th>
                                                <th scope="col">Saldos Articulos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dato 1</td>
                                                <td>Dato 2</td>
                                                <td>Dato 3</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-between; margin-top: 1px;">
                                                        <div style="width: 50%;">1
                                                        </div>
                                                        <div style="width: 50%;">2
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-between; margin-top: 1px;">
                                                        <div style="width: 50%;">1
                                                        </div>
                                                        <div style="width: 50%;">2
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Dato 6</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row mt-3">
                                    </div>
                                    <?php } ?>
                                    <div class="css-buttons">
                                        <div>
                                            <button class="btn btn-success" id="btnImprimir"
                                                onclick="printDiv('contenidoImprimir')">Imprimir Contenido</button>
                                        </div>
                                        <div>
                                            <a class="btn btn-secondary" href="TablaSumi.php" title="Atrás"><i
                                                    class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- /.row-->
                    </div>
                </div>
                <!-- ///////FIN CONTENEDOR/////////////-->
            </div>


            <!-- IMPORTAR ARCHIVO FOOTER-->
            <?php include("foot/foot.php"); ?>
            <!-- ////////////////////////-->
            <!-- IMPORTAR ARCHIVO SCRIPT-->
            <?php include("foot/script.php"); ?>
            <!-- ////////////////////////-->
            <script src="js/utils.js"></script>
            <script src="Controlador/Suministros/imprimir.js"></script>


</body>

</html>



<?php
}else{
    ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="0;URL=/coreu/dist/Acceso.php">
</head>

<body>
</body>

</html>
<?php
}
?>
