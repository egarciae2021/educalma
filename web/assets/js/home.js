$(function () {
  $(document).scroll(function () {
    var $nav = $("header");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const validEmail = () => {
    // Correos no corporativos
    var domaininvalidate = [
      "@gmail.com",
      "@hotmail.com",
      "@outlook.es"
    ];

    var exists = false;

    domaininvalidate.forEach((val, index) => {
      if ($("#txtEmail").val().indexOf(val) > -1) {
        exists = true;
      }
    })

    return exists;
  }

  // Verificar si es correo corporativo
  $("#btnAction").click(() => {
    if (!validEmail()) {
      if (validarEmail($("#txtEmail").val())) {
        window.location.href = "./#boxRotate";
        scrollTo(scrollX, scrollY - 100);
        $(".back input").first().focus();
        $("#boxRotate").addClass("active")
        $($(".box-email > .msg-error")[0]).removeClass("show")
      }
    } else
      $($(".box-email > .msg-error")[0]).addClass("show")
  })

  // Mostrar Paises
  $("#btnPais").click(() => {
    if ($("#listPais").attr("class").indexOf("show") > -1)
      $("#listPais").removeClass("show")
    else $("#listPais").addClass("show")
  })

  // Seleccinar codigo de pais
  $("#listPais").on("click", "li", (e) => {
    // Consulta si el eelemento que ha sido presionado es un LI
    // Si lo es lo selecciona
    // Sino busca al padre que sea LI
    // Selecciona y guarda el control
    let control = e.target.tagName === "LI" ? e.target : $(e.target).parents("li")[0];

    // Inserta el contenido de la propiedad alt de el primer hijo
    // del control anteriormente seleccionado
    // Y se lo asigna a #code
    $("#code").attr("value", control.children[0].alt)
    // El mismo hijo selecciona la propiedad "src" y se lo asigna a #imgPais
    $("#imgPais").attr("src", control.children[0].src)
    // Oculta lista de Paises
    $("#listPais").removeClass("show")
  })

  // Para aumentar numero de suscripciones
  $("#plusNumber").click((e) => {
    $("#numSusc").val(parseInt($("#numSusc").val()) + 1 || 0)
  })
  // Para reducir numero de suscripciones
  $("#quitNumber").click((e) => {
    var numberSus = parseInt($("#numSusc").val()) || 0;
    $("#numSusc").val(numberSus > 0 ? numberSus - 1 : 0)
  })

  const error_catch = { "TITLE_RESP": "¡ERROR!", "TEXT_RESP": "EL SERVIDOR NO HA RETORNADO RESPUESTA.", "TYPE_RESP": "error", "REFREST_RESP": 1 };

  const ShowMessage = (resp) => {
    // Si no retorna la respuesta esperada
    if (resp !== undefined) {
      Swal.fire({
        title: resp["TITLE_RESP"],
        text: resp["TEXT_RESP"],
        icon: resp["TYPE_RESP"]
      }).then(() => { if (resp["REFREST_RESP"] == "1") location.href = "."; });
    }
    else {
      Swal.fire({
        title: error_catch["TITLE_RESP"],
        text: error_catch["TEXT_RESP"],
        icon: error_catch["TYPE_RESP"]
      })
    }

  };

  $('#btnSendRequest').click(() => {
    if (!validEmail()) {
      // Data
      let frmData = new FormData();
      // Correo corporativo
      frmData.append("txtEmail", $("#txtEmail").val());
      // Nombre completos
      frmData.append("nomCompleto", $("#nomCompleto").val());
      // Correo personal
      frmData.append("txtCorreo", $("#txtCorreo").val());
      // Empresa
      frmData.append("txtEmpresa", $("#txtEmpresa").val());
      // Codigo de pais
      frmData.append("code", $("#code").val());
      // Telefono movil
      frmData.append("txtTelMovil", $("#txtTelMovil").val());
      // Tamanio  de la empresa
      frmData.append("tamEmpresa", $('#txtTamEmpresa').val());
      // No suscripcions
      frmData.append("numSusc", $('#numSusc').val());
      // Objetivo
      frmData.append("objEmpresa", $("#objEmpresa").val());

      // Hacer peticion
      fetch("includes/Inicio/sendRequest.php", {
        method: 'POST',
        body: frmData
      })
        .then((resp) => resp.ok ? resp.json() : error_catch)
        .catch(() => error_catch)
        .then(ShowMessage);
    }
    else {
      $($(".box-email > .msg-error")[0]).addClass("show");
      $("#txtEmail").focus();
      Swal.fire({
        title: "¡CORREO INVÁLIDO!",
        text: "EL CORREO NO ES CORPORATIVO.",
        icon: "warning",
      })
    }
  })


})

function validarEmail(valor) {
  return /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)
}