<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="Controlador/Suministros/suministro.js"></script>
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->

<body>
<div class="row" id="bbc" style="display:none;">
  <div class="col-md-3">
    <svg id="barcode_print" width="100%"></svg>
  </div>
</div>
<div id="bbody">
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
            <li class="breadcrumb-item active">
              <span>Ingreso de Suministros</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR-->
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
      <?php include("toast/toast.php"); ?>
        <?php
        $conexion=mysqli_connect('localhost','root', '', 'sicafi');

        $sql_categorias = "select * from categorias_suministros order by nomb_categoria";
        $categorias = mysqli_query($conexion, $sql_categorias);
        ?>
        <!-- row-->
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header"><strong>Ingreso de Suministros</strong></div>
              <div class="card-body">
                <!--INICIO FORM-->
                <form class="g-3 needs-validation" action="Controlador/IngresoSuministrosC.php" method="POST"
                  autocomplete="off">
                  <!--INICIO SECCION FECHA-->
                  <!--<div class="col-md-3">
                      <label for="inputZip" class="form-label">Codigo (ID):</label>
                      <input type="text" class="form-control" id="id" name="codigo" disabled placeholder="Se genera automáticamente">
                    </div>-->
                  <div class="row">
                      <div class="col-md-3">
                      <label for="inputZip" class="form-label">Codigo de Barra:</label>
                      <input type="text" class="form-control v-required-1" id="codigo_barra" name="codigob">
                    </div>
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Nombre del Artículo:</label>
                      <input type="text" class="form-control v-required-1" id="nombre_suministro" name="tarjeta">
                    </div>
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Presentación:</label>
                      <input type="text" class="form-control v-required-1" id="presentacion">
                    </div>
                  </div>
                  <!--FIN SECCION DOS-->
                  <div class="row  my-4">
                    <!--INICIO SECCION TRES-->
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Existencia Mínima:</label>
                      <input type="number" min="0" step="0.01" class="form-control v-required-1 v-min-1" id="existencia_minima" data-min="0">
                    </div>
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Existencia Máxima:</label>
                      <input type="number" min="0" step="0.01" class="form-control v-required-1 v-min-1" id="existencia_maxima" data-min="0" data-minthan="existencia_minima">
                    </div>
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Categoria:</label>
                      <select name="cats" id="categorias" class="form-select">
                        <?php while($cat = mysqli_fetch_assoc($categorias)) {?>
                          <option value="<?php echo $cat["categoria_id"]?>"><?php echo $cat["nomb_categoria"]?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
   <!--FIN ----------------->
                  <div class="row">
                    <div class="col-md-3">
                      <div class="row">
                        <div class="col-12">
                          <svg id="barcode" width="100%"></svg>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <button class="btn btn-sm col-8 btn-outline-info" id="print_bc" type="button" style="display: none">Imprimir</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row  my-4">
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label"></label>
                      <button class="btn btn-success mt-3" type="button" data-coreui-toggle="modal"
                        data-coreui-target="#modalAgg" id="add_kardex">Agregar <i class='far fa-check-square'></i></button>
                    </div>
                  </div>
                  <div class="row  my-4">
                    <div>
                      <table class="table" style="text-align:center;" id="kardex_tabla">
                        <thead class="table-dark">
                          <tr>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Fondo Procedencia</th>
                            <th>Cantidad entrada</th>
                            <th>Cantidad salida</th>
                            <th>Precio entrada</th>
                            <th>Precio salida</th>
                            <th>Saldo</th>
                          </tr>
                        </thead>
                        <tbody id="kardex_body">
                          <tr>
                            <th>0003</th>
                            <th>CM</th>
                            <th>Lapiz facela</th>
                            <th>3</th>
                            <th>3</th>
                            <th>3</th>
                            <th>3</th>
                            <th>3</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--FIN SECCION CUATRO-->

                  <div class="col-15" align="right">
                    <hr style="color: black; background-color: black; width:100%;" />
                    <button class="btn btn-success " type="button" id="save_record">Guardar <i class='far fa-check-square'></i></button>
                    <a class="btn btn-secondary" href="TablaSumi.php">Cancelar <i class='far fa-times-circle'></i></a>
                   
                  </div>
                </form>
                <!--/// FIN FORM ////////////////-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalAgg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
              <input type="hidden" value="Guardar1" name="bandera">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Insumos</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row my-4">
                    <div class="col-md-4">
                      <?php
                       $fecha_actual = date("Y-m-d"); // fecha actual, value con min el cual evita seleccionar fechas anteriores
                      ?>
                      <label for="inputEmail4" class="form-label">Fecha:</label>
                      <input type="date" class="form-control v-required-2" value="<?php echo $fecha_actual; ?>"
                        min="<?php echo $fecha_actual; ?>" id="fechaC" name="fechaC">
                    </div>
                  </div>
                  <div class="row my-4">
                    <div class="col-md-6">
                      <label for="inputCity" class="form-label">Concepto:</label>
                      <input type="text" class="form-control v-required-2" id="concepto" name="nombreProv">
                    </div>
                    <div class="col-md-5">
                      <label class="form-label" for="validationCustom04">Fondo Procedencia: </label>
                      <select class="form-select v-required-2" required="" id="fondo_procedencia" name="cargoC">
                        <option selected="" disabled="" value="-1">Elegir Fondo</option>
                        <option value="1">Fondos Propios</option>
                        <option value="2">Fondos Fodes</option>
                        <option value="3">Donativos</option>
                      </select>
                    </div>
                  </div>
                  <div class="row my-4">
                  <div class="col-md-5">
                      <label class="form-label" for="validationCustom04">Tipo de movimiento:</label>
                      <select class="form-select v-required-2" required="" id="tipo_movimiento" name="cargoC">
                        <option selected="" disabled="" value="-1">Elegir Movimiento</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="inputCity" class="form-label">Cantidad:</label>
                      <input type="number" min="1.00" step="0.01"  class="form-control v-required-2 v-min-2" id="cantidad" name="nombreProv" data-min="1.00">
                    </div>
                    <div class="col-md-3">
                      <label for="inputCity" class="form-label">Precio:</label>
                      <input type="number" min="0.00" step="0.01"  class="form-control v-required-2 v-min-2" id="precio" name="nombreProv" data-min="0.00">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="save_item" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--////////////////////////////////////////-->
      </div>
      <!-- ///////FIN CONTENEDOR/////////////-->

      <!-- IMPORTAR ARCHIVO FOOTER-->
      <?php include("foot/foot.php"); ?>
      <!-- ////////////////////////-->
    </div>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <!-- <div class="toast-container position-fixed end-0 p-3">
      <div id="liveToast" class="toast text-bg-success " role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <div class="rounded me-2"></div>
          <strong class="me-auto" id="toast_title">Acción exitosa</strong>
          <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast_body">
          Registro guardado
        </div>
      </div>
    </div>-->
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
