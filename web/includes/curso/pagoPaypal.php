<html lang="en">
<?php
require_once 'database/databaseConection.php';
$id = $_GET['id'];
?>

<head>
    <link rel="stylesheet" href="assets/css/pagepay.css" />
    <!-- <link rel="stylesheet" href="assets/css/tarjeta.css" /> -->
    <link rel="stylesheet" href="assets/css/tarjetaCredito.css">
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/modalPagarVisa.css">
    <link rel="stylesheet" href="assets/css/formPagarVisa.css">

</head>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>
    <script src="assets/js/card-validator.js"></script>

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

            if (empty($datoS['id_cursoInscrito'])){        
    ?>

    <header style="background-color: #ffffff77;">
        <div class="container-header navbar-fixed-top" style="max-width: 95rem;">
            <input type="checkbox" name="" id="check">
            <div class="logo-container">
                <a href="index.php"><img src="assets/images/logo_educalma.png" alt=""></a>
            </div>
            <div class="nav-btn-header">
                <div class="nav-links-header">
                </div>
                <div class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="detallecurso.php?id=<?php echo $id; ?>">Cerrar</a>
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
                <a href="#">Inicio</a><i class=" mx-3 fas fa-chevron-right"></i>
                <span>Proceso de pago</span>
            </div>
            <!-- col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 -->
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8 mb-0">
                <form action="" style="height: 100%;">
                    <div class="container-pay px-4" style="background-color: white;height: 100%;">
                        <div class="d-flex justify-content-between">
                            <div class="mt-3">
                                <h4>Elige tu medio de pago</h4>
                            </div>
                            <div class="mt-2">
                                <span><a href=" #">¿Necesitas ayuda?</a></span>
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
                            
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img src="assets/images/visa.png" alt="" height="13px">
                                </a>
                            
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                                    <div class="card-body">
                                        <!-- <a href="pay.php">VISA</a> -->
                                        <!-- <a href="pay.php?id=<?php # echo $idUserr; ?>">VISA</a> -->

                                        <!-- -->
                                        <div>
                                            <!--<button id="cardBtn" onclick="location.href='pay.php?id=<?php echo $idUserr; ?>'" class="btn btn-primary btn-lg btn-block" type="button">Pagar con tarjeta de credito o debito <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card" viewBox="0 -2 16 16" style="width: 23; height: 23; @media only screen and (max-width: 768px){width: 23; height: 23;}"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/><path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/></svg></button>-->
                                            <button data-open="modal1" id="cardBtn" class="btn btn-primary btn-lg btn-block" type="button">Pagar con tarjeta de credito o debito <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card" viewBox="0 -2 16 16" style="width: 23; height: 23; @media only screen and (max-width: 768px){width: 23; height: 23;}"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/><path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/></svg></button>
                                        </div>

                                        

                                    </div>
      
                                            <!--Inicio-->
                                            <?#php include_once 'includes/curso/pagoTarjeta.php' ?>
    
                                            <!--Fin-->          
                                </div>
                            </div>

                            <!-- -->
                            <div class="card mb-3">
                                
                                <a class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img class="ml-1" src="assets/images/paypal (1).png" alt="" height="13px">
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
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4">
                <div class="container-info-course" style="background-color: white;">
                    <div class="px-4 py-2">
                    <h4  style="color: #4D1BF8; font-weight: bold;">Detalles del pedido</h4>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="d-flex flex-column">
                            <span>Nombre del curso: <?php echo $dato['nombreCurso'];?></span>
                            <span>Descripción del curso: <?php echo $dato['descripcionCurso'];?></span>
                            <!-- <span>Nombre del curso</span> -->
                        </div>
                    </div>
                </div>
                <div class="container-info-resumen mt-3" style="background-color: white; border: 2px solid #737BF1; border-radius: 15px;">
                    <div class="px-4 py-3">
                        <h4 style="color: #4D1BF8; font-weight: bold;">Resumen de pedido</h4>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="row">
                            <div class="col-6" style="font-weight: bold;">Producto</div>
                            <div class="col-6 text-right" style="font-weight: bold;"><span>$.<?php echo $dato['costoCurso'];?></span></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5 col-lg-6 col-xl-5">
                                <div class="container-image-detalle" style="width:100px; height:100px">
                                    <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAPars5s2FQzySbkUpPjtBlvPlANAFDLP7x38q8nOqcke_Lrf_if34Y-kTjGQgS6pRvuQ&usqp=CAU" alt=""> -->
                                    
                                    <?php    
                                        if($dato['imagenDestacadaCurso']!=null){
                                    ?>
                                            <img height="50px" src="data:image/*;base64,<?php echo base64_encode($dato['imagenDestacadaCurso']) ?>">
                                    <?php
                                        }else{
                                    ?>
                                            <img height="50px"  src="./assets/images/curso_educalma.png">
                                    <?php
                                        }
                                    ?> 

                                </div>
                            </div>
                            <div class="col-7 col-lg-6 col-xl-7 font-weight-bold text-leftt" style="font-size: 16px;"><span><?php echo $dato['nombreCurso'];?></span>
                                <p class="font-weight-bold text-danger" >$.<?php echo $dato['costoCurso'];?></p>
                                <?php $_SESSION['costoPay']=$dato['costoCurso'];?>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h3 style="font-size: 13px;">Los productos podrán ser descargados una vez que se procede el pago</h3>
                            <h3 class="font-weight-bold" style="font-size: 10px;">(Para aclaraciones giancarlosuggardaddy@gmail.com)</h3>
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
                    // alert('pago exitoso');
                    //     window.location.href = 'sidebarCursos.php';
                    // window.location = "curso.php?id= ?php echo $dato["idCurso"];?>";
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
                // alert('cancelaste tu pago');
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
