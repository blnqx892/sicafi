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
                            <span>Control Mantenimiento</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Actualización</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <!-- CONTENEDOR-->
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
              <?php include("toast/toast.php"); ?>
        <!-- row-->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="my-auto">
                                        <strong>Actualización de Movimientos</strong>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- dataTable-->
                                <table id="moviactivo" class="display" style="width:100%" cellpadding="0"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">Codigo del Bien</th>
                                            <th style="text-align:center;">Descripción del bien</th>
                                            <th style="text-align:center;">Tipo de Movimiento</th>
                                            <th style="text-align:center;">Tipo de Registro</th>
                                            <th style="text-align:center;">Unidad Destino</th>
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">Codigo del Bien</th>
                                            <th style="text-align:center;">Descripción del bien</th>
                                            <th style="text-align:center;">Tipo de Movimiento</th>
                                            <th style="text-align:center;">Tipo de Registro</th>
                                            <th style="text-align:center;">Unidad Destino</th>
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- //dataTable-->
                                <!-----------------------------------------MODAL VER  --------------------------------------------------------->
                                <div class="modal fade" id="modalVermovimientos" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN MOVIMIENTO DE
                                                    ACTIVOS</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Decripción del
                                                                bien:</label>
                                                            <input type="text" class="form-control" id="descridbienmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">color:</label>
                                                            <input type="text" class="form-control" id="colorvermovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Modelo:</label>
                                                            <input type="text" class="form-control" id="modeloinmovi"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">serie:</label>
                                                            <input type="text" class="form-control" id="serieinmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Marca:</label>
                                                            <input type="text" class="form-control" id="marcainmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Fecha
                                                                Adquisición:</label>
                                                            <input type="text" class="form-control" id="fechainmovi"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Valor de
                                                                Adquisición:</label>
                                                            <input type="text" class="form-control" id="valorinmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Proveedor:</label>
                                                            <input type="text" class="form-control" id="id_proveedor"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Código:</label>
                                                            <input type="text" class="form-control" id="codigoinmovi"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Estado del
                                                                Bien:</label>
                                                            <input type="text" class="form-control" id="estadoinmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Jefe
                                                                Responsable:</label>
                                                            <input type="text" class="form-control" id="jefeinvenmovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Categoria:</label>
                                                            <input type="text" class="form-control" id="id_categoria"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Tipo
                                                                Registro:</label>
                                                            <input type="text" class="form-control" id="tiporemo"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Fecha
                                                                Movimiento:</label>
                                                            <input type="text" class="form-control" id="fechamovii"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Unidad Movimiento:</label>
                                                            <input type="text" class="form-control" id="unimovii"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <!----------------------------------este es el div de lo de vehiculo  ----------------------------------------->
                                                    <div class="row my-4" id="ocultarverdatosi" style="display:none">
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">No. Motor:</label>
                                                            <input type="text" class="form-control" id="motorimovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">No. Placa:</label>
                                                            <input type="text" class="form-control" id="placaimovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">No. Chasis:</label>
                                                            <input type="text" class="form-control" id="chasisimovi"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputZip" class="form-label">Capacidad:</label>
                                                            <input type="text" class="form-control" id="capaimovi"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-coreui-dismiss="modal">Cerrar</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--///////////////TERMINA MODAL VER ///////////////////////////////////////////////////////////////-->
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
            </div>
            <!-- ///////FIN CONTENEDOR/////////////-->
        </div>
        <!-- MODAL REPORTE -->
        <div class="modal fade" id="modalRe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REPORTE DE MOVIMIENTOS</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <center>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <label class="form-label" for="validationCustom04">Tipo de Movimiento: </label>
                                <select class="form-select" required id="movimiento1" name="movimiento1">
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div><br>
                            <div class="col-md-6">
                                <label class="form-label" for="validationCustom04">Código: </label>
                                <select class="form-select" required id="codigoTipoMovimiento" name="codigoTipoMovimiento">
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>
                        </div>
                    </center>
                    <div class="modal-footer">
                        <button type="submit" onclick="" id="GuardaUnidades" class="btn btn-primary">Generar</button>
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>

                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- ////////////////////////////////////////7MODAL REPORTE -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


        <script src="./Controlador/Movimientos/movimiento.js"></script>

        <!-- IMPORTAR ARCHIVO FOOTER-->
        <?php include("foot/foot.php"); ?>
        <!-- IMPORTAR ARCHIVO SCRIPT-->
        <?php include("foot/script.php"); ?>
        <!-- ////////////////////////-->
      <script src="./Controlador/MantenimientoAF/mostrartablamovimientos.js"></script>
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
