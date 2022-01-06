<?php
    require_once '../../database/databaseConection.php';
   
    /*=============================================
                 PARA Agregar CURSO 
    ===============================================*/

    if(isset($_POST['nombres_agrecursos'])){
        ob_start(); 
        session_start();

        $nombreCur=$_POST['nombres_agrecursos'];
        $descripcionCur=$_POST['descripcio_curso'];
        $intro = $_POST['intro_curso'];
        $categoriaCur = $_POST['categoria'];
        $precio=0.00;
        $nombreimagen=$_FILES['txtimagen']['tmp_name'];
        $dirigido =$_POST['publico_dirigido'];
        $idProfe = $_SESSION['codUsuario'];
        
        
        if($_FILES['txtimagen']['size']>0){
            $nombreimagen = addslashes(file_get_contents($nombreimagen));
        }else{
            $aux = "../../assets/images/curso_educalma.png";
            $nombreimagen = addslashes(file_get_contents($aux));

        }
        
        $pdo = Database::connect();  
        $veri="SELECT * FROM cursos WHERE nombreCurso = '$nombreCur' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);


        Database::disconnect();
    
        if($dato==0){
            //moviendo imagen temporal a una carpeta
            //$ruta="../../assets/images/imagenes_cursos/".$nombreimagen;
            //$resultado=move_uploaded_file($_FILES['txtimagen']['tmp_name'],$ruta);
            
            $pdo = Database::connect();
            try{
                $verif=$pdo->prepare(" INSERT INTO `cursos` (`nombreCurso`,`descripcionCurso`,`categoriaCurso`,`dirigido`,`costoCurso`,`imagenDestacadaCurso`,permisoCurso,`introduccion`,`id_userprofesor`) 
                VALUES (:nombreCur,:descripcionCur,:categoriaCur,:dirigido,:precio,:nombreimagen,0,:intro,:idProfe)");
                $verif->bindParam(":nombreCur",$nombreCur,PDO::PARAM_STR);
                $verif->bindParam(":descripcionCur",$descripcionCur);
                $verif->bindParam(":categoriaCur",$categoriaCur,PDO::PARAM_INT);
                $verif->bindParam(":dirigido",$dirigido,PDO::PARAM_STR);
                $verif->bindParam(":precio",$precio,PDO::PARAM_STR);
                $verif->bindParam(":nombreimagen",$nombreimagen);
                $verif->bindParam(":intro",$intro,PDO::PARAM_STR);
                $verif->bindParam(":idProfe",$idProfe,PDO::PARAM_INT);
                $verif->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
    /*
            $verif->execute(array(
                ':nombres_agrecursos'=>$nombreCur,
                ':descripcio_curso'=>$descripcionCur,
                ':categoriaCurso'=>$categoriaCur,
                ':publico_dirigido'=>$dirigido,
                ':precio_curso'=>$precio,
                ':imagen_agregar'=>$nombreimagen,
                ':intro_curso'=>$intro,
                ':codUsuario'=>$idProfe,
            ));*/
            
            //traer el id del insert que se agregado
            $veri2="SELECT * FROM cursos  WHERE nombreCurso = '$nombreCur' ";
            $q2 = $pdo->prepare($veri2);
            $q2->execute(array());
            $dato2=$q2->fetch(PDO::FETCH_ASSOC);
            
            // echo "funciona";
            echo'
            <script>
                // alert ("inscrito exitosamente");
                window.location = "../../agregarModulos.php?id='.$dato2['idCurso'].'";
            </script>
            ';
            
            Database::disconnect();
        }
        
        else{
            
         echo' <script> alert("El curso ya existe");
            window.location = "../../agregarcurso.php";
         </script> '; 
            
        }
    }


    /*=============================================
                 PARA OCULTAR CURSO (Elimina)
    ===============================================*/

    if(isset($_GET['id_curso'])){
        $id=$_GET['id_curso'];

        $pdo = Database::connect();  
        $veri="UPDATE cursos SET permisoCurso='0' WHERE idCurso = '$id' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        echo'
            <script>
                alert ("ocultado exitosamente");
                window.location = "../../publicarcursos.php";
            </script>
        ';
    }

    /*===========================================
                PARA ACTUALIZAR CURSO
    =============================================*/

    if(isset($_POST['idcurso'])){

        $id=$_POST['idcurso'];
        $nomb=$_POST['nomb_actu_cursos'];
        $descr=$_POST['desc_curso'];
        $prec=$_POST['prec_curso'];
	
	    if(($_FILES['txtimagenAct']['size'])>0){
            $nombreimagenes=$_FILES['txtimagenAct']['tmp_name'];
        	$nombreimagen=addslashes(file_get_contents($nombreimagenes));
            $pdo = Database::connect();
            $consulta= $pdo->prepare("UPDATE cursos SET imagenDestacadaCurso='$nombreimagen' WHERE idCurso='$id'");
            $consulta->execute();
            Database::disconnect(); 
        }

        if($_POST['prec_curso']<=0){
            $prec = 'Gratis';
        }else{
            $prec=$_POST['prec_curso'];
        }
        
        $pdo2 = Database::connect();
        $consult1=$pdo2->prepare("UPDATE cursos SET nombreCurso='$nomb', descripcionCurso='$descr', costoCurso='$prec' WHERE idCurso = '$id' ");
        $consult1->execute();
        Database::disconnect();

        echo'
            <script>
                // alert ("Actualizado exitosamente");
                window.location = "../../editarcurso.php?id='.$id.'";
            </script>
        ';
    
        
    }

    /*=============================================
                 PARA OCULTAR CURSO (Elimina)
    ===============================================*/

    if(isset($_GET['id_eliminar'])){
        $id=$_GET['id_eliminar'];

        $pdo = Database::connect();  
        $veri="UPDATE cursos SET permisoCurso='0' WHERE idCurso = '$id' ";
        $q = $pdo->prepare($veri);
        $q->execute(array());
        $dato=$q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        
        echo'
            <script>
                //alert ("ocultado exitosamente");
                window.location = "../../user-sidebar.php";
            </script>
        ';
    }
    

?>