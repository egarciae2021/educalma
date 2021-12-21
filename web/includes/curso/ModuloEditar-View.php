<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/agretemas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <style>
         label.error{
    	color: red;
        font-style: italic;
        font-size: 13px;    
        max-width:400px;
        padding: 10px;
        margin:0;
        }
    </style>
    <title>Módulo</title>
</head>

<body>
<?php
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="titlemc"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        require_once '././database/databaseConection.php';
        $_GET['id_curso'];
        $idModulo=$_GET['id_modulo'];
        $pdo = Database::connect();
        $sql = "SELECT * FROM modulo WHERE idModulo='$idModulo'";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    ?>
    <br>
    <br>
        <a href="agregarModulos.php?id=<?php echo $dato['id_curso']; ?>" class="boton2" style="padding: 5px; width: 5%;">Atras <-</a>

<div class="container-fluid">
                        
        <h2 class="mb-4" style="text-align: center; color:#4F52D6; font-size: 300%;font-family: 'Oswald', sans-serif;">
                <center>Bienvenido a EduCalma</center>
        </h2>
        <div class="title">
            <div class="mb-4">
                <center><i class="fas fa-edit"></i> Editar<strong> Módulo</strong></center>
            </div>
        </div>
    </DIV>
    
<div class="container-contformulario">
    <div class="contformulario" id="contformulario">
        <div class="row">
            <div class="image">
                <img src="./assets/images/donar01.png" alt="">
            </div>
            <form name="formulario" id="form-agretemas3" action="includes/modulo/Modulo_CRUD.php?id=<?php echo $dato['id_curso'];?>" target="dummyframe" method="POST">   
            <div class="inputBox">
                    <h3>Renombrar Módulo:</h3>
                    <input type="text" name="actu_nomb_agregar" id="actu-nomb-agregar" value="<?php echo $dato['nombreModulo'];?>" 
                    placeholder="" aria-label="ModuloAgr" aria-describedby="moduloAgr-addon" required>
                    <input type="hidden" name="idmodulo" value="<?php echo $dato['idModulo'];?>">
            </div>
            <div class="inputBox">
                    <button type="submit" class="boton1">
                    <i class="fas fa-redo"></i> Actualizar</button>
            </div>
            </form>
            <?php
            // $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            // $idC=substr($url, strrpos($url, '=') + 1);
            // $enviar=substr($url, strrpos($url, '&') - 1);
            // $idM=substr($enviar,0,1);
            // 
            // $_SESSION['iddelmodulo']=$idM;
            // $_SESSION['iddelcurso']=$idC;
// 
            // echo $idC."<br>";
            // echo $idM;
            ?>
        </div>
    </div>
</div>
</div>
<?php
    }
    else{
                header('Location:iniciosesion.php');
    }
?>
<!-- Validaciones Autor:Jorge Martinez-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="assets/js/validarCategoria.js"></script>
</body>
</html>
