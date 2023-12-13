<?php $respuesta = ControladorCarrito::ctrMostrarTarifas(); ?>
<input type="hidden" id="divisa" value="<?=$respuesta['divisa']?>">
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__links">
          <a href="<?=$frontend?>"><i class="fa fa-home"></i> Inicio</a>
          <span>Carrito de compras</span>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="productos calzado/calzado01">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="shop__cart__table">
          <table>
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>

            <tbody class="cuerpoCarrito">
              <!-- <tr>
                <td class="cart__product__item">
                  <img src="<?=$backend?>vistas/img/productos/corne-keyboard.jpg" alt="" style="width:70px;">
                  <div class="cart__product__item__title">
                    <h6>Chain bucket bag</h6>
                  </div>
                </td>

                <td class="cart__price">$ 150.0</td>
                <td class="cart__quantity">
                  <div class="pro-qty d-flex">
                    <input type="number" value="1" min="1">
                  </div>
                </td>
                <td class="cart__total">$ 300.0</td>
                <td class="cart__close"><span class="icon_close"></span></td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row sumaCarrito">
      <div class="col-lg-6">
      </div>
      <div class="col-lg-4 offset-lg-2">
        <div class="cart__total__procced">
          <ul>
            <li class="sumaSubTotal"></li>
          </ul>
          <?php if (isset($_SESSION["validarSesion"])): ?>
            <?php if ($_SESSION["validarSesion"] == "ok"): ?>
              <a id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="<?=$_SESSION["id"]?>" class="primary-btn" style="color:#fff; cursor:pointer;">PAGAR <i class="fa fa-paypal"></i></a>
            <?php endif ?>
          <?php else: ?>
            <a id="btnCheckoutIngreso" href="<?=$frontend?>login" class="primary-btn" style="color:#fff;">PAGAR <i class="fa fa-paypal"></i></a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shop Cart Section End -->

<!-- -------------------------------------------------------------------------- */
/*                         VENTANA MODAL PARA CHECKOUT                        */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">REALIZAR PAGO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body contenidoCheckout">
        <input type="hidden" id="tasaImpuesto" value="<?=$respuesta['impuesto']?>">
        <input type="hidden" id="envioNacional" value="<?=$respuesta['envioNacional']?>">
        <input type="hidden" id="envioInternacional" value="<?=$respuesta["envioInternacional"]?>">
        <input type="hidden" id="tasaMinimaNal" value="<?=$respuesta['tasaMinimaNal']?>">
        <input type="hidden" id="tasaMinimaInt" value="<?=$respuesta["tasaMinimaInt"]?>">
        <input type="hidden" id="pais" value="<?=$respuesta['pais']?>">

        <div class="formEnvio row" id="datosenvio">
          <h4 class="text-center m-auto text-muted text-uppercase">Información de envío</h4>
          <div class="alert alert-info alertainfo">LA DIRECCION PARA LA ENTREGA <strong>SERA TOMADA DE LOS DATOS DE SU CUENTA DE PAYPAL</strong>, POR FAVOR VERIFIQUE QUE DICHOS DATOS SEAN CORRECTOS</div>
          <div class="col-12 seleccionePais"></div>
        </div>
        <br>

        <div class="listaProductos row">
          <div class="col-12">
            <h4 class="text-center m-auto text-muted text-uppercase">Productos a comprar</h4>
            <table class="table table-striped tablaProductos">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                </tr>
              </thead>

              <tbody>

              </tbody>
            </table>
          </div>

          <div class="col-12 col-sm-8 ml-auto">
            <table class="table table-striped tablaTasas">
              <tbody>
                <tr>
                  <td>Subtotal</td>
                  <td><span class="cambioDivisa"><?=$divisa?></span> $<span class="valorSubtotal" valor="0">0</span></td>
                </tr>

                <tr>
                  <td>Envío</td>
                  <td><span class="cambioDivisa"><?=$divisa?></span> $<span class="valorTotalEnvio" valor="0">0</span></td>
                </tr>

                <tr>
                  <td>Impuesto</td>
                  <td><span class="cambioDivisa"><?=$divisa?></span> $<span class="valorTotalImpuesto" valor="0">0</span></td>
                </tr>

                <tr>
                  <td><strong>Total</strong></td>
                  <td><strong><span class="cambioDivisa"><?=$divisa?></span> $<span class="valorTotalCompra" valor="0">0</span></strong></td>
                </tr>

              </tbody>

            </table>
          </div>

          <div class="clearfix"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn primary-btn btn-lg btnPagar">PAGAR</button>
      </div>
    </div>
  </div>
</div>

<!-- ------------------- End of VENTANA MODAL PARA CHECKOUT ------------------- -->