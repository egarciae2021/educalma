$(document).ready(function(){
    $('#buscar').focus()
  
    $('#buscar').on('keyup', function(){
      var buscar = $('#buscar').val()
      $.ajax({
        type: 'POST',
        url: '././includes/Lista_cursos/buscar.php',
        data: {'buscar': buscar},
        beforeSend: function(){
          $('#result').html('Buscando...')
        }
      })
      .done(function(resultado){
        $('#result').html(resultado)
      })
      .fail(function(){
        alert('Error')
      })
    })
  })

  