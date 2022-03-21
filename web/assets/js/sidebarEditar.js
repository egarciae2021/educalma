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

  $('#cmbPais').on('click',function(){
    if($('#cmbPais').val()){ 
      $('#cmbPais option[value!='+$('#cmbPais').val()+']').removeAttr('selected','selected');
      $('#cmbPais option[value='+$('#cmbPais').val()+']').attr('selected','selected');
      }
      if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Perú' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Chile' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Brasil'){ 

        $('input[name=telefono]').attr('min','99999999');
        $('input[name=telefono]').attr('max','999999999');
        var input=  document.getElementById('Telefono');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=telefono]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=telefono]').attr('max').length); 
        })
        
      }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'México' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Argentina' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Ecuador' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Cuba'){
        $('input[name=telefono]').attr('min','999999999')
        $('input[name=telefono]').attr('max','9999999999')
        var input=  document.getElementById('Telefono');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=telefono]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=telefono]').attr('max').length); 
        })
        }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Venezuela'){
        $('input[name=telefono]').attr('min','999999')
        $('input[name=telefono]').attr('max','9999999')
        var input=  document.getElementById('Telefono');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=telefono]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=telefono]').attr('max').length); 
        })
      }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Bolivia' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Panamá' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'El Salvador' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Dinamarca' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'República Dominicana'){
        $('input[name=telefono]').attr('min','9999999')
        $('input[name=telefono]').attr('max','99999999')
        var input=  document.getElementById('Telefono');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=telefono]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=telefono]').attr('max').length); 
        })
      }else{
        $('input[name=telefono]').attr('min','9999999999')
        $('input[name=telefono]').attr('max','99999999999')
        var input=  document.getElementById('Telefono');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=telefono]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=telefono]').attr('max').length); 
        })
      }
      $('input[name=telefono]').removeClass("is-invalid").removeClass("is-valid");
    });

  $('#Tipod').on('click',function(){
    
    console.log($('#Tipod option[value='+$('#Tipod').val()+']').val())
    console.log($('input[name=nume_documento]').attr('id'))
    if($('#Tipod').val()){ 
      $('#Tipod option[value!='+$('#Tipod').val()+']').removeAttr('selected','selected');
      $('#Tipod option[value='+$('#Tipod').val()+']').attr('selected','selected');
      }
      if($('#Tipod option[value='+$('#Tipod').val()+']').val() == 1){ 

        $('input[name=nume_documento]').attr('min','9999999')
        $('input[name=nume_documento]').attr('max','99999999')
        var input=  document.getElementById('Numero');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=nume_documento]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=nume_documento]').attr('max').length); 
        })
        
      }else if($('#Tipod option[value='+$('#Tipod').val()+']').val() == 2 || $('#Tipod option[value='+$('#Tipod').val()+']').val() == 3){
        $('input[name=nume_documento]').attr('min','99999999999')
        $('input[name=nume_documento]').attr('max','999999999999')
        var input=  document.getElementById('Numero');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=nume_documento]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=nume_documento]').attr('max').length); 
        })
        }else{
        $('input[name=nume_documento]').attr('min','9999999999')
        $('input[name=nume_documento]').attr('max','99999999999')
        var input=  document.getElementById('Numero');
        input.addEventListener('input',function(){
          if (this.value.length > $('input[name=nume_documento]').attr('max').length) 
             this.value = this.value.slice(0,$('input[name=nume_documento]').attr('max').length); 
        })
      }
      $('input[name=nume_documento]').removeClass("is-invalid").removeClass("is-valid");
    });
  
    

  // Formato JS
  var controlsArray = [
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
      element: "input#Telefono",
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
      element: 'input#Numero',
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
    }
  ];

  ValidControl(controlsArray);
});
