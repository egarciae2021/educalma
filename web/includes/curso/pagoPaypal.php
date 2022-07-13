<html lang="en">
<?php
require_once 'database/databaseConection.php';
require  'vendor/autoload.php';

$id = $_GET['id']; 

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-1923618636570539-071014-5632864634d560a172adbfd37f3d8c8e-1157900136');
 
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
 
 
  
?>

<head>
    <link rel="stylesheet" href="assets/css/pagepay.css" />
     <link rel="stylesheet" href="assets/css/tarjetaCredito.css">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/modalPagarVisa.css">
    <link rel="stylesheet" href="assets/css/formPagarVisa.css">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <style>

    @media screen and (min-width: 1000px) {

        .logo-container {
            margin-left: -85px;
            margin-right: 270px;
        }
    }

    </style>

</head>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
    <!-- <script src="assets/js/card-validator.js"></script> -->

    <?php
        ob_start();
        @session_start();
        if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
            $id = $_GET['id'];
            $_SESSION['cursoVisa']=$id;
            $pdo = Database::connect();
            $sql = "SELECT * FROM cursos WHERE idCurso='$id'";
            $q = $pdo->prepare($sql);
            $q->execute(array());
            $dato = $q->fetch(PDO::FETCH_ASSOC);
            

            $idUserr = $_SESSION['codUsuario'];
            $veriS="SELECT * FROM cursoinscrito WHERE curso_id = $id AND usuario_id='$idUserr'";
            $qS = $pdo->prepare($veriS);
            $qS->execute(array());
            $datoS=$qS->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();



