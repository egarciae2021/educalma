<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROGRESO CONTENIDO</title>
    <script src="jquery-min.js"></script>
    <link rel="stylesheet" href="././assets/css/styleprogreso.css">
</head>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://kit.fontawesome.com/45098fec1a.js" crossorigin="anonymous"></script>


  <div style="margin-top:150px"class="container">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="curso.php">Curso</a>
          <a class="navbar-brand" href="#">Foro</a>
          <!-- <a class="navbar-brand" href="descargas.php">Descargables</a>
          <a class="navbar-brand" href="progreso.php">Progreso</a> -->
        </div>
    </div>
</nav>
  </div>

      <!-- <div class="containerdet">
           <div class="row">

                   <div class="col-md-10">
                       <div class="conttitudet">
                       <h1 >Temario del curso</h1>
                       </div>
                   </div>
               <div class="col-md-1"></div>
           </div>
           <hr class="lineahoridet">

           <div class="row" >
           <div class="col-md-1"></div>
           <div class="col-md-10">
           <div class="accordion_outerdet">
               <div class="containerdet">
                   <details>
                       <summary>Modulo 1 <p>1h 30 min</p></summary>
                       <div class="infoMin">
                            <a href="././cursoiniciar.php" >Introduccion (1:04)</a>
                       </div>
                       <div class="infoMin">
                            <a href="././video.php" >¿Que es el bullying? (1:04)</a>
                       </div>
                       <div class="infoMin">
                            <a href="././cuestionario.php" > Cuestionario</a>
                       </div>
                   </details>
               </div>
               </div>
           </div>
           <div class="col-md-1"></div>
           </div>

           <hr class="lineahoridet">

           <div class="row" >
           <div class="col-md-1"></div>
           <div class="col-md-10">
           <div class="accordion_outerdet">
               <div class="containerdet">
                   <details>
                       <summary>Modulo 2  <p>1h 30 min</p></summary>
                           <div class="infodet">

                             <h5>Topic 1</h5>
                             <h5>Topic 2</h5>
                             <h5>Topic 3</h5>

                           </div>
                   </details>
               </div>
               </div>
           </div>
           <div class="col-md-1"></div>
           </div>

           <hr class="lineahoridet">

           <div class="row" >
           <div class="col-md-1"></div>
           <div class="col-md-10">
           <div class="accordion_outerdet">
               <div class="containerdet">
                   <details>
                       <summary>Modulo 3 <p>1h 30 min</p></summary>
                           <div class="infodet">
                             <h5>Topic 1</h5>
                             <h5>Topic 2</h5>
                             <h5>Topic 3</h5>
                           </div>
                   </details>
               </div>
               </div>
           </div>
           <div class="col-md-1"></div>
           </div>

           <hr class="lineahoridet">

           <div class="row" >
           <div class="col-md-1"></div>
           <div class="col-md-10">
           <div class="accordion_outerdet">
               <div class="containerdet">
                   <details>
                       <summary>Modulo 4 <p>1h 30 min</p></summary>
                           <div class="infodet">
                             <h5>Topic 1</h5>
                             <h5>Topic 2</h5>
                             <h5>Topic 3</h5>

                           </div>
                   </details>
               </div>
               </div>
           </div>
           <div class="col-md-1"></div>
           </div>

           <hr class="lineahoridet">

           <div class="row" >
           <div class="col-md-1"></div>
           <div class="col-md-10">
           <div class="accordion_outerdet">
               <div class="containerdet">
                   <details>
                       <summary>Modulo 5 <p>1h 30 min</p></summary>
                           <div class="infodet">
                             <h5>Topic 1</h5>
                             <h5>Topic 2</h5>
                             <h5>Topic 3</h5>

                           </div>
                   </details>
               </div>
               </div>
           </div>
           <div class="col-md-1"></div>
           </div>

           <br>
           <br>
           <br>

       </div>
-->

<div class="containerdet">


<div class="row">

        <div class="col-md-10">
            <div class="conttitudet">
            <h1 >Temario del curso</h1>
            </div>
        </div>
    <div class="col-md-1"></div>
</div>
<hr class="lineahoridet">

<?php
        require_once 'database/databaseConection.php';
        $id=$_GET['id'];
        
        $pdo5 = Database::connect(); 
        $sql5 = "SELECT * FROM modulo WHERE id_curso='$id'";
        $q5 = $pdo5->prepare($sql5);
        $q5->execute(array());

        while($dato5 = $q5->fetch(PDO::FETCH_ASSOC)){
            ?>

                
<div class="row" >
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="accordion_outerdet">
    <div class="containerdet">
        <details>
            <summary><?php echo $dato5['nombreModulo'] ?><p>1h 30 min</p></summary>
                <div class="infodet">
                    <?php
                         $pdo6 = Database::connect(); 
                         $aux1 = $dato5['idModulo'];
                         $sql6 = "SELECT * FROM tema WHERE id_modulo='$aux1'";
                         $q6 = $pdo6->prepare($sql6);
                         $q6->execute(array());
                         while($dato6 = $q6->fetch(PDO::FETCH_ASSOC)){
                    ?>
                             <a href=""><?php echo $dato6['nombreTema']  ?></a><bR>
                        <?php
                          }
                        ?>

                </div>
        </details>
    </div>
    </div>
</div>
<div class="col-md-1"></div>
</div>

<hr class="lineahoridet">


            <?php
                      
        }
        Database::disconnect();

?>



<br>
<br>
<br>

</div>
<!-- end FAQ -->
   <!-- end FAQ -->

   </section>
