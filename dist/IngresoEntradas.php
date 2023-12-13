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
              <span>Control de Adquición</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Ingreso de Entradas</span>
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
              <div class="card-header"><strong>Ingreso de Entradas</strong></div>
              <div class="card-body">
                <!--INICIO FORM-->
                <form id="formE" class="g-3 needs-validation" action="" method="POST" autocomplete="off">
                  <input type="hidden" value="Guardar" name="bandera">
                  <!--INICIO SECCION FECHA-->
                  <div class="row">
                    <div class="col-md-4">
                      <?php
                       $fecha_actual = date("Y-m-d"); // fecha actual, value con min el cual evita seleccionar fechas anteriores
                      ?>
                      <label for="inputEmail4" class="form-label">Fecha de Adquisición:</label>
                      <input type="date" class="form-control mi-validate-1" value="<?php echo $fecha_actual; ?>"
                        min="<?php echo $fecha_actual; ?>" id="fechaC" name="fechaC">
                    </div>
                  </div>
                  <!--FIN SECCION FECHA-->
                  <div class="row  my-4">
                    <!--INICIO SECCION DOS-->
                    <div class="col-md-4">
                      <label for="inputEmail4" class="form-label">N° de Factura:</label>
                      <input type="text" class="form-control " id="facturaC" name="facturaC" >
                    </div>
                    <div class="col-md-4">
                      <label for="inputAddress2" class="form-label">Valor de Adquisición:</label>
                      <input type="number" class="form-control mi-validate-1" placeholder="" id="costoC" name="costoC">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="validationCustom04">Proveedor: </label>
                      <select class="form-select" required id="proveedor_id" name="proveC">
                      </select>
                      <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="col-md-1">
                      <label for="inputCity" class="form-label">Nuevo</label>
                      <button type="button" title="Nuevo Proveedor" class="btn btn-primary" data-coreui-toggle="modal"
                        data-coreui-target="#modalProv">
                        <i class='fas fa-plus'></i>
                      </button>
                    </div>
                  </div>
                  <!--FIN SECCION DOS-->
                  <div class="row  my-4">
                    <!--INICIO SECCION TRES-->
                    <div class="col-md-4">
                      <label for="inputCity" class="form-label">Descripción del bien:</label>
                      <input type="text" class="form-control mi-validate-1" id="nombreC" name="nombreC">
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Serie:</label>
                      <input type="text" class="form-control" id="serieC" name="serieC">
                    </div>
                    <div class="col-md-3">
                      <label for="inputZip" class="form-label">Marca:</label>
                      <input type="text" class="form-control " id="marcaC" name="marcaC">
                    </div>
                  </div>
                  <!--FIN SECCION TRES-->
                  <div class="row  my-4">
                    <!--INICIO SECCION CUATRO-->
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Modelo:</label>
                      <input type="text" class="form-control" id="modeloC" name="modeloC">
                    </div>
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Color:</label>
                      <input type="text" class="form-control mi-validate-1" id="colorC" name="colorC">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="validationCustom04">Tipo de Cargo: </label>
                      <select class="form-select mi-validate-1" required="" id="cargoC" name="cargoC">
                        <option selected="" disabled="" value="">Elegir Tipo</option>
                        <option value="Comprado">Comprado</option>
                        <option value="Donado">Donado</option>
                        <option value="Otros">Otros</option>
                      </select>
                      <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                  </div>
                  <!--FIN SECCION CUATRO-->
                  <!--INICIO SECCION CINCO-->
                  <div class="row my-4">
                    <div class="col-md-4">
                      <label for="inputZip" class="form-label">Vida Util: (en años)</label>
                      <input type="number" class="form-control" id="vidaAnio" name="vidaAnio" disabled>
                    </div>
                    <div class="col-md-4" style="display:none">
                      <label for="inputZip" class="form-label">Valor Rescate:</label>
                      <input type="number" class="form-control" id="vidaC" name="vidaC">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom04">Categoria</label>
                      <select class="form-select mi-validate-1" required id="categoria_id" name="cateC">
                      </select>
                      <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="col-md-1">
                      <label for="inputCity" class="form-label">Nuevo</label>
                      <button type="button" title="Nueva Categoria" class="btn btn-primary" data-coreui-toggle="modal"
                        data-coreui-target="#modalCate">
                        <i class='fas fa-plus'></i>
                      </button>
                    </div>
                  </div>
                  <!--FIN SECCION CINCO-->
                  <!--INICIO SECCION SEIS-->
                  <div class="row  my-2">
                    <div class="col-md-1">
                      <label class="form-check-label" for="flexSwitchCheckChecked">Transporte</label>
                      <div class="form-check form-switch">
                        <input value="off" class="form-check-input" type="checkbox" role="switch" name="trans"
                          id="flexSwitchCheckChecked" name="activarFormulario" onclick="mostrarFormulario()">
                      </div>
                    </div>
                  </div>
                  <div id="formulario" style="display:none;">
                    <hr style="color: black; background-color: black; width:100%;" />
                    <div class="row my-1">
                      <div class="col-md-3">
                        <label for="inputZip" class="form-label">No. Motor:</label>
                        <input type="text" class="form-control" id="motorC" name="motorC">
                      </div>
                      <div class="col-md-3">
                        <label for="inputZip" class="form-label">No. Placa:</label>
                        <input type="text" class="form-control" id="placaC" name="placaC">
                      </div>
                      <div class="col-md-3">
                        <label for="inputZip" class="form-label">No. Chasis:</label>
                        <input type="text" class="form-control" id="chasisC" name="chasisC">
                      </div>
                      <div class="col-md-2">
                        <label for="inputZip" class="form-label">Capacidad:</label>
                        <input type="number" class="form-control" id="capacidadC" name="capacidadC">
                      </div>
                    </div>
                  </div>
                  <!--FIN SECCION CUATRO-->
                  <div class="col-15" align="right">
                    <hr style="color: black; background-color: black; width:100%;" />
                    <button class="btn btn-success" type="submit" id="GuardaEntradas" name="btnGuardar">Guardar <i
                        class='far fa-check-square'></i>
                    </button>
                    <button class="btn btn-secondary" type="reset">Cancelar <i class='far fa-times-circle'></i>
                    </button>
                  </div>
                </form>
                <!--/// FIN FORM ////////////////-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
      <!-- ///////FIN CONTENEDOR/////////////-->
      <!--MODAL PROVEEDOR -->
      <!-- Modal -->
      <div class="modal fade" id="modalProv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
            <input type="hidden" value="Guardar1" name="bandera">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Proveedor</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Nombre:</label>
                  <input type="text" class="form-control cuatro-validate-1" id="nombreProv" name="nombreProv">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="GuardaProveedor" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!--////////////////////////////////////////-->
      <!--MODAL CATEGORIA-->
      <!-- Modal -->
      <div class="modal fade" id="modalCate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="g-3 needs-validation" action="" method="POST" autocomplete="off">
            <input type="hidden" value="Guardar2" name="bandera">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Categoria</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row my-4">
                  <div class="col-md-6">
                    <label for="inputCity" class="form-label">Nombre:</label>
                    <input type="text" class="form-control cinco-validate-1" id="nombreCate" name="nombreCate">
                  </div>
                  <div class="col-md-6">
                    <label for="inputCity" class="form-label">Vida Util:</label>
                    <input type="number" class="form-control cinco-validate-1" id="vidaUtil" name="vidaUtil">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="GuardaCategoria" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!--////////////////////////////////////////-->
    </div>
    
   
    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- ////////////////////////-->
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <script src="./Controlador/Entradas/entradas.js"></script>
    <script src="./Controlador/Proveedores/proveedor.js"></script>
    <script src="./Controlador/Categorias/categoria.js"></script>
    
    <script>
      function mostrarFormulario() {
        var formulario = document.getElementById("formulario");

        //alert(formulario.style.display);

        if (formulario.style.display === "none") {

          formulario.style.display = "block";
          $("#flexSwitchCheckChecked").val("");
          $("#flexSwitchCheckChecked").val("on");
          $("#motorC").addClass('mi-validate-1');
          $("#chasisC").addClass('mi-validate-1');
          $("#placaC").addClass('mi-validate-1');
          $("#capacidadC").addClass('mi-validate-1');

        } else {
          formulario.style.display = "none";
          $("#flexSwitchCheckChecked").val("");
          $("#flexSwitchCheckChecked").val("off");
          $("#motorC").removeClass('mi-validate-1');
          $("#chasisC").removeClass('mi-validate-1');
          $("#placaC").removeClass('mi-validate-1');
          $("#capacidadC").removeClass('mi-validate-1');

        }
      }

    </script>
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