// Aqui creamos la referencia de mercado pago
            $item = new MercadoPago\Item();
            $item->title = $dato['nombreCurso'];
            $item->quantity = 1;
            $item->unit_price = $dato['costoCurso'];
            $item->currency_id="PEN";
            $item-> auto_return = "approved" ;
             
            $preference->items = array($item);
             
            $preference->back_urls = array(
                "success" => "https://apiflutter.azurewebsites.net/mercadopago/lectura.php",
                "failure" => "https://youtube.com", 
                "pending" => "https://Facebook.com"
            );
            $preference->auto_return = "approved"; 
             
            $preference->save();
            
            $response = array(
                'id' => $preference->id,
            ); 
            echo json_encode($response);









            if (empty($datoS['id_cursoInscrito'])){        
    ?>

    <header style="background-color: #ffffff77;">
        <div class="container-header navbar-fixed-top" style="max-width: 95rem;">
            <input type="checkbox" name="" id="check">
            <div class="logo-container" id="PagePay">
                <a href="index.php"><img src="assets/images/logo_educalma.png" alt=""></a>
            </div>
            <div class="nav-btn-header">
                <div class="nav-links-header">
                </div>
                <div class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="detallecurso.php?id=<?php echo $id; ?>" style="color:#737BF1" >Cerrar</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hamburger-menu-container">
                <div class="hamburger-menu">
                    <div></div>
                </div>
            </div>
        </div>
    </header>


    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-12 mb-3 container-navbar-router">
                <a href="#">Inicio</a><i class="mx-3 fas fa-chevron-right"></i>
                <span>Proceso de pago</span>
            </div>
        </div>
        <div class="row">
            <!-- col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 -->
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 mb-0">
                <form action="" style="height: 100%;">
                    <div class="container-pay px-4" style="background-color: white;height: 100%;">
                        <div class="pt-3 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="m-0">Elige tu medio de pago</h4>
                            </div>
                            <div>
                                <span><a href="https://api.whatsapp.com/send?phone=51910571087&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20los%20cursos%20.">¿Necesitas ayuda?</a></span>
                            </div>
                        </div>
                        <div class="container-pay-online my-3">
                            <div class="col-12">
                                <div class="py-3">
                                    <i class="far fa-credit-card mr-3"></i>Pago online
                                </div>
                            </div>
                        </div>
                        <div id="accordion">
                            <div class="card mb-3">

                                <!-- -->
                                <a class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img src="assets/images/visa.png" alt="" height="15px">
                                </a>
                            
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                                    <div class="card-body">
                            
                                        <div>
                                            
                                            <!-- Aqui abajo estaba el anterior buton para pago -->
                                            <!-- <button data-open="modal1" id="cardBtn" class="btn btn-primary btn-lg btn-block" type="button">Pagar con tarjeta de credito o debito <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card" viewBox="0 -2 16 16" style="width: 23; height: 23; @media only screen and (max-width: 768px){width: 23; height: 23;}"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/><path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/></svg></button> -->
                                            <!-- Aqui esta el div donde estara el nuevo boton -->
                                            <div class="checkout-btn "> </div>
                                      
                                            <script>
                                                // Agrega credenciales de SDK
                                                const mp = new MercadoPago("APP_USR-151e9e9b-62d0-439d-8f66-e4d1239f2c9e", {
                                                    locale: "es-PE",
                                                });

                                                // Inicializa el checkout
                                                mp.checkout({
                                                    preference: {
                                                    id: '<?php echo $preference->id;?>'
                                                    },
                                                    // autoOpen: true,
                                                    render: {
                                                    container: ".checkout-btn", // Indica el nombre de la clase donde se mostrará el botón de pago
                                                    label: "Pagar con tarjeta de credito o debito ", // Cambia el texto del botón de pago (opcional)
                                                    },
                                                });
                                            </script>


                                      
                                      
                                        </div>  
                                    </div>
      
                                                    
                                </div>
                            </div>

                            <!-- -->
                            <div class="card mb-3">
                                
                                <a class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img class="ml-1" src="assets/images/paypal (1).png" alt="" height="15px">
                                </a>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 d-flex flex-column justify-content-between">
                <div class="container-info-course mb-3" style="background-color: white;">
                    <div class="px-4">
                        <h4 class="text-center my-4">Detalles del pedido</h4>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="d-flex flex-column mb-5">
                            <span><span>Nombre del curso: </span> <?php echo $dato['nombreCurso'];?></span>
                            <span><span>Descripción del curso: <br></span> <?php echo $dato['descripcionCurso'];?></span>
                            <!-- <span>Nombre del curso</span> -->
                        </div>
                    </div>
                </div>
                <div class="container-info-resumen" style="background-color: white;">
                    <div class="px-4">
                        <h4 class="text-center mt-4 mb-3">Resumen de pedido</h4>
                         
                        <div class="row">
                            <div class="col-6 col-lg-6 col-xl-6">
                                <div class="container-image-detalle">
                                    <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAPars5s2FQzySbkUpPjtBlvPlANAFDLP7x38q8nOqcke_Lrf_if34Y-kTjGQgS6pRvuQ&usqp=CAU" alt=""> -->
                                    
                                    <?php    
                                        if($dato['imagenDestacadaCurso']!=null){
                                    ?>
                                            <img height="50px" src="<?php echo $dato['imagenDestacadaCurso'] ?>">
                                    <?php
                                        }else{
                                    ?>
                                            <img src="./assets/images/curso_educalma.png">
                                    <?php
                                        }
                                    ?> 

                                </div>
                            </div>
                            <div class="col-6 col-lg-6 col-xl-6 d-flex flex-column justify-content-center info-resumen-detalle">
                                <span>Producto</span>
                                <span class="font-weight-bold"><?php echo $dato['nombreCurso'];?></span>
                                <span style="font-size: 1.5rem; line-height: 30px; color: #737BF1; font-weight: bold;">S/. <?php echo $dato['costoCurso'];?></span>
                                <?php $_SESSION['costoPay']=$dato['costoCurso'];?>
                            </div>
                        </div>
                        <div class="px-3">
                            <hr class="mb-1">
                            <h3 class="m-0 pb-3" style="font-size: .9rem;">Los productos podrán ser descargados una vez que se procede el pago</h3>
                         </div>

                       
                    </div>

                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                </div> 
            </div>
        </div>
    </div>
    <!-- CLIENTE REAL 
    <script src="https://www.paypal.com/sdk/js?client-id=AbnJTS6i2adyvJS6ZQxGXFyk7aAsytmqwwOAFy-SEHVZ39rHIfC6LUOf8B9o-y-vd9RkjkdgCNVfGNBC&currency=USD" data-sdk-integration-source="button-factory"></script> -->
                
    <!-- SANDBOX -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVnkZnDaKvFAocz7KIUYvfvpw4DcrqR5DK0dMdD4-BaisXfbd0eKi2qG2hBDv5wkLbc52alNaMqW4s3j&currency=USD" data-sdk-integration-source="button-factory"></script> 

    <script>
        paypal.Buttons({

            style: {
                color: 'gold',
                shape: 'pill',
                label: 'pay'
            },

            createOrder: function(data, actions) {
                
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $dato['costoCurso'];?>
                        }
                        
                    }]
                });
                
            },
            onApprove: function(data, actions) {
                
                let url = 'includes/Cursos_crud/inscribeteCurso.php?id=<?php echo $dato["idCurso"];?>';
                actions.order.capture().then(function(details) {
                   
                    console.log(details);
                    
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            details: details
                        })
                    }).then(function(response){
                        Swal.fire({
                            title: 'Compra exitosa',
                            icon: 'success',                            
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(()=>{
                            window.location = "curso.php?id= <?php echo $dato["idCurso"];?>";
                        })
                    })
                });
            },

            onCancel: function(data) {
               
                Swal.fire({
                    title: 'Cancelaste tu pago!!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                })
                console.log(data);
            }


        }).render('#paypal-button-container');
    </script>

    <?php
            }else{
                echo'
                    <script>
                        window.location = "../../curso.php?id='.$id.'";
                        
                    </script>
                ';
            }
        }
        else{
                    header('Location:iniciosesion.php');
        }
    ?>
    <script>
    /*    function msje_Redirec(){
            Swal.fire({
                title: '¿Quiere seguir usando sus datos actuales?',
                text: '**Nombres, Apellidos y Correo**',
                icon: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si',
                denyButtonText: `No`,
                cancelButtonText: 'Cancelar'
                
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href= "pay.php?id=<?php echo $idUserr; ?>"
                }else if (result.isDenied){
                    location.href= "pay.php"
                }
            })
        }*/
    </script>
























 

