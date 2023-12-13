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
                            <!-- if breadcrumb is single--><span>Adquisiciones</span>
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
                            <div class="card-header"><strong>Inventario General</strong></div>
                            <div class="card-body">
                                <!--INICIO FORM-->
                                <form class="g-3 needs-validation" novalidate="">
                                    <div class="row  my-4">
                                        <div>
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Codigó</th>
                                                        <th>Nombre</th>
                                                        <th>Categoria</th>
                                                        <th>Tipo Cargo</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>0003</th>
                                                        <th>CM</th>
                                                        <th>Lapiz facela</th>
                                                        <th>3</th>
                                                        <th>
                                                            <button type="button"
                                                                class="btn btn-danger rounded-pill"><svg
                                                                    class="icon me-2">
                                                                    <use
                                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash">
                                                                    </use>
                                                                </svg> Eliminar</button>
                                                                <button type="button"
                                                                class="btn btn-danger rounded-pill"><svg
                                                                    class="icon me-2">
                                                                    <use
                                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#fi fi-rr-eye">
                                                                    </use>
                                                                </svg> Ver</button>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--FIN SECCION TRES-->
                                    <!--FIN SECCION CUATRO-->
                               
                                </form>
                                <!--/// FIN FORM ////////////////-->
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
            </div>
            <!-- ///////FIN CONTENEDOR/////////////-->

            <!-- IMPORTAR ARCHIVO FOOTER-->
            <?php include("foot/foot.php"); ?>
            <!-- ////////////////////////-->
        </div>
        <!-- IMPORTAR ARCHIVO SCRIPT-->
        <?php include("foot/script.php"); ?>
        <!-- ////////////////////////-->
</body>

</html>