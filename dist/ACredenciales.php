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
              <span>Unidad y Restricción</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Credenciales</span>
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
              <div class="card-header"><strong>Credenciales Unidades</strong></div>
              <div class="card-body">
                <div class="col-md-14" align="right">
                  <label for="inputCity" class="form-label">Nueva Unidad</label>
                  <button type="button" title="Nueva Unidad" class="btn btn-primary" data-coreui-toggle="modal"
                    data-coreui-target="#modalUni" data-coreui-whatever="@mdo">Ir
                  </button>
                </div>
                <div class="row  my-4">
                  <!-- dataTable-->
                <table id="unidades" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Nombre Unidad</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                  </tbody>
                  <tfoot>
                    <tr>
                       <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Nombre Unidad</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </tfoot>
                </table>
                <!-- //dataTable-->
                <!-- aparte sección ----->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row-->
      </div>
    </div>
    <!-- ///////FIN CONTENEDOR/////////////-->
<!-- MODAL AGREGAR UNIDAD Scrollable modal -->
    <div class="modal fade" id="modalUni" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
            <input type="hidden" value="Guardar1" name="bandera">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Unidad</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <div class="col-md-6">
                  <label for="inputZip" class="form-label">Nombre Unidad:</label>
                  <input type="text" class="form-control unidades-validate-1" id="nombreUnid">
                </div>
          </div>
          <div class="modal-footer">
           <button type="submit" id="GuardaUnidades" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>

          </div>
        </div>
      </form>
      </div>
    </div>
<!--///////////////////////////////////////////////////////////////////////////////////////////-->

   <!-- ///////MODAL VER UNIDADES/////////////-->
    <!-- Scrollable modal -->
    <div class="modal fade" id="modalVerU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
            <input type="hidden" value="Guardar1" name="bandera">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN
                    DE UNIDADES</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <div class="col-md-6">
                  <label for="inputZip" class="form-label">Nombre Unidad:</label>
                  <input type="text" class="form-control" id="nombreveruni" disabled>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>

          </div>
        </div>
      </form>
      </div>
    </div>
<!--///////////////////FIN MODAL VER UNIDADES/////////////////////-->

 <!-- ///////MODAL EDITAR UNIDADES/////////////-->
    <!-- Scrollable modal -->
    <div class="modal fade" id="modalEditarUni" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
            <input type="hidden" value="Guardar1" name="bandera">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN
                    DE UNIDADES</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <div class="col-md-6">
                  <input type="hidden" class="form-control" id="_id">
                  <label for="inputZip" class="form-label">Nombre Unidad:</label>
                  <input type="text" class="form-control" id="nombreediuni" >
                </div>
          </div>
          <div class="modal-footer">
          <button class="btn btn-success" type="button" id="editunid" name="btnGuardar" >Guardar</button>
            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>

          </div>
        </div>
      </form>
      </div>
    </div>
<!--///////////////////FIN MODAL EDITAR UNIDADES/////////////////////-->
  </div>
  
  <!-- IMPORTAR ARCHIVO FOOTER-->
  <?php include("foot/foot.php"); ?>
  <!-- ////////////////////////-->
  <!-- IMPORTAR ARCHIVO SCRIPT-->
  <?php include("foot/script.php"); ?>
  <!-- ////////////////////////-->
  <script src="./Controlador/CredencialesA/mostrarUni.js"></script>
  <script src="./Controlador/CredencialesA/credenciales.js"></script>
 
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
