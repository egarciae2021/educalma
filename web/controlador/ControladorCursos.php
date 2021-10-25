<?php
include_once '../modelo/modelocursos.php';
class ControladorCursos
{

  public function ControladorListarCursos(){
    try{   
          $obj=new CursosModelo();
          return $obj->ListarCursosModelo();
     }catch(Exception $e){
         throw $e;
     }  
  } 

  public function ControladorInsertarCursos($codigo_cursos,$nombre,$descripcion,$ntemas,$costo){
    try{   
          $obj=new CursosModelo();
          return $obj->InsertarCursosModelo($codigo_cursos,$nombre,$descripcion,$ntemas,$costo);
     }catch(Exception $e){
         throw $e;
     }  
  }

  public function ControladorDatosCursos($codigo_cursos){
    try{   
          $obj=new CursosModelo();
          return $obj->DatosCursosModelo($codigo_cursos);
     }catch(Exception $e){
         throw $e;
     }  
  } 
  public function ControladorEliminarCursos($codigo_cursos){
    try{   
          $obj=new CursosModelo();
          return $obj->EliminarCursosModelo($codigo_cursos);
     }catch(Exception $e){
         throw $e;
     }  
  }
  public function ControladorModificarCursos($codigo_cursos,$nombre,$descripcion,$ntemas,$costo){
    try{   
          $obj=new CursosModelo();
          return $obj->ModificarCursosModelo($codigo_cursos,$nombre,$descripcion,$ntemas,$costo);
     }catch(Exception $e){
         throw $e;
     }  
  }
}
?>