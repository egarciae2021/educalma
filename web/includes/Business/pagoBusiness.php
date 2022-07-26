<html lang="en">
<?php
require_once 'database/databaseConection.php';
// $valor = $_GET['val'];
// $subs=$_GET['subs'];
?>

<head>
    <link rel="stylesheet" href="assets/css/pagepay.css" />
    <link rel="stylesheet" href="assets/js/plugins/sweetalert2.min.css">
    <script src="assets/js/clipboard.min.js"></script>
    <script src="assets/js/funciones.js"></script>
    <!-- <link rel="stylesheet" href="assets/css/stiloEmpresa.css"> -->
</head>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>

    <?php
    ob_start();
    @session_start();
    if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
        $id = base64_decode($_GET['id']);
        $val = base64_decode($_GET['val']);
        $subs = base64_decode($_GET['subs']);
        $id_sol = base64_decode($_GET['sol']);
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $pdo = Database::connect();
        $sql = "SELECT * FROM empresascursos WHERE id_Empresa='$id_sol' LIMIT 1";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $dato = $q->fetch(PDO::FETCH_ASSOC);


        // $idUserr = base64_decode($_GET['us']);
        // $veriS = "SELECT * FROM cursoinscrito WHERE curso_id = $id AND usuario_id='$idUserr'";
        // $qS = $pdo->prepare($veriS);
        // $qS->execute(array());
        // $datoS = $qS->fetch(PDO::FETCH_ASSOC);
        // Database::disconnect();

        // if (empty($dato['id_Empresa'])) {
    ?>

    <header style="background-color: #ffffff77;">
        <div class="container-header navbar-fixed-top" style="max-width: 95rem;">
            <input type="checkbox" name="" id="check">
            <div class="logo-container">
                <a href="index.php"><img src="assets/images/Logo.svg" alt=""></a>
            </div>
            <div class="nav-btn-header">
                <div class="nav-links-header">
                </div>
                <div class="log-sign" style="--i: 1.8s">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="empleados.php">Cerrar</a>
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
                                <a class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img src="assets/images/visa.png" alt="" height="13px">
                                </a>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <a class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-chevron-down mr-2"></i>Tarjeta <img class="ml-1" src="assets/images/paypal (1).png" alt="" height="13px">
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
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
                        <h5>Detalles del pedido
                            <!-- <div id="clip">
                                    <input type="hidden" id="url" class="clipboard" value="<?php //echo $url 
                                                                                            ?>">
                                    <span>
                                        <i id="copyar" class="fa fa-copy"></i>
                                    </span>
                                    <span id="message"></span>
                                </div> -->
                        </h5>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="d-flex flex-column">
                            <span>Nombre de los Cursos:</span><?php

                                                        $sql2 = "SELECT * FROM temp where cod_empre=$id";
                                                        $q2 = $pdo->prepare($sql2);
                                                        $q2->execute();
                                                        $users = $q2->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($users as $user) {
                                                            $sql3 = "SELECT * FROM cursos where idCurso=" . $user['cod_curse'];
                                                            $q1 = $pdo->prepare($sql3);
                                                            $q1->execute();
                                                            $nombre = $q1->fetch(PDO::FETCH_ASSOC);
                                                        
                                                        ?><span><?php echo $nombre['nombreCurso']."&nbsp;"." "." ".$nombre['costoCurso']."<br>";?></span>
                                                        <?php }?>
                            <!-- PABLOOO PON LOS NOMBRES DE LOS CURSOS -->
                            <!-- <span>Descripción del curso: <?php //echo $dato['descripcionCurso']; 
                                                                ?></span> -->
                            <!-- <span>Nombre del curso</span> -->
                        </div>
                    </div>
                </div>
                <div class="container-info-resumen mt-3" style="background-color: white;">
                    <div class="px-4 py-3">
                        <h5>Resumen de pedido</h5>
                        <!-- <p class="m-0">Curso:</p> -->
                        <div class="row">
                            <div class="col-6">Producto</div>
                            <div class="col-6 text-right"><span>$.<?php echo ($val * $subs); ?></span></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5 col-lg-6 col-xl-5">
                                <div class="container-image-detalle" style="width:100px; height:100px">
                                    <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAPars5s2FQzySbkUpPjtBlvPlANAFDLP7x38q8nOqcke_Lrf_if34Y-kTjGQgS6pRvuQ&usqp=CAU" alt=""> -->
                                    <!-- <img height="50px" src="data:image/*;base64,<?php //echo base64_encode($dato['imagenDestacadaCurso']) 
                                                                                        ?>"> -->

                                </div>
                            </div>
                            <div class="col-7 col-lg-6 col-xl-7 text-leftt"><span>Lorem ipsum dolor<?php //echo $dato['nombreCurso']; 
                                                                                                    ?></span>
                                <p class="font-weight-bold text-danger">$.<?php echo ($val * $subs); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h4 style="font-size: 10px;">Los productos podrán ser descargados una vez que se procede el pago</h4>
                            <h5 class="font-weight-bold" style="font-size: 8px;">(Para aclaraciones giancarlosuggardaddy@gmail.com)</h5>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
        // let messageEl = document.querySelector("#message");


        // document.querySelector("i.fa-copy").addEventListener("click", function() {
        //     document.getElementById("#url").value;
        //     // document.execCommand("selectAll");
        //     document.execCommand("copy");
        //     messageEl.innerHTML = "Copiado al portapapeles";
        //     setTimeout(() => messageEl.innerHTML = "", 3000);
        // })
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
                            value: <?php echo ($val * $subs); ?>
                        }

                    }]
                });
            },
            onApprove: function(data, actions) {
                // let status=1;
                let url = 'includes/Business/addempre.php?id=<?php echo $id; ?>';
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
                    }).then(function(response) {
                        Swal.fire({
                            title: 'Compra exitosa',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location = "empleados.php";
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
        }
        else{
                    header('Location:iniciosesion.php');
        }
    //// } else {
    ////     echo '
    ////             <script>
    ////                 window.location = "../../curseEmp.php";
    //                
    ////             </script>
    ////         ';
    //// }
    ?>
</body>

</html>