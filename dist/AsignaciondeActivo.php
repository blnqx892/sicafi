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
              <span>Control Adquisición</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Asignación de Activo</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR---------------------------------------------------->
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
      <?php include("toast/toast.php"); ?>
        <!-- row-->
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
                <input type="hidden" id="jefe_id" name="jefe_id" value="<?php echo $_POST['id_jefe'] ?? ''; ?>" >
              <div class="card-header"><strong>Asignación de Activo</strong></div>
              <div class="card-body">
                <!--INICIO FORM-->
                <form id="formasigna" class="g-3 needs-validation" role="form" action="" method="POST" autocomplete="off">
                  <!----------------------------------------------INICIO----------------------------------------------------------->
                  <div class="row">
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom01">Fecha Asignación:</label>
                      <input class="form-control codasig-validate-1" id="fechaA" type="date" required="" >
                    </div>
                  </div>
                  <!--FIN-->
                  <div class="row  my-4">
                    <div class="col-md-4">

                    <input type="hidden" value="<?php echo $_POST['codigo_id_txt'] ?? ''; ?>" id="codigo_institucional">
                     <input type="hidden" class="form-control" id="_id" value="<?php echo ($_POST['ingreso_entrada_id']?? FALSE) ? $_POST['ingreso_entrada_id'] :  $_GET['a'];?>">
                     <input type="hidden" class="form-control" id="id_asignacion" value="<?php echo $_POST['codigo_id_id']??'';?>">
                      <label class="form-label" for="validationCustom02">Descripción del bien:</label>
                      <input class="form-control" id="nombreA" type="text" required=""  value="<?php echo $_POST['nombre_adquisicion'] ?? '';?>"  disabled>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom02">Marca:</label>
                      <input type="text" class="form-control" id="marcaA" value="<?php echo $_POST['marca'] ?? '';?>" name="marcaC" required="" disabled>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom02">Color:</label>
                      <input type="text" class="form-control" id="colorA" value="<?php echo $_POST['color'] ?? '';?>" name="colorC" required="" disabled>
                    </div>
                  </div>
                  <div class="row  my-4">
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom02">Serie:</label>
                      <input type="text" class="form-control" id="serieA" name="serieC" required="" value="<?php echo $_POST['serie'] ?? '';?>" disabled>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom04">Categoria: </label>
                      <input type="text" class="form-control" id="categoriaC" name="categoriaC" required="" value="<?php echo $_POST['categoria'] ?? '';?>" disabled>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationCustom05">Modelo</label>
                      <input class="form-control" id="modeloA" name="modeloA" type="text" required="" value="<?php echo $_POST['modelo'] ?? '';?>" disabled>

                    </div>
                  </div>
                  <hr style="color: black; background-color: black; width:100%;" />
                  <!--FIN----------------------------------------------------------------------->
                  <div class="row  my-4">
                    <div class="col-md-4">
                      <!--combo qque vas a ir a guardar en fk_usuarios de ahi solo vas a guardar los campos que estas complentando-->
                      <label class="form-label" for="validationCustom02">Jefe Responsable:</label>
                      <select class="form-select codasig-validate-1" id="nombreC" name="rolCU" data-placeholder="Seleccione la Unidad">
                      </select>
                      <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" id="ubicacion">Ubicación:</label>
                      <input for="#ubicacion" id="ubicacion_value" name="ubicacion_value" class="form-control"
                        disabled></input>
                    </div>
                      <div class="col-md-4">
                      <label class="form-label" for="validationCustom02">Codigo:</label>
                        <div class="input-group mb-2">
                          <input id="codigoB-1" type="text text-right" class="form-control" max="2" placeholder="00" aria-label="Username">
                          <input id="codigoB-2" type="text" class="form-control" max="11" placeholder="-000-00-00-" <?php echo ($_POST['ingreso_entrada_id']??FALSE) ? 'disabled': '';?> aria-label="Username">
                          <input id="codigoB-3" type="text" class="form-control" max="3" placeholder="000" aria-label="Server">
                        </div>
                      </div>
                    <div class="row  my-4">
                      <div class="col-md-4">
                        <label class="form-label" for="validationCustom02">Encargado del Bien:</label>
                        <input class="form-control codasig-validate-1" id="encargadoA" type="text" required=""  value="<?php echo $_POST['encargado'] ?? '';?>" >
                      </div>
                    </div>
                  </div>
                  <hr style="color: black; background-color: black; width:100%;" />
                  <!--FIN-->
                  <div class="col-12" align="right">
                    <button class="btn btn-success" type="button" id="GuardaCodificacion" name="btnGuardar">Guardar <i
                        class='far fa-check-square'></i></button>
                    <button class="btn btn-secondary" type="reset">Cancelar <i class='far fa-times-circle'></i></button>
                  </div>
                </form>
                <!--/// FIN FORM ////////////////-->
              </div>
            </div>
          </div>
          <!-- /.row------------------------------------------>
        </div>
      </div>
      <!-- ///////FIN CONTENEDOR/////////////-->
    </div>

    <script src="./Controlador/CredencialesA/credenciales.js" type="text/javascript"></script>
    <script src="./Controlador/Categorias/categoria.js" type="text/javascript"></script>
    <script src="./Controlador/CodificacionAF/mostrar_camposformulario.js" type="text/javascript"></script>

    <script type="text/javascript">
       var id = $("#_id").val();
      </script>
    <script>
      $(document).ready(function () {
        // $(":input").inputmask();


        const codigo = $("#codigo_institucional").val()
        $("#codigoA").mask('00-000-00-00-000');
        $("#codigoB-1").mask('00');
        $("#codigoB-2").mask('-000-00-00-');
        $("#codigoB-3").mask('000');

        if((codigo ?? false) && codigo.trim()!==''){
          $("#codigoB-1").mask('00').val(codigo[0]+codigo[1]);
          $("#codigoB-2").mask('-000-00-00-').val('-'+codigo[2]+codigo[3]+codigo[4]+'-'+codigo[5]+codigo[6]+'-'+codigo[7]+codigo[8]+'-');
          $("#codigoB-3").mask('000').val(codigo[9]+codigo[10]+codigo[11]);
        }

      //  function validarUndefined()
      });

    </script>

    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <script src="./Controlador/codificacionAF/codificacion.js"></script>

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
