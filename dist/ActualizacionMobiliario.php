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
              <span>Mobiliario y Otros</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Catálogo</span>
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
              <div class="card-header"><strong>Tabla de Mobiliario y Otros</strong></div>
              <div class="card-body">
                <!-- dataTable-->
                <table id="mobiliario" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Nombre</th>
                      <th style="text-align:center;">Modelo</th>
                      <th style="text-align:center;">Valor </th>
                      <th style="text-align:center;">Estado</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Nombre</th>
                      <th style="text-align:center;">Modelo</th>
                      <th style="text-align:center;">Valor </th>
                      <th style="text-align:center;">Estado</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </tfoot>
                </table>
                <!-- //dataTable-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
 <!--MODAL VER USUARIO ------------------------------------------------------------------------>
 <!-- Modal -->
<div class="modal fade" id="modalVermo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DE USUARIOS</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row my-4">
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Fecha Adquisición:</label>
              <input type="text" class="form-control" id="fecham" disabled>
            </div>
            <div class="col-md-4">

              <label for="inputZip" class="form-label">Nombre del Bien:</label>
              <input type="text" class="form-control" id="nombrem" disabled>
            </div>
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Modelo:</label>
              <input type="text" class="form-control" id="modelom" disabled>
            </div>
          </div>
          <div class="row my-4">
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Valor de Adquisición:</label>
              <input type="text" class="form-control" id="valorm" disabled>
            </div>
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Descripción:</label>
              <input type="text" class="form-control" id="descrim" disabled>
            </div>
          </div>
          <div class="row my-4">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
   <!--//////////////FIN VER  USUARIO //////////////////////////-->

<!--//////////////EDITAR USUARIO //////////////////////////////////////////////////////////////////////////////////-->
<div class="modal fade" id="modalEditarmo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Datos de Mobiliario</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row my-4">
          <div class="col-md-4">
              <label for="inputZip" class="form-label">Fecha Adquisición:</label>
              <input type="date" class="form-control" id="fechame" >
            </div>
            <div class="col-md-4">
              <input type="hidden" class="form-control" id="_id">
              <label for="inputZip" class="form-label">Nombre del Bien:</label>
              <input type="text" class="form-control" id="nombreme" >
            </div>
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Modelo:</label>
              <input type="text" class="form-control" id="modelome" >
            </div>
          </div>
          <div class="row my-4">
          <div class="col-md-4">
              <label for="inputZip" class="form-label">Valor de Adquisición:</label>
              <input type="text" class="form-control" id="valorme" >
            </div>
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Descripción:</label>
              <input type="text" class="form-control" id="descrime" >
            </div>
          </div>
          <div class="row my-4">
            <div class="modal-footer">
              <button class="btn btn-success" type="button" id="editmobi" name="btnGuardar">Guardar</button>
              <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
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
    <script src="./Controlador/Mobiliarioyotros/mostrarmobi.js"></script>
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
