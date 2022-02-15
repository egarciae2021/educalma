<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Realizar pago</title>
  <link rel="stylesheet" href="assets/css/stylePay.css">
  <script src="assets/lib/sweetalert2/sweetalert2.all.min.js"></script>
</head>

<body>
  <?php
      ob_start();
      @session_start();
  ?>
  <div class="preloader" id="preloader">
    <div class="circle"></div>
  </div>
  <div class="container-pay">
    <div class="box-header">
      <div class="box-image">
        <img src="assets/img/logo.calma.color.png" alt="Fundación Calma">
      </div>
      <div class="box-signout">
        <a href="#">Cerrar sesión</a>
      </div>
    </div>
    <div class="box-tools">
      <div class="title">
        <h1>Realizar pago</h1>
      </div>
      <div class="button-before">
        <a href="#">Regresar</a>
      </div>
    </div>
    <form class="box-form" id="dataForm" action="./sendData/pay.php" method="post" autocomplete="off">
      <div class="labels-targets">
        <div class="visa">
          <img src="assets/img/visa.svg" alt="VISA">
        </div>
        <div class="mastercard">
          <img src="assets/img/mastercard-4.svg" alt="MASTERCARD">
        </div>
        <div class="american-express">
          <img src="assets/img/american-express-1.svg" alt="AMERICAN EXPRESS">
        </div>
        <div class="dinner-club">
          <img src="assets/img/diners-club-logo3-1.svg" alt="DINNER CLUB">
        </div>
      </div>
      <div class="group-input">
        <label for="txtNombre">Nombre</label>
        <input type="text" id="txtNombre" name="txtNombre">
      </div>
      <div class="message-error">Ingrese un nombre.</div>

      <div class="group-input">
        <label for="txtApellido">Apellido</label>
        <input type="text" id="txtApellido" name="txtApellido">
      </div>
      <div class="message-error">Ingrese tus apellidos.</div>
      <div class="group-input">
        <label for="txtCorreo">Correo</label>
        <input type="text" name="txtCorreo" id="txtCorreo">
      </div>
      <div class="message-error">El correo no tiene un formato válido.</div>
      <div class="group-input">
        <label for="txtNumTarget">Número de tarjeta</label>
        <input type="text" id="txtNumTarget" name="txtNumTarget">
      </div>
      <div class="message-error">Ingresa un número de tarjeta.</div>

      <div class="group-input">
        <label for="txtFechaVencimiento">Fecha de vencimiento (MM/AA)</label>
        <input type="text" id="txtFechaVencimiento" name="txtFechaVencimiento" maxlength="5">
      </div>
      <div class="message-error">Ingresa un mes de vencimiento.</div>

      <div class="group-input">
        <label for="txtCodigoSeguridad">Código de seguridad (CVV)</label>
        <div class="row-w-icon">
          <input type="text" id="txtCodigoSeguridad" name="txtCodigoSeguridad" maxlength="4">
          <div class="icon">
            <span>?</span>
          </div>
        </div>
      </div>
      <div class="message-error">Ingresa un código de seguridad (CVV).</div>

      <div class="group-input">
        <button type="submit" id="btnPayme">PAGAR S/<?php echo $_SESSION['costoPay'];?></button>
      </div>
    </form>
  </div>

  <script src="assets/js/mainPay.js"></script>
</body>

</html>