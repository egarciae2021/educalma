// // Formato JS
// let controlsArray = [
//   {
//     // Selector
//     element: "input[type=text]",
//     // Propiedades a asignar
//     properties: [
//       {
//         required: true,
//         minlength: 3,
//         maxlength: 8,
//       },
//     ],
//     // Eventos
//     events: ["keyup", "focus", "blur"],
//     // Validado (true) - (function)
//     validAction: (e) => {
//       console.log("Validado");
//     },
//     // No validado (false) - (function)
//     noValidAction: (e) => {
//       console.log("No validado");
//     },
//   },
// ];

// -- OBTENER LAS FECHAS CORRESPONDIENTES A EDADES LIMITES
const getMaxMinDate = (yearMin, yearMax) => {
  let fcurr = new Date(Date.now());
  const fmin = new Date(fcurr.setMonth(fcurr.getMonth() - 12 * yearMax));
  fcurr = new Date(Date.now());
  const fmax = new Date(fcurr.setMonth(fcurr.getMonth() - 12 * yearMin));
  return {
    fMin: fmin,
    fMax: fmax,
  };
};

// FORMATEAR FECHA EN FORMATO dd-mm-yyyy
// IMPORTANTE: INPUT:DATE NECESITA ESE FORMATO SI O SI PARA FUNCIONAR
const FormatLocal = (date) => {
  return (
    new Date(date).getFullYear() +
    "-" +
    zfill(new Date(date).getMonth() + 1, 2) +
    "-" +
    new Date(date).getDate()
  );
};

// -- RELLENAR NUMEROS
// EJEMPLO:
// number = 5
// width = 3
// result = 005
const zfill = (number, width) => {
  var numberOutput = Math.abs(number); /* Valor absoluto del número */
  var length = number.toString().length; /* Largo del número */
  var zero = "0"; /* String de cero */

  if (width <= length) {
    if (number < 0) {
      return "-" + numberOutput.toString();
    } else {
      return numberOutput.toString();
    }
  } else {
    if (number < 0) {
      return "-" + zero.repeat(width - length) + numberOutput.toString();
    } else {
      return zero.repeat(width - length) + numberOutput.toString();
    }
  }
};

// Funcion con parametro de los selectores, propiedades y callback (Validado)
const ValidControl = (controls) => {
  // Recorrer todos los selectores
  for (let i = 0; i < controls.length; i++) {
    // Guardar busqueda del selector como arreglo
    let obj = document.querySelectorAll(controls[i].element);
    // Guardar selectores en un arreglo
    let props = Object.keys(controls[i].properties[0]);

    // Guardar eventos a escuchar en un arreglo
    let events = controls[i].events;
    // console.log(events);

    // Recorrer el arreglo de selectores
    for (let j = 0; j < obj.length; j++) {
      // Recorrer propiedades
      for (let k = 0; k < props.length; k++) {
        // Asignar propiedades a cada elemento correspondiente
        obj[j].setAttribute(props[k], controls[i].properties[0][props[k]]);
      }
      if (obj[j].tagName === "INPUT" && obj[j].type === "radio") {
        if (obj[j].name.length <= 0) {
          // console.log(obj[j]);
        } else {
          let lstSelect = document.getElementsByName(obj[j].name);
          if (obj[j] === lstSelect[lstSelect.length - 1]) {
            // console.log("Ultimo");
            for (let k = 0; k < events.length; k++) {
              lstSelect.forEach((element) => {
                if (element.checked)
                  showFunction(controls[i].validAction, null, element);
                // console.log(element.checked);
                element.addEventListener(events[k], (ev) => {
                  if (ev.target.checked) {
                    // Llamar a la funcion cuando esta validado
                    showFunction(controls[i].validAction, ev, ev.target);
                  } else {
                    // Llamar a la funcion cuando no esta validado
                    showFunction(controls[i].noValidAction, ev, ev.target);
                  }
                });
              });
            }
          }
        }
      } else {
        // Si ya contiene datos al cargar la pagina
        if (obj[j].value.length > 0 && obj[j].validity.valid) {
          showFunction(controls[i].validAction, null, obj[j]);
        }
        for (let k = 0; k < events.length; k++) {
          // Eventos a escuchar
          obj[j].addEventListener(events[k], (ev) => {
            // Propiedad "Valid"
            if (obj[j].validity.valid) {
              // Llamar a la funcion cuando esta validado
              showFunction(controls[i].validAction, ev, ev.target);
            } else {
              // Llamar a la funcion cuando no esta validado
              showFunction(controls[i].noValidAction, ev, ev.target);
            }
          });
        }
      }
    }
  }
};

const showFunction = (Callback, e = null, control = null) => {
  Callback(e === null ? control : e);
};
