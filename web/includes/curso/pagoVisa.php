<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/tarjeta.css">
</head>
<body>
<div class="div_contenedor">
    <div class="div_centrado">
    <h7>Ingresa los datos de tu tarjeta:</h7>
    <br>
    <div class="expiry_number" id="card-container">
        <input type="text" class="expiry_input" data-mask="0000 0000 0000 0000" id="card" name="card" placeholder="Numero de Tarjeta" > 
        <img src="assets/img/credit_card.png" width="75" height="55">  
    </div>
    <br>
    <div class="card_grp">   
      <div class="expiry_date">
      
        <input type="text" class="expiry_input" data-mask="00" id="txtMes" name="txtMes" placeholder="Mes">
        <input type="text" class="expiry_input" data-mask="0000" id="txtAnio" name="txtAnio" placeholder="Año">
        <img src="assets/img/mes_venci.png" width="75" height="55">
      </div>
      <div class="cvc">
        <input type="text" class="cvc_input" data-mask="000" id="txtCvv" name="txtCvv" placeholder="CVV">
        <div class="cvc_img">
            ?
           <div class="img">
             <img src="https://i.imgur.com/2ameC0C.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="btn">
      realizar pago
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="assets/card-validator.js"></script>
</body>
</html>