<div class="modal" id="modal1" data-animation="slideInOutLeft">
    <section class="modal-content">

        <div class="contenedor">

            <!-- Tarjeta -->
            <section class="tarjeta" id="tarjeta">

                <div class="delantera">
                    <div class="logo-marca" id="logo-marca">
                        <!-- <img src="assets/img/logos/visa.png" alt=""> -->
                    </div>
                    <img src="assets/img/chip-tarjeta.png" class="chip" alt="">
                    <div class="datos">
                        <div class="grupo" id="numero">
                            <p class="label">Número Tarjeta</p>
                            <p class="numero">#### #### #### ####</p>
                        </div>
                        <div class="flexbox">
                            <div class="grupo" id="nombre">
                                <p class="label">Nombre Tarjeta</p>
                                <p class="nombre">Nombre</p>
                            </div>

                            <div class="grupo" id="expiracion">
                                <p class="label">Expiracion</p>
                                <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trasera">
                    <div class="barra-magnetica"></div>
                    <div class="datos">
                        <div class="grupo" id="firma">
                            <p class="label">Firma</p>
                            <div class="firma"><p></p></div>
                        </div>
                        <div class="grupo" id="ccv">
                            <p class="label">CCV</p>
                            <p class="ccv"></p>
                        </div>
                    </div>
                    <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
                    <a href="#" class="link-banco">www.tubanco.com</a>
                </div>
                
            </section>

            <!-- Contenedor Boton Abrir Formulario -->
            <div class="contenedor-btn">
                <button class="btn-abrir-formulario" id="btn-abrir-formulario">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form action="" id="formulario-tarjeta" class="formulario-tarjeta">
                <div class="grupo">
                    <label class="numeroTarjeta" for="inputNumero">Número Tarjeta</label>
                    <input type="text" id="inputNumero" maxlength="19" autocomplete="off">
                </div>
                <div class="grupo">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" id="inputNombre" maxlength="19" autocomplete="off">
                </div>
                <div class="flexbox">
                    <div class="grupo expira">
                        <label for="selectMes">Expiracion</label>
                        <div class="flexbox">
                            <div class="grupo-select">
                                <select name="mes" id="selectMes">
                                    <option disabled selected>Mes</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="grupo-select">
                                <select name="year" id="selectYear">
                                    <option disabled selected>Año</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grupo ccv">
                        <label for="inputCCV">CCV</label>
                        <input type="text" id="inputCCV" maxlength="3">
                    </div>
                </div>
                <button type="submit" class="btn-enviar">Enviar</button>
                <button type="button" class="btnCancelar" aria-label="close modal" data-close>Cancelar</button>
            </form>
        </div>

    </section>
  </div>
</div>


 





<script src="assets/js/modalPagarVisa.js"></script>
<script src="assets/js/formPagarVisa.js"></script>



































</body>

</html>
