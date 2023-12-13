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
              <span>Movimientos</span>
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

            <div class="card-header"><strong>Traslado de Bienes Muebles</strong></div>
              <div class="card-body">
<!--------------------------INICIO FORM--------------------------------------------------->
                <form id="formM" class="g-3 needs-validation"
                action="AsignaciondeActivo.php"
                method="POST"
                autocomplete="off">
                <input type="hidden" id="categoria" name="categoria" type="text">
                <input type="hidden" id="encargado" name="encargado" type="text">
                <input type="hidden" id="id_jefe" name="id_jefe" type="text">
                <input type="hidden" id="codigo_id_id" name="codigo_id_id" type="text">
                <input type="hidden" id="codigo_id_txt" name="codigo_id_txt" type="text">
                <input type="hidden" id="ingreso_entrada_id" name="ingreso_entrada_id" type="text">
                <input type="hidden" value="Guardar" name="bandera">
                <h4>Generalidades</h4>
                  <div class="row my-4">
                    <div class="col-md-3">
                      <label class="form-label" for="validationCustom02">Buscar por Codigo:</label>
                      <select class="form-control js-example-basic-single  once-validate-1" required id="codigo_id" name="codigo_id">
                        <option value=""></option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="validationCustom01">Fecha:</label>
                      <input class="form-control once-validate-1" id="fecha_movimiento" type="date" required="" disabled>
                   </div>
                   <div class="col-md-3">
                      <label class="form-label" for="validationCustom02">Procedencia:</label>
                      <input class="form-control" id="nombre_unidad" type="text" required="" disabled>
                   </div>
                   <div class="col-md-3" id="div-destino">
                      <label class="form-label" for="validationCustom02">Destino:</label>
                      <select class="form-select " id="unidad_id" name="rolCU" data-placeholder="Seleccione la Unidad" disabled> </select>
                      <div class="invalid-feedback">Please select a valid state.
                   </div>
                  </div>
                  </div>
                  <hr style="color: black; background-color: black; width:100%;" />
 <!--FIN BUSCADOR------------------------------------------------------------------------------>
 <div class="row my-4">

    <div class="col-md-3">
      <label class="form-label" for="validationCustom04">Tipo de Movimiento:</label>
      <select class="form-select once-validate-1" id="perC"
      name="perC" data-placeholder="Seleccione un Movimiento" disabled>
      <option selected="" disabled="" value="">Elegir Tipo Movimiento</option>
        <option  value="Prestamo"> Prestamo</option>
        <option  value="Traslado Definitivo">Traslado Definitivo</option>
        <option  value="Reparación">Reparación</option>
      </select>
      <div class="invalid-feedback">Please select a valid state.</div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="validationCustom02">Observaciones:</label>
        <textarea class="form-control" id="observacion" required="" rows="2" disabled></textarea>
    </div>
</div>
<!--FIN------------------------------------------------------------------------------------------->
<hr style="color: black; background-color: black; width:100%;" />
<h4>Caracteristicas</h4>
<hr style="color: black; background-color: black; width:100%;" />

<div class="row my-4">
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Descripción del bien:</label>
        <input class="form-control" id="nombre_adquisicion" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Valor adquisición:</label>
        <input class="form-control" id="costo_adquisicion" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Vida Util:</label>
        <input class="form-control" id="vida_util" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Color:</label>
        <input class="form-control" id="color" type="text" required="" disabled>
    </div>
</div>
<div class="row my-4">
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Modelo:</label>
        <input class="form-control" id="modelo" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Serie:</label>
        <input class="form-control" id="serie_adquisicion" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Marca:</label>
        <input class="form-control" id="marca" type="text" required="" disabled>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="validationCustom02">Codigo:</label>
        <input class="form-control" id="codigo_institucional" type="text" required="" disabled>
    </div>
</div>

<!--FIN------------------------------------------------------------------------------------------->
                  <div class="col-15" align="right">
                    <hr style="color: black; background-color: black; width:100%;" />
                    <button class="btn btn-success"  type="button" id="GuardaMovimientos" name="btnGuardar">Guardar <i class='far fa-check-square'></i></button>
                      <button class="btn btn-secondary" type="reset">Cancelar <i
                          class='far fa-times-circle'></i></button>
                  </div>
                </form>
<!--/// FIN FORM ////////////////-->
              </div>
            </div>
          </div>
<!------------------------- /.row-->
        </div>
      </div>
<!-- ///////FIN CONTENEDOR/////////////-->
    </div>


    <script src="./Controlador/CredencialesA/credenciales.js"></script>

    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <script src="./Controlador/MantenimientoAF/mostrar_camposprestamo.js"></script>
    <script src="./Controlador/MantenimientoAF/movimientos_guardar.js"></script>

</body>
</html>
<?php
}else{
    ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="0;URL=/coreu/index.php">
</head>

<body>
</body>

</html>
<?php
}
?>
