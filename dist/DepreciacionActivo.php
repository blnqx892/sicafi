<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->

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
                            <span>Depreciación por Activo</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Depreciación</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <!-- CONTENEDOR-->
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <!-- row-->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header"><strong>Activos</strong></div>
                            <div class="card-body">
                                <!-- dataTable-->
                                <table id="inven" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <!-- <th style="text-align:center;">Codigo</th> -->
                                            <th style="text-align:center;">Nombre</th>
                                            <th style="text-align:center;">Categoria</th>
                                            <!-- <th style="text-align:center;">Ubicación</th> -->
                                            <!-- <th style="text-align:center;">Estado Bien</th> -->
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <!-- <th style="text-align:center;">Codigo</th> -->
                                            <th style="text-align:center;">Nombre</th>
                                            <th style="text-align:center;">Categoria</th>
                                            <!-- <th style="text-align:center;">Ubicación</th> -->
                                            <!-- <th style="text-align:center;">Estado Bien</th> -->
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!--------------------------- //dataTable-------------------------------------------------------------------->
                                <!--MODAL VER  -->
                                <div class="modal fade" id="modalVerainven" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DE ACTIVOS
                                                    DEPRECIACIÓN
                                                </h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Decripción del
                                                                bien:</label>
                                                            <input type="text" class="form-control" id="descridbien"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">color:</label>
                                                            <input type="text" class="form-control" id="colorver"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Modelo:</label>
                                                            <input type="text" class="form-control" id="modeloin"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">serie:</label>
                                                            <input type="text" class="form-control" id="seriein"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Marca:</label>
                                                            <input type="text" class="form-control" id="marcain"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Fecha
                                                                Adquisición:</label>
                                                            <input type="text" class="form-control" id="fechain"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Valor de
                                                                Adquisición:</label>
                                                            <input type="text" class="form-control" id="valorin"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Proveedor:</label>
                                                            <input type="text" class="form-control" id="id_proveedor"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Código:</label>
                                                            <input type="text" class="form-control" id="codigoin"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Estado del
                                                                Bien:</label>
                                                            <input type="text" class="form-control" id="estadoin"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Jefe
                                                                Responsable:</label>
                                                            <input type="text" class="form-control" id="jefeinven"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Ubicación:</label>
                                                            <input type="text" class="form-control" id="ubicacioni"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Categoria:</label>
                                                            <input type="text" class="form-control" id="id_categoria"
                                                                disabled>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Vida util:</label>
                                                            <input type="text" class="form-control" id="vidai" disabled>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Valor Rescate:</label>
                                                            <input type="text" class="form-control" id="vrescate" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                    <canvas id="depreciacionChart"></canvas>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-coreui-dismiss="modal">Cerrar</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <script src="./Controlador/InventarioAF/mostrarInfoDepreciacion.js"></script>
                                    <!-- <script src="./Controlador/Proveedores/proveedor.js"></script> -->
                                    <script src="./Controlador/Categorias/categoria.js"></script>
                                    <!-- IMPORTAR ARCHIVO FOOTER-->
                                    <?php include("foot/foot.php"); ?>
                                    <!-- IMPORTAR ARCHIVO SCRIPT-->
                                    <?php include("foot/script.php"); ?>
                                    <!-- ////////////////////////-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
