document.addEventListener("DOMContentLoaded", () => {
  const greenEffect = (e) => {
    let ctrl = e.target === undefined ? e : e.target;
    if (ctrl.tagName === "INPUT" && ctrl.type === "radio") {
      $(ctrl).removeClass("is-invalid");
      $(ctrl).addClass("is-valid");
    } else {
      $(ctrl).removeClass("is-invalid");
      $(ctrl).addClass("is-valid");
    }
  };

  const redEffect = (e) => {
    let ctrl = e.target === undefined ? e : e.target;
    if (ctrl.tagName === "INPUT" && ctrl.type === "radio") {
      $(ctrl).removeClass("is-valid");
      $(ctrl).parent().parent().addClass("is-invalid");
    } else {
      $(ctrl).removeClass("is-valid");
      $(ctrl).addClass("is-invalid");
    }
  };

  // Formato JS
  let controlsArray = [
    {
      // Selector
      element: "input[type=text]",
      // Propiedades a asignar
      properties: [
        {
          required: true,
          minlength: 3,
        },
      ],
      // Eventos
      events: ["keyup", "focus", "blur"],
      // Validado (true) - (function)
      validAction: greenEffect,
      // No validado (false) - (function)
      noValidAction: redEffect,
    },
    {
      element: "input[type=number]",
      properties: [
        {
          required: true,
          min: 0,
        },
      ],
      events: ["keyup", "focus", "blur"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input[type=email]",
      properties: [
        {
          required: true,
        },
      ],
      events: ["keyup", "focus", "blur"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input[type=tel]",
      properties: [
        {
          required: true,
          pattern: ".{7,}",
        },
      ],
      events: ["keyup", "focus", "blur"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input#Numero",
      properties: [
        {
          required: true,
          pattern: ".{8,}",
        },
      ],
      events: ["keyup", "focus", "blur"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input[type=password]",
      properties: [
        {
          required: true,
          pattern:
            "(?=^.{8,}$)((?=.*\\d)|(?=.*\\W+))(?![.\\n])(?=.*[A-Z])(?=.*[a-z]).*$",
        },
      ],
      events: ["keyup", "focus", "blur"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input[type=radio]",
      properties: [
        {
          required: true,
        },
      ],
      events: ["change"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "input[type=date]#Fecha",
      properties: [
        {
          required: true,
          min: FormatLocal(getMaxMinDate(18, 115).fMin),
          max: FormatLocal(getMaxMinDate(18, 115).fMax),
        },
      ],
      events: ["change"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
    {
      element: "select",
      properties: [
        {
          required: true,
        },
      ],
      events: ["change"],
      validAction: greenEffect,
      noValidAction: redEffect,
    },
  ];

  ValidControl(controlsArray);
});
