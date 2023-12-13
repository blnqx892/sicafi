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
                            <span>Control de  Entradas</span>
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
                            <div class="card-header"><strong>Actualizacion Entradas</strong></div>
                            <div class="card-body">

                                <!-- dataTable-->
                                <table id="entra" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">N° Factura</th>
                                            <th style="text-align:center;">Nombre</th>
                                            <th style="text-align:center;">Marca</th>
                                            <th style="text-align:center;">Categoria</th>
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align:center;">N°</th>
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">N° Factura</th>
                                            <th style="text-align:center;">Nombre</th>
                                            <th style="text-align:center;">Marca</th>
                                            <th style="text-align:center;">Categoria</th>
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
 <!--------------------------- //dataTable-------------------------------------------------------------------->
 <!--MODAL VER USUARIO -->
 <div class="modal fade" id="modalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN
                    INGRESO DE ACTIVOS</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Fecha:</label>
                            <input type="text" class="form-control" id="fechae" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">N° Fatura:</label>
                            <input type="text" class="form-control" id="factu" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Costo
                                Adquisición:</label>
                            <input type="text" class="form-control" id="cos" disabled>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Proveedor:</label>
                            <input type="text" class="form-control" id="id_proveedor" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" id="nombre" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Serie:</label>
                            <input type="text" class="form-control" id="serie" disabled>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Color:</label>
                            <input type="text" class="form-control" id="color" disabled>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Tipo Cargo:</label>
                            <input type="text" class="form-control" id="cargo" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Vida Util:</label>
                            <input type="text" class="form-control" id="vida" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Categoria:</label>
                            <input type="text" class="form-control" id="id_categoria" disabled>
                        </div>
                    </div>
                    <div class="row my-4" id="ocultarver" style="display:none">
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">No. Motor:</label>
                            <input type="text" class="form-control" id="motor" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">No. Placa:</label>
                            <input type="text" class="form-control" id="placa" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">No. Chasis:</label>
                            <input type="text" class="form-control" id="chasis" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">Capacidad:</label>
                            <input type="text" class="form-control" id="capa" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--///////////////TERMINA MODAL VER ///////////////////////////////////////////////////////////////-->

<!-------------------MODAL EDITAR ENTRADAS ----------------------------------------------------------->
<!-- Modal -->

<div class="modal fade" id="modale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN
          INGRESO DE ACTIVOS</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row my-4">
              <div class="col-md-4">
                 <label for="inputZip" class="form-label">Fecha:</label>
                 <input type="text" class="form-control" id="fechaee">
               </div>
               <div class="col-md-4">
                 <label for="inputZip" class="form-label">N° Fatura:</label>
                 <input type="text" class="form-control" id="fact">
               </div>
               <div class="col-md-4">
              <label for="inputZip" class="form-label">Costo Adquisición:</label>
              <input type="text" class="form-control" id="cost">
              </div>
          </div>
          <div class="row my-4">
              <div class="col-md-4">
                 <label class="form-label" for="validationCustom04">Proveedor: </label>
                 <select class="form-select" required id="proveedor_id" name="proveC">
                 </select>
                 <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="col-md-4">
                 <input type="hidden" class="form-control" id="_id">
                 <label for="inputZip" class="form-label">Descripción:</label>
                 <input type="text" class="form-control" id="nombree">
              </div>
             <div class="col-md-4">
                 <label for="inputZip" class="form-label">Serie:</label>
                 <input type="text" class="form-control" id="seriee">
              </div>
          </div>
          <div class="row my-4">
              <div class="col-md-4">
                 <label for="inputZip" class="form-label">Marca:</label>
                 <input type="text" class="form-control" id="marcae">
              </div>
              <div class="col-md-4">
                 <label for="inputZip" class="form-label">Modelo:</label>
                 <input type="text" class="form-control" id="modeloe">
              </div>
              <div class="col-md-4">
                 <label for="inputZip" class="form-label">Color:</label>
                 <input type="text" class="form-control" id="colore">
              </div>
          </div>
          <!----------------------------este es el div de lo de vehiculo  --------------------------------->
          <div class="row my-4">
             <div class="col-md-4">
                  <label class="form-label" for="validationCustom04">Tipo de Cargo: </label>
                  <select class="form-select" required="" id="cargoe" name="cargoC">
                  <option selected="" disabled="" value="">Elegir Tipo</option>
                  <option value="Comprado">Comprado</option>
                  <option value="Donado">Donado</option>
                  </select>
                  <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <!--<div class="col-md-4">
                  <label for="inputZip" class="form-label">Vida Util:</label>
                  <input type="text" class="form-control" id="vidae">
              </div>-->
              <div class="col-md-4">
                  <label class="form-label" for="validationCustom04">Categoria</label>
                  <select class="form-select" required id="categoria_id" name="cateC">
                  </select>
                  <div class="invalid-feedback">Please select a valid state.</div>
              </div>
          </div>
 <!-------------------------------------------------------------------------------------------->

            <div class="row my-4" id="ocultar" style="display:none">
              <div class="col-md-4">
                <label for="inputZip" class="form-label">No. Motor:</label>
                <input type="text" class="form-control" id="motore">
              </div>

              <div class="col-md-4">
                <label for="inputZip" class="form-label">No. Placa:</label>
                <input type="text" class="form-control" id="placae">
              </div>

              <div class="col-md-4">
                <label for="inputZip" class="form-label">No. Chasis:</label>
                <input type="text" class="form-control" id="chasise">
              </div>

              <div class="col-md-4">
                <label for="inputZip" class="form-label">Capacidad:</label>
                <input type="text" class="form-control" id="capae">
              </div>
            </div>
            <div class="row my-4">
              <div class="modal-footer">
                <button class="btn btn-success" type="button" id="edite" name="btnGuardar">Guardar</button>
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--//////////////////TERMINA MODAL EDITAR//////////////////////////////////////////////////////////////////////////////-->

 <!-- -------------------------apate------------------------------------------- -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
                <!-- ///////FIN CONTENEDOR/////////////-->
            </div>
        </div>
        
        <!-- IMPORTAR ARCHIVO FOOTER-->
        <?php include("foot/foot.php"); ?>
        <!-- ////////////////////////-->
        <!-- IMPORTAR ARCHIVO SCRIPT-->
        <?php include("foot/script.php"); ?>
        <!-- ////////////////////////-->
     <script src="./Controlador/Entradas/mostrarentra.js"></script>
     <script src="./Controlador/Entradas/entradas.js"></script>
     <script src="./Controlador/Proveedores/proveedor.js"></script>
     <script src="./Controlador/Categorias/categoria.js"></script>
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