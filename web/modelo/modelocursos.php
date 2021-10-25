<?php
/*Modelo CAPA - ACCESO A DATOS
SELECT,INSERT,UPDATE y DELETE
**/
include_once '../database/conexion.php';
class CursosModelo
{
	public function __construct()
	{
		$con = new Conexion();
	}

  public function InsertarCursosModelo($codigo,$nombre,$descripcion,$ntemas,$costo){
    try{   
         $obj = Conexion::singleton();
         $query = $obj->prepare('insert into cursos (nombreCurso, descripcionCurso, cantidadTemas, costoCurso) values (?,?,?,?)');
            $query -> bindParam(1, $nombre);
            $query -> bindParam(2, $descripcion);
            $query -> bindParam(4, $ntemas);
            $query -> bindParam(5, $costo);
      
         $query->execute();//Ejecuta la consulta SQL
         
      }catch(Exception $e){
          throw $e;
      }
    }

	public function ListarCursosModelo(){
	try{   
       $obj = Conexion::singleton();
       $query = $obj->prepare('SELECT * FROM cursos where categoriaCurso = 0');
       $query->execute();//Ejecuta la consulta SQL
       $vector = $query->fetchAll();
       $query=null;
       return $vector;
    }catch(Exception $e){
        throw $e;
    }
	}
 
  public function EliminarCursosModelo($codigo){
  try{   
       $obj = Conexion::singleton();
       $query = $obj->prepare('delete from cursos where idCurso =?');

          $query -> bindParam(1, $codigo);
        $query->execute();//Ejecuta la consulta SQL

    }catch(Exception $e){
        throw $e;
    }
  }
  public function DatosCursosModelo($codigo){
  try{   
       $obj = Conexion::singleton();
       $query = $obj->prepare('select * from cursos where idCurso =?');

          $query -> bindParam(1, $codigo);
        $query->execute();//Ejecuta la consulta SQL
        $vector = $query->fetchAll();
       $query=null;
       return $vector;
    }catch(Exception $e){
        throw $e;
    }
  }
  public function ModificarCursosModelo($codigo,$nombre,$descripcion,$ntemas,$costo){
  try{   
       $obj = Conexion::singleton();
       $query = $obj->prepare("update cursos set nombreCurso='".$nombre."', descripcionCurso='".$descripcion."',cantidadTemas='".$ntemas."',costoCurso='".$costo."' where idCurso =".$codigo);
        echo $query->execute();//Ejecuta la consulta SQL

    }catch(Exception $e){
        throw $e;
    }
  }

}
?>