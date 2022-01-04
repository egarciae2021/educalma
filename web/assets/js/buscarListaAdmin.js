$(document).ready(function(){
    $('.buscarCur').focus();
    $('#buscarCur').on('keyup', function(){
      var buscar = $('#buscarCur').val();
      // console.log(buscar);
      $.ajax({
        type: 'POST',
        url: '././includes/dashboard/tablaAdmin.php',
        data: {'buscar': buscar},
      })
      .done(function(resultado){
        $('#resultadoBusqueda').html(resultado)
      })
      .fail(function(){
        alert('Error')
      })
    });
    
    $('.buscarUsuario').focus();
    $('#buscarUsuario').on('keyup', function(){
      var buscarUsua = $('#buscarUsuario').val();
    //   console.log(buscarUsua);
      $.ajax({
        type: 'POST',
        url: '././includes/dashboard/tablaAdmin.php',
        data: {'buscarUsua': buscarUsua},
      })
      .done(function(resultado){
        $('#BusquedaUsuario').html(resultado)
      })
      .fail(function(){
        alert('Error')
      })
    })
})

