<div class="container-fluid">
  <button class="header-toggler px-md-0 me-md-3" type="button"
    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
    <svg class="icon icon-lg">
      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
    </svg>
  </button><a class="header-brand d-md-none" href="#">
    <svg width="118" height="46" alt="CoreUI Logo">
      <use xlink:href="assets/brand/coreui.svg#full"></use>
    </svg></a>
  <!-- Lógica para notificaciones -->
  <?php
  $usuario = $_SESSION['usuarioActivo'];
    $conexion=mysqli_connect("localhost", "root", "", "sicafi");
    $sql_suministros = "select * from ingreso_suministros";
    $suministros = mysqli_query($conexion, $sql_suministros);

    $out_stock = array();

    while($suministro = mysqli_fetch_array($suministros)) {
      $sql_kardex = "select * from kardex where fk_ingreso_suministros = ".$suministro["id"];

      $kardex = mysqli_query($conexion, $sql_kardex);
      $stock = 0;

      while ($item = mysqli_fetch_array($kardex)) {
        $stock += $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : ($item["cantidad_salida"] * -1);
      }

      $out_stock_item = null;
      // Evaluar cantidad mínima
      if ($stock < $suministro["existencia_minima"]) {
        $out_stock_item["id"] = $suministro["id"];
        $out_stock_item["nombre"] = $suministro["nombre_suministro"];
        $out_stock_item["actual"] = $stock;
        $out_stock_item["ideal"] = $suministro["existencia_minima"];
        $out_stock_item["tipo"] = "bajo";
        $out_stock[] = $out_stock_item;
      }
      // Evaluar cantidad máxima
      if ($stock > $suministro["existencia_maxima"]) {
        $out_stock_item["id"] = $suministro["id"];
        $out_stock_item["nombre"] = $suministro["nombre_suministro"];
        $out_stock_item["actual"] = $stock;
        $out_stock_item["ideal"] = $suministro["existencia_maxima"];
        $out_stock_item["tipo"] = "alto";
        $out_stock[] = $out_stock_item;
      }
    }

    $total_stock = count($out_stock);
  ?>
  <!-- Notificaciones -->
  <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
  <ul class="header-nav ms-auto">
    <li class="nav-item dropdown d-md-down-none position-relative">
      <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-lg my-1 mx-2">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
        </svg>
        <?php if($total_stock > 0): ?>
          <span class="badge rounded-pill position-absolute top-0 end-0 bg-danger">
            <?php echo $total_stock; ?>
          </span>
        <?php endif; ?>
      </a>
      <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
        <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10">
          <strong>Suministros fuera de stock</strong>
        </div>
        <?php if($total_stock > 0): ?>
          <?php $limit_record = $total_stock > 3 ? 4 : $total_stock;?>
          <?php for ($i = 0; $i < $limit_record; $i++):?>
            <a class="dropdown-item" href="<?php echo 'ShowSuministro.php?id='.$out_stock[$i]["id"]?>">
              <div class="message">
                <div>
                  <small class="text-medium-emphasis">
                    <?php if($out_stock[$i]["tipo"] == "bajo"):?>
                      <span class="badge bg-danger">Mínimo</span>
                    <?php else:?>
                      <span class="badge bg-warning text-dark">Máximo</span>
                    <?php endif;?>
                  </small>
                  <small class="text-medium-emphasis float-end mt-1">
                    <span class="text-danger"><?php echo $out_stock[$i]["actual"];?></span>/<?php echo $out_stock[$i]["ideal"]?>
                  </small>
                </div>
                <div class="font-weight-bold text-truncate">
                  <?php echo $out_stock[$i]["nombre"];?>
                </div>
              </div>
            </a>
          <?php endfor;?>
          <?php if($total_stock > 4): ?>
            <a class="dropdown-item" href="TablaSumi.php">
              <div class="message">
                <div class="font-weight-bold">
                  <i>
                    Otros <?php echo ($total_stock - $limit_record);?> elemento(s)
                  </i>
                </div>
              </div>
            </a>
          <?php endif;?>
        <?php else: ?>
          <a class="dropdown-item" href="TablaSumi.php">
            <div class="message">
              <div class="font-weight-bold">
                <i>
                  No hay elementos fuera de stock
                </i>
              </div>
            </div>
          </a>
        <?php endif; ?>
        <a class="dropdown-item text-center border-top" href="TablaSumi.php"><strong>Ver todos</strong></a>
      </div>
    </li>
  </ul>
  <?php } ?>

  <ul class="header-nav ms-3">
    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
        aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-md"><img class="avatar-img" src="img/usua.png" alt="user@email.com">
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end pt-0">
        <div class="dropdown-header bg-light py-2">
          <div class="fw-semibold">Usuario</div>
        </div><a class="dropdown-item" href="#">
          <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
          </svg><?php echo $usuario['nombre'] . ' ' . $usuario['apellido'];;?></a><a class="dropdown-item" href="#">
        <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="cerrar.php">
          <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
          </svg> Cerrar Sesión</a>
      </div>
    </li>
  </ul>
</div>
