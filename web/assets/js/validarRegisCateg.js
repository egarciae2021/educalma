$(document).ready(function(){
    $("#formRegis").submit(registrar)
    

    function registrar(evento){
        evento.preventDefault();
        var datos = new FormData($("#formRegis")[0]);
        $.ajax({
            url: 'includes/categorias/checkAgrCateg.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            
            success: function(data){

                if(data==0){                    
                    Swal.fire({
                        title: 'Registro Exitoso!',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(()=>{
                        window.location.href = "../../agregarCategorias.php";                    
                    })
                                       
                }else{                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Fallo al Registrar!!',
                        text: 'La categoria ingresada ya existe',
                        timer: 1000,
                        showConfirmButton: false,
                    }) 
                }
            }
        })
    }


    $("tr td #eliminar_categoria").click(function(evento){
        evento.preventDefault();
        console.log($(this).data("id"));
        //console.log($(this).parents('tr').find('th').text());
        var id = ($(this).attr('data-id'));
        Swal.fire({
            
            title: '<br> Estas Seguro de Elliminar?',
            text: "No podras revirtir esta acción!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar',
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'includes/categorias/checkAgrCateg.php',
                    data: {'id':id},
                    success: function(data){
                        Swal.fire({
                            title: 'Eliminacion Exitosa!',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(()=>{
                            window.location.href = "agregarCategorias.php";                    
                        }) 

                    },statusCode: {
                        400: function(){
                            
                        }  
                    }
                });
            }
          })
    })

    
})