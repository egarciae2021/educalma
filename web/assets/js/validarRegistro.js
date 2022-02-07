$(document).ready(function(){
    $("#form_registro").submit(insertar)
    $("#form_respuesta").submit(seleccionar)
  
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

        function seleccionar(evento){
          evento.preventDefault();   
          var datos = new FormData($("#form_registro")[0]);
  
          $.ajax({
            url: 'includes/tema/checkAgrTema.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){
              Swal.fire({
                icon: 'success',
                title: 'Seleccionado correctamente',
                timer: 1000,
                showConfirmButton: false,
              }).then(()=>{
                window.location.reload()
              })
            }
          })
        }
  })