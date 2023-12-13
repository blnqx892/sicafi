<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->
<script src="js/JsBarcode.all.min.js"></script>

<?php
    $categoria = '';
    // Identificar si se ha seteado la variable get categoria
    if (isset($_GET["categoria"])) {
      // Identificar si la variable get categoria lleva un valor o va nula
      if (!empty($_GET["categoria"])) {
        $categoria = $_GET["categoria"];
      }
    }
    $conexion=mysqli_connect('localhost','root', '', 'sicafi');

    $has_categoria = intval($categoria) != 0;

    $sql= $has_categoria ?
      "SELECT i_s.*, c.nomb_categoria from ingreso_suministros as i_s left join categorias_suministros as c on i_s.categoria_id = c.categoria_id where c.categoria_id = ".$categoria." order by nombre_suministro ASC" :
      "SELECT i_s.*, c.nomb_categoria from ingreso_suministros as i_s left join categorias_suministros as c on i_s.categoria_id = c.categoria_id order by nombre_suministro ASC";

    $nombre = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");

    $sql_categorias = "select * from categorias_suministros order by nomb_categoria";
    $categorias = mysqli_query($conexion, $sql_categorias);
?>

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
                            <span>Suministros</span>
                        </li>
                        <li class="breadcrumb-item">
                            <span>Catálogo de Suministros</span>
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
                                        <strong>Suministros</strong>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary" href="AIngresoSuministros.php">Nuevo <i
                                                class='far fa-plus'></i></a>
                                                <a href="" class="btn btn-outline-info rounded-pill" title="Reporte" data-coreui-toggle="modal"
                      data-coreui-target="#modalRe" data-coreui-whatever="@mdo" style="float: right;"><i
                                        class='fas fa-file-pdf'></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex w-100 justify-content-center">
                                        <!--
                    <label for="cats" class="me-2">Categorias</label>
                    <div class="input-group mb-3">
                      <select name="cats" id="cats_s" class="form-select-sm">
                        <option value="">Todas</option>
                          <?php while($cat = mysqli_fetch_assoc($categorias)) {?>
                          <?php if ($cat["categoria_id"] == $categoria):?>
                            <option value="<?php echo $cat["categoria_id"]?>" selected="selected"><?php echo $cat["nomb_categoria"]?></option>
                          <?php else:?>
                            <option value="<?php echo $cat["categoria_id"]?>"><?php echo $cat["nomb_categoria"]?></option>
                          <?php endif;?>
                        <?php }?>
                      </select>
                      <button type="button" class="btn btn-sm btn-primary" id="cats_b">Filtrar</button>
                    </div>
                  -->
                                    </div>
                                </div>
                                <!-- dataTable-->
                                <table id="miTabla" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="text-align:center;">Codigo de barra</th>
                                            <th style="text-align:center;">Nombre de Suministro</th>
                                            <th style="text-align:center;">Presentación</th>
                                            <th style="text-align:center;">Categoría</th>
                                            <th style="text-align:center;">Stock</th>
                                            <th style="text-align:center;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        <?php $correlativo = 1?>
                                        <?php While($mostrar=mysqli_fetch_assoc($nombre)){?>

                                        <?php
                        $sql_kardex = "select * from kardex where fk_ingreso_suministros = ".$mostrar["id"];
                        $kardex = mysqli_query($conexion, $sql_kardex);

                        $stock = 0;

                        while ($item = mysqli_fetch_array($kardex)) {
                          $stock += $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : ($item["cantidad_salida"] * -1);
                        }
                      ?>
                                        <?php if($mostrar['id'] != 28){ ?>
                                        <tr>
                                            <td><?php echo $correlativo?></td>
                                            <td><?php echo $mostrar['codigo_barra'] ?></td>
                                            <td><?php echo $mostrar['nombre_suministro'] ?></td>
                                            <td><?php echo $mostrar['presentacion'] ?></td>
                                            <td><?php echo $mostrar['nomb_categoria'] ?></td>
                                            <td>
                                                <?php if($mostrar["existencia_maxima"] < $stock):?>
                                                <span class="badge bg-warning text-dark">
                                                    <?php echo $stock ?>
                                                    <svg class="icon icon-sm">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                                        </use>
                                                    </svg>
                                                </span>
                                                <?php elseif ($mostrar["existencia_minima"] > $stock):?>
                                                <span class="badge bg-danger">
                                                    <?php echo $stock ?>
                                                    <svg class="icon icon-sm">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                        </use>
                                                    </svg>
                                                </span>
                                                <?php else:?>
                                                <span class="badge bg-success">
                                                    <?php echo $stock ?>
                                                    <svg class="icon icon-sm">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-check-alt">
                                                        </use>
                                                    </svg>
                                                </span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo 'ShowSuministro.php?id='.$mostrar['id']?>"
                                                    class="btn btn-outline-info rounded-pill" title="Ver"><i
                                                        class='fas fa-eye'></i></a>
                                                <a href="<?php echo 'AIngresoSuministros.php?id='.$mostrar['id']?>"
                                                    class="btn btn-outline-warning rounded-pill" title="Editar"><i
                                                        class="far fa-edit"></i></a>
                                                 <a href="<?php echo './Reportes/Kardex.php?id='.$mostrar['id']?>"
                                                    class="btn btn-outline-info rounded-pill" title="Reporte Kardex"><i
                                                        class='fas fa-file-pdf'></i></a>
                                            </td>
                                        </tr>
                                        <?php $correlativo++?>
                                        <?php } }?>
                                    </tbody>
                                </table>
                                <!-- //dataTable-->
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
            </div>

            <!-- MODAL REPORTE -->
   <?php
     $conexion=mysqli_connect('localhost','root', '', 'sicafi');
        $sql="SELECT * from categorias_suministros order by nomb_categoria ASC";
        $categ = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    ?>
     <div class="modal fade" id="modalRe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <form action="reportes/KCategoria.php" method="post" target="_blank">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REPORTE DE INVENTARIO</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="col-md-6">
                    <label class="form-label" for="validationCustom04">Categoria: </label>
                    <select class="form-select" required id="categoria_id" name="categoria">
                      <?php
                      While($cat=mysqli_fetch_array($categ)){
                        echo '<option value="'.$cat['categoria_id'].'">'.$cat['nomb_categoria'].'</option>';
                      }?>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                  </div>

              </div>

              <div class="modal-footer">
                <button type="submit" id="GuardaUnidades" class="btn btn-primary">Generar</button>
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </form>
      </div>
    </div>
    <!--///////////////////////////////////////////////////////////////////////////////////////////-->
            <!-- ///////FIN CONTENEDOR/////////////-->
        </div>

        <div class="toast-container position-fixed end-0 p-3">
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
        </div>
        <!-- IMPORTAR ARCHIVO FOOTER-->
        <?php include("foot/foot.php"); ?>
        <!-- ////////////////////////-->
        <!-- IMPORTAR ARCHIVO SCRIPT-->
        <?php include("foot/script.php"); ?>
        <!-- ////////////////////////-->
        <script src="js/utils.js"></script>
        <script src="Controlador/Suministros/suministro_index.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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
