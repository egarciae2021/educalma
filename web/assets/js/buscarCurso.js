$(document).ready(function(){
  $('.buscar').focus();
    $('#buscar').on('keyup', function(){
      var buscar = $('#buscar').val()
      $.ajax({
        type: 'POST',
        url: '././includes/Lista_cursos/buscar.php',
        data: {'buscar': buscar},
      })
      .done(function(resultado){
        $('#result').html(resultado)
      })
      .fail(function(){
        alert('Error')
      })
    })
  })

  