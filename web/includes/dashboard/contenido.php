<?php
// Este codigo hace validacion para que no se pueda acceder a cualquier pagina sin estar logueado__Pablo Loyola
ob_start();
@session_start();
 if(isset($_SESSION['Logueado']) && ($_SESSION['Logueado'] === true)){
?>
<!--========== CONTENTS ==========-->
<main>
    <section class="about" id="about">
        <div class="image col">
            <img style="position: relative; top: 80px;" src="./assets/images/tu_tablero.jpg" alt="">
        </div>

        <div class="content col" style="position: relative; top: 80px;">
            <span>Tu tablero</span>
            <h3 class="title">¡El secreto real del éxito es el entusiasmo!</h3>

            <div class="icons-container">
                <a class="icons" id="open-modal">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Tus últimos cursos</h3>
                </a>

                <a class="icons" id="open-modal1">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Cursos completados</h3>
                </a>
                <a class="icons" id="open-modal2">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Cursos inscritos</h3>
                </a>

                <!--<a class="icons" id="open-modal3">
                    <img src="./assets/images/serv-3.png" alt="">
                    <h3>Tus profesores</h3>
                </a>-->
                
            </div>
        </div>
    </section>
</main>



<?php
    }
    else{
        header('Location: ../../iniciosesion.php');
    }
?>
