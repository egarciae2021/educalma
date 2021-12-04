$(document).ready(() => {
  // Password change type and icon
  $("#basic-addon2").click((e) => {
    var txt = $("#txtPass");
    var icon = $("#basic-addon2 i");
    if (txt.attr("type") === "password") {
      txt.attr("type", "text");
      icon.attr("class", "fa fa-eye")
    } else {
      txt.attr("type", "password");
      icon.attr("class", "fa fa-eye-slash")
    }
  });

  $("#form_data").submit((e) => e.preventDefault())

  var partAction = 0;
  var email;
  var pass;
  var firstname;
  var lastname1;
  var lastname2;
  var tdoc;
  var doc;
  var fnac;
  var cel;
  var pais;
  var gen;

  // Validar correo
  $("#btnSubmit").click((e) => {
    email = partAction === 0 ? $("#txtEmail").val() : email;
    if (partAction === 0) {
      if (document.getElementById("txtEmail").validity.valid) {
        var formData = new FormData();
        formData.append('email', email);
        fetch("./verifiedCorreo.php", {
          method: 'POST',
          body: formData
        }).then(response => response.json())
          .catch(error => console.error('Error:', error))
          .then(response => {
            $("#txtEmail").val(email);
            if (response.cantidad === "0") {
              $("#lblEmail").text("Correo");
              $("#txtEmail").removeClass("is-invalid").addClass("is-valid").attr("readonly", "");
              $("#passBox").removeClass("d-none").addClass("d-block");
              $("#passBox input").focus();
              $("#btnSubmit").text("REGISTRARSE");
              partAction = 1;
            }
            else {
              $("#txtEmail").removeClass("is-valid").addClass("is-invalid");
              $("#correoMessage").html("¡El correo ya está registrado! <a href='./iniciosesion.php'>Inicia sesión aquí</a>!")
            }
          });
      } else $("#correoMessage").text("¡Debe ingresar su correo!").addClass("is-invalid")
    } else if (partAction === 1) {
      pass = $("#txtPass").val();
      $("#first-data").addClass("d-none");
      $("#second-data").removeClass("d-none").addClass("d-block");
      $("#txtNombres").focus();
      $("#btnSubmit").text("CONTINUAR →");
      partAction = 2;
    } else if (partAction === 2) {
      firstname = $("#txtNombres").val();
      lastname1 = $("#txtAPaterno").val();
      lastname2 = $("#txtAMaterno").val();
      tdoc = $("#cmbTDocumento").val();
      doc = $("#txtDocumento").val();
      $("#txtNacimiento").focus();
      $("#second-data").removeClass("d-block").addClass("d-none");
      $("#three-data").removeClass("d-none").addClass("d-block");
      partAction = 3;
    } else if (partAction === 3) {
      fnac = $("#txtNacimiento").val();
      cel = $("#txtCelular").val();
      pais = $("#cmbPais").val();
      gen = $("#cmbGenero").val();

      var formData = new FormData();
      formData.append('nombres_registrar', firstname);
      formData.append('apellidoPat_registrar', lastname1);
      formData.append('apellidoMat_registrar', lastname2);
      formData.append('email_user_registrar', email);
      formData.append('pass_registrar', pass);
      formData.append('telef_registrar', cel);
      formData.append('tipo_documento', tdoc);
      formData.append('num_docu_registrar', doc);
      formData.append('sexo', gen);
      formData.append('fecha_registrar', fnac);
      formData.append('pais_registrar', pais);

      fetch("./register.php", {
        method: 'POST',
        body: formData
      }).then(response => response.ok)
        .catch(error => console.error('Error:', error))
        .then(() => { alert("¡Registro éxitoso!"); window.location.href = "./iniciosesion.php" })
      // alert("¡Registro éxitoso!");
    }
  })
});