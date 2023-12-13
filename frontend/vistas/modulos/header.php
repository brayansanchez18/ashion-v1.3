<?php

/* -------------------------------------------------------------------------- */
/*                          INICIO DE SESION USUARIO                          */
/* -------------------------------------------------------------------------- */

if (isset($_SESSION['validarSesion'])) {

  if ($_SESSION['validarSesion'] == 'ok') {

    echo '<script>
        localStorage.setItem("usuario","'.$_SESSION["id"].'");
      </script>';

  }

}

/* --------------------- End of INICIO DE SESION USUARIO -------------------- */

?>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
  <div class="offcanvas__close">+</div>

  <ul class="offcanvas__widget">
    <li><span class="icon_search search-switch"></span></li>

    <li>
      <a href="<?=$frontend?>carrito-de-compras">
        <span class="icon_bag_alt"></span>
        <div class="tip cantidadCesta"></div>
      </a>
    </li>

    <?php if (isset($_SESSION['validarSesion'])): ?>
      <?php if ($_SESSION['validarSesion'] == 'ok'): ?>
        <?php if ($_SESSION['modo'] == 'directo'): ?>
          <li>
            <a href="<?=$frontend?>lista-deseos">
              <span class="icon_heart_alt"></span>
            </a>
          </li>

          <?php if ($_SESSION['foto'] != ''): ?>
            <li>
              <a style="width:50px;height:50px;" href="<?=$frontend?>perfil">
                <img class="rounded-circle" src="<?=$frontend.$_SESSION['foto']?>" width="100%">
              </a>
            </li>
          <?php else: ?>
            <li>
              <a style="width:50px;height:50px;" href="<?=$frontend?>perfil">
                <img class="rounded-circle" src="<?=$backend?>vistas/img/usuarios/default/anonymous.png" width="100%">
              </a>
            </li>
          <?php endif ?>
        <?php endif ?>
      <?php endif ?>
    <?php endif ?>
  </ul>

  <div class="offcanvas__logo">
    <a href="<?=$frontend?>"><img src="<?=$backend.$plantilla['logo']?>" class="logo" alt="logo"></a>
  </div>

  <div id="mobile-menu-wrap"></div>

  <div class="offcanvas__auth">
    <?php if(!isset($_SESSION['validarSesion'])): ?>
      <a class="btnIngreso" href="<?=$frontend?>login">INGRESAR</a>
      <a href="<?=$frontend?>register">REGISTRARSE</a>
    <?php endif ?>
  </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3 col-lg-2">
        <div class="header__logo">
          <a href="<?=$frontend?>"><img src="<?=$backend.$plantilla['logo']?>" class="logo" alt="logo"></a>
        </div>
      </div>

      <div class="col-xl-6 col-lg-7">
        <nav class="header__menu">
          <ul class="text-center">
            <li><a href="<?=$frontend?>">Inicio</a></li>
            <li><a href="<?=$frontend?>tienda">Tienda</a></li>
            <li><a href="<?=$frontend?>contacto">Contacto</a></li>
          </ul>
        </nav>
      </div>

      <div class="col-lg-3">
        <div class="header__right">
          <div class="header__right__auth">
            <?php if(!isset($_SESSION['validarSesion'])): ?>
              <a class="btnIngreso" href="<?=$frontend?>login">INGRESAR</a>
              <a href="<?=$frontend?>register">REGISTRARSE</a>
            <?php endif ?>
          </div>

          <ul class="header__right__widget">
            <li><span class="icon_search search-switch"></span></li>

            <li>
              <a href="<?=$frontend?>carrito-de-compras">
                <span class="icon_bag_alt"></span>
                <div class="tip cantidadCesta"></div>
              </a>
            </li>

            <?php if (isset($_SESSION['validarSesion'])): ?>
              <?php if ($_SESSION['validarSesion'] == 'ok'): ?>
                <?php if ($_SESSION['modo'] == 'directo'): ?>
                  <li>
                    <a href="<?=$frontend?>lista-deseos">
                      <span class="icon_heart_alt"></span>
                    </a>
                  </li>

                  <?php if ($_SESSION['foto'] != ''): ?>
                    <li>
                      <a style="width:50px;height:50px;" href="<?=$frontend?>perfil">
                        <img class="rounded-circle" src="<?=$frontend.$_SESSION['foto']?>" width="100%">
                      </a>
                    </li>
                  <?php else: ?>
                    <li>
                      <a style="width:50px;height:50px;" href="<?=$frontend?>perfil">
                        <img class="rounded-circle" src="<?=$backend?>vistas/img/usuarios/default/anonymous.png" width="100%">
                      </a>
                    </li>
                  <?php endif ?>

                <?php endif ?>
              <?php endif ?>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="canvas__open">
      <i class="fa fa-bars"></i>
    </div>
  </div>
</header>
<!-- Header Section End -->

<!-- Search Begin -->
<div class="search-model">
  <div class="h-100 d-flex align-items-center justify-content-center">
    <div class="search-close-switch">+</div>
    <div class="search-model-form" id="buscador">
      <input id="search-input" placeholder="Que es lo que buscas?...">

      <span class="input-group-btn">
        <a href="<?php echo $frontend; ?>buscador/1"></a>
      </span>
    </div>
  </div>
</div>
<!-- Search End -->