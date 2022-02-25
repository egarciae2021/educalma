

// ====================== Pay ======================
document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todos los inputs
    let inputs = document.querySelectorAll("input");
  
    // Recorre los inputs para suscribir al evento
    inputs.forEach((input, _) => {
      // Efecto del placeholder
      input.addEventListener("focusin", (e) => {
        getParents(e.target, ".group-input").classList.add("active");
      })
      input.addEventListener("focusout", (e) => {
        getParents(e.target, ".group-input").classList.remove("active");
      })
    })
  
    validInputs();
    addSpaceNumberCard();
    addSlashDate();
  
    document.getElementById("dataForm").addEventListener("submit", (e) => {
      e.preventDefault();
      // let pseudoForm = document.createElement("form");
      // document.querySelectorAll("#dataForm input, #dataForm select").forEach(element => {
      //   pseudoForm.append(element);
      // });
  
      Swal.fire({
        title: "¿Está seguro de realizar el pago?",
        text: "Al confirmar el pago, ya no se podrá cancelar.",
        icon: "warning",
        confirmButtonText: "Confirmar",
        showCancelButton: true
      }).then(() => {
        document.getElementById("preloader").classList.add("active");
        fetch("./sendData/pay.php", {
          method: "POST",
          body: new FormData(document.getElementById("dataForm"))
        })
          .then(resp => resp.json())
          .then((resp) => {
            Swal.fire({
              title: resp.message.title,
              text: resp.message.cuerpo,
              icon: resp.message.icon
            })
          })
          .catch((err) => console.error(err))
          .finally(() => {
            document.getElementById("preloader").classList.remove("active");
          })
      },
        (dismiss) => {
          if (dismiss === "cancel") {
            Swal.fire({
              title: "¡No se realizó ningún pagó!",
            })
          }
        })
    });
  });
  
  // Validadores
  const validRegex = {
    "lettersWithSpace": /^([a-zA-Z]{1,}[ ]{0,})+$/i,
    "lettersWithSpaceOrEmpty": /^([a-zA-Z]{0,}[ ]{0,})+$/i,
    "email": /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i,
    "creditCard": /^\d{4}[ ]{1}?\d{4}[ ]{1}?\d{4}[ ]{1}?\d{4}$/,
    "cadDate": /^\d{2}\/\d{2}$/,
    "cvv": /^[0-9]{3,4}$/
  };
  
  
  const validInputs = () => {
    suscribirEvent(document.querySelector("#txtNombre"), validRegex.lettersWithSpace);
    suscribirEvent(document.querySelector("#txtApellido"), validRegex.lettersWithSpace);
    suscribirEvent(document.querySelector("#txtCorreo"), validRegex.email);
    suscribirEvent(document.querySelector("#txtNumTarget"), validRegex.creditCard);
    suscribirEvent(document.querySelector("#txtFechaVencimiento"), validRegex.cadDate);
    suscribirEvent(document.querySelector("#txtCodigoSeguridad"), validRegex.cvv);
  }
  
  // Generar espacios entre los numeros de tarjeta
  const addSpaceNumberCard = () => {
    document.getElementById("txtNumTarget").addEventListener("keyup", (e) => {
      let valor = e.target.value;
      let positionSeparator = [5, 10, 15]
  
      positionSeparator.forEach((pos, _) => {
        if (valor.length >= pos && valor[pos - 1] !== " ") {
          var temp = valor.slice(pos - 1, valor.length);
          valor = valor.slice(0, pos - 1) + " " + temp
        }
      })
  
      e.target.value = valor;
    })
  }
  
  const addSlashDate = () => {
    document.getElementById("txtFechaVencimiento").addEventListener("keyup", (e) => {
      let valor = e.target.value;
  
      if (valor.length >= 3 && (valor[2] !== " " && valor[2] !== "/")) {
        var temp = valor.slice(2, valor.length);
        valor = valor.slice(0, 2) + "/" + temp
      }
  
      e.target.value = valor;
    })
  }
  
  const suscribirEvent = (control, regex) => {
    // Validar en caso tenga algun valor
    if (control.value != "")
      validInput(control, regex,
        () => addClassValid(0, control, ".group-input"),
        () => addClassValid(1, control, ".group-input"),
        () => addClassValid(2, control, ".group-input"));
  
    // Validar cuando ocurrar evento focus
    control.addEventListener("focusout", () => {
      validInput(control, regex,
        () => addClassValid(0, control, ".group-input"),
        () => addClassValid(1, control, ".group-input"),
        () => addClassValid(2, control, ".group-input"));
    })
  
    // Validar cuando ocurrar evento keyup
    control.addEventListener("keyup", () => {
      validInput(control, regex,
        () => addClassValid(0, control, ".group-input"),
        () => addClassValid(1, control, ".group-input"),
        () => addClassValid(2, control, ".group-input"));
    })
  }
  
  // Agregar clase para validar
  const addClassValid = (action, control, parent) => {
    var control = getParents(control, parent);
  
    switch (action) {
      default:
      case 0:
        control.classList.remove("invalid-wtext");
        control.classList.remove("invalid");
        control.classList.add("valid");
        break;
      case 1:
        control.classList.remove("invalid-wtext");
        control.classList.remove("valid");
        control.classList.add("invalid");
        break;
      case 2:
        control.classList.remove("valid");
        control.classList.remove("invalid");
        control.classList.add("invalid-wtext");
        break;
    }
  }
  
  // Validador
  const validInput = (control, restriccion, Verdadero, Falso, Falso2) => {
    if (restriccion.test(control.value)) Verdadero();
    else if (control.value !== "") Falso2()
    else Falso();
  }
  
  // Buscar el primer padre con coincidencia
  const getParents = (element, encontrar) => {
    let condicion = false;
    do {
      element = element.parentNode;
      if (element.matches(encontrar))
        condicion = true;
    } while (!condicion);2
    return element;
  }
  