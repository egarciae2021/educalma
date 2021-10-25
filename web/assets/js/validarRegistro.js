$(document).ready(function(){
    $("#form_registro").submit(insertar)
  
    function insertar(evento){
        evento.preventDefault();   
        var datos = new FormData($("#form_registro")[0]);

                        $.ajax({
                                url: 'includes/registrar/checkregistro.php',
                                type: 'POST',
                                data: datos,
                                contentType: false,
                                processData: false,
                                
                                success: function(respuesta){
      
                                  if(respuesta==0){
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'el correo ya existe!',
                                      timer: 1000,
                                      showConfirmButton: false,
                                    })
                                  } else{
                                      Swal.fire({
                                      title: 'resgistro exitoso!',
                                        icon: 'success',
                                        timer: 900,
                                        showConfirmButton: false,
                                      }).then(()=>{
                                          window.location.href ="iniciosesion.php"
                                        
                                      })

                                    }   
                                   
                                  }                
      
  
                            })
                      
                   
        
  
        }
  })