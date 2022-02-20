<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
<!-- clase bootstrap-->
  <link rel="stylesheet" href="web\assets\css\plugins\bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/4e9759916e.css">
  

</head>
<body>
<div class="div_contenedor">
    <div class="div_centrado">
    <h7 style="color: darkgray">Ingresa los datos de tu tarjeta:</h7>  
    <br> <br> 
        <div class="input-group">
            
            <input type="text" class="form-control" data-mask="0000 0000 0000 0000" id="card" name="card" placeholder="N° de Tarjeta">
            <div class="input-group-append">
            <span class="input-group-text"><img src="assets/img/tarjeta.png" width="25" height="20"></span>

            </div>
        
        </div>
        <br>
        <div class="input-group">
            
        <select class="form-control">
        <option hidden selected>Mes</option>
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        </select>

        &nbsp;&nbsp;&nbsp;&nbsp;
        
        <select class="form-control">
        <option hidden selected>Año</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        </select>
        
        </div>

    <br>
    <div class="cvv">
    <div class="input-group">
            
            <input type="text" class="form-control" data-mask="000" id="cvv" name="cvv" placeholder="CVV">
            <div class="input-group-append">
            <span class="input-group-text"><img src="assets/img/cvv.png" width="25" height="20"></span>

            </div>
        </div>
        
        </div>
        
        <br>
    <div class="btn">
      pagar
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="assets/card-validator.js"></script>
</body>
</html>