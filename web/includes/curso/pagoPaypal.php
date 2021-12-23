<!DOCTYPE html>
<html lang="en">
<?php
    require_once 'database/databaseConection.php';
?>
<head>
    <title>Pagina Pago</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/pagepay.css" />
</head>

<body>

    <?php
        $id = $_GET['id'];
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
    

    <div class="container">
        <div class="contenedor-nextpage">
            <img class="image-cont" src="assets/images/online-payment.png" alt="">
            <h1 class="mt-4">¡Paso Final!</h1>
            <hr>
            <h3>Estas a punto de pagar con paypal la cantidad de:</h3>
            <div class="my-3 mx-auto" style="max-width: 350px;">
                <span>$.<?php echo $dato['costoCurso'];?>.00</span><br>
                <div class> <!-- VISA -->
                    <a href="" class="btn my-1 visa"><img src="assets/images/visa.png" alt="" style="border-radius: 23px;"></a><br>
                    <!-- <a href="" class="btn my-1 paypal"><img src="assets/images/paypal (1).png" alt=""></a><br>
                    <a href="" class="btn my-1 credit"><i class="fas fa-credit-card mr-2"></i>Debit or Credit Card</a><br><br> -->
                </div>
                <div id="paypal-button-container"></div>
                <h5>La forma rápida y segura de pagar</h5>
            </div>
            <h4>Los productos podrán ser descargados una vez que se procede el pago</h4>
            <h5>(Para aclaraciones :uputoamoestuvoaqui@gmail.com)</h5>
        </div>
    </div>

    <?php
        }else{
            echo'
                <script>
                    window.location = "../../curso.php?id='.$id.'";
                    
                </script>
            ';
        }
    ?>

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
                
                // actions.order.capture().then(function(details){
                //     alert('pago exitoso');
                //     window.location.href = 'sidebarCursos.php';
                //     console.log(details);
                // });
                // let URL = 'includes/Cursos_crud/inscribeteCurso.php?id=?php echo $dato["idCurso"]; ?>';
                let url = 'includes/Cursos_crud/inscribeteCurso.php?id=<?php echo $dato["idCurso"];?>';
                actions.order.capture().then(function(details) {
                    alert('pago exitoso');
                    //     window.location.href = 'sidebarCursos.php';
                    window.location = "../../curso.php?id= <?php echo $dato["idCurso"];?>";
                    console.log(details);
                    
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            details: details
                        })
                    })

                });
            },

            onCancel: function(data) {
                alert('cancelaste tu pago');
                console.log(data);
            }


        }).render('#paypal-button-container');
    </script>
</body>

</html>