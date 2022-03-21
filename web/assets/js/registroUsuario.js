$(document).ready(() => {
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
    
            $('#txtCelular').attr('min','99999999');
            $('#txtCelular').attr('max','999999999');
            var input=  document.getElementById('txtCelular');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtCelular').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtCelular').attr('max').length); 
            })
            
          }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'México' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Argentina' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Ecuador' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Cuba'){
            $('#txtCelular').attr('min','999999999')
            $('#txtCelular').attr('max','9999999999')
            var input=  document.getElementById('txtCelular');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtCelular').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtCelular').attr('max').length); 
            })
            }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Venezuela'){
            $('#txtCelular').attr('min','999999')
            $('#txtCelular').attr('max','9999999')
            var input=  document.getElementById('txtCelular');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtCelular').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtCelular').attr('max').length); 
            })
          }else if($('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Bolivia' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Panamá' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'El Salvador' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'Dinamarca' || $('#cmbPais option[value='+$('#cmbPais').val()+']').val() == 'República Dominicana'){
            $('#txtCelular').attr('min','9999999')
            $('#txtCelular').attr('max','99999999')
            var input=  document.getElementById('txtCelular');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtCelular').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtCelular').attr('max').length); 
            })
          }else{
            $('#txtCelular').attr('min','9999999999')
            $('#txtCelular').attr('max','99999999999')
            var input=  document.getElementById('txtCelular');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtCelular').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtCelular').attr('max').length); 
            })
          }
          $('#txtCelular').removeClass("is-invalid").removeClass("is-valid");
        });

    $('#cmbTDocumento').on('click',function(){
    
        console.log($('#cmbTDocumento option[value='+$('#cmbTDocumento').val()+']').val())
        console.log($('#txtDocumento').attr('id'))
        if($('#cmbTDocumento').val()){ 
          $('#cmbTDocumento option[value!='+$('#cmbTDocumento').val()+']').removeAttr('selected','selected');
          $('#cmbTDocumento option[value='+$('#cmbTDocumento').val()+']').attr('selected','selected');
          }
          if($('#cmbTDocumento option[value='+$('#cmbTDocumento').val()+']').val() == 1){ 
    
            $('#txtDocumento').attr('min','9999999')
            $('#txtDocumento').attr('max','99999999')
            var input=  document.getElementById('txtDocumento');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtDocumento').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtDocumento').attr('max').length); 
            })
            
          }else if($('#cmbTDocumento option[value='+$('#cmbTDocumento').val()+']').val() == 2 || $('#cmbTDocumento option[value='+$('#cmbTDocumento').val()+']').val() == 3){
            $('#txtDocumento').attr('min','99999999999')
            $('#txtDocumento').attr('max','999999999999')
            var input=  document.getElementById('txtDocumento');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtDocumento').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtDocumento').attr('max').length); 
            })
            }else{
            $('#txtDocumento').attr('min','9999999999')
            $('#txtDocumento').attr('max','99999999999')
            var input=  document.getElementById('txtDocumento');
            input.addEventListener('input',function(){
              if (this.value.length > $('#txtDocumento').attr('max').length) 
                 this.value = this.value.slice(0,$('#txtDocumento').attr('max').length); 
            })
          }
          $('#txtDocumento').removeClass("is-invalid").removeClass("is-valid");
        });

    // Formato JS
    let controlsArray = [{
        // Selector
        element: "input[type=text]",
        // Propiedades a asignar
        properties: [{
            required: true,
            minlength: 3,
        },],
        // Eventos
        events: ["keyup", "focus", "blur"],
        // Validado (true) - (function)
        validAction: greenEffect,
        // No validado (false) - (function)
        noValidAction: redEffect,
    },


    {
        element: "input[type=number]",
        properties: [{
            required: true,
        },],
        events: ["keyup", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input[type=text]",
        properties: [{
            required: true,
            pattern: "[a-zA-Z ]{3,254}",
        },],
        events: ["keyup", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input#txtCelular",
        properties: [{
            required: true,
        },],
        events: ["keyup", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input#txtDocumento",
        properties: [{
            required: true,
        },],
        events: ["keyup", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input[type=password]",
        properties: [{
            required: true,
            pattern: "(?=^.{8,}$)((?=.*\\d)|(?=.*\\W+))(?![.\\n])(?=.*[A-Z])(?=.*[a-z]).*$",
        },],
        events: ["keyup", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input[type=radio]",
        properties: [{
            required: true,
        },],
        events: ["change"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "input[type=date]#txtNacimiento",
        properties: [{
            required: true,
            min: FormatLocal(getMaxMinDate(18, 115).fMin),
            max: FormatLocal(getMaxMinDate(18, 115).fMax),
        },],
        events: ["change", "focus"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    {
        element: "select",
        properties: [{
            required: true,
        },],
        events: ["change", "focus", "blur"],
        validAction: greenEffect,
        noValidAction: redEffect,
    },
    ];

    ValidControl(controlsArray);

    // Password change type and icon
    $("#basic-addon2").click((e) => {
        var txt = $("#txtPass");
        var icon = $("#basic-addon2 i");
        if (txt.attr("type") === "password") {
            txt.attr("type", "text");
            icon.attr("class", "fa fa-eye");
        } else {
            txt.attr("type", "password");
            icon.attr("class", "fa fa-eye-slash");
        }
    });

    $("#form_data").submit((e) => e.preventDefault());

    var partAction = 0;
    var email = "";
    var pass = "";
    var firstname = "";
    var lastname1 = "";
    var lastname2 = "";
    var tdoc = "";
    var doc = 0;
    var fnac = "";
    var cel = "";
    var pais = "";
    var gen = "";
    var code = "";

    const Reset_data = () => {
        partAction = 0;
        $("#first-data").removeClass("d-none");
        email = "";
        $("#txtEmail")
            .val("")
            .removeClass("is-valid")
            .removeClass("is-invalid")
            .prop("readonly", false);
        $("#passBox")
            .addClass("d-none")
            .removeClass("is-invalid")
            .removeClass("is-valid");
        $("#second-data").addClass("d-none");
        $("#three-data").addClass("d-none");
        pass = "";
        $("#txtPass").val("").removeClass("is-invalid").removeClass("is-valid");
        firstname = "";
        $("#txtNombres").val("").removeClass("is-invalid").removeClass("is-valid");
        lastname1 = "";
        $("#txtAPaterno").val("").removeClass("is-invalid").removeClass("is-valid");
        lastname2 = "";
        $("#txtAMaterno").val("").removeClass("is-invalid").removeClass("is-valid");
        tdoc = "";
        $("#cmbTDocumento")
            .val("")
            .removeClass("is-invalid")
            .removeClass("is-valid");
        doc = "";
        $("#txtDocumento")
            .val(0)
            .removeClass("is-invalid")
            .removeClass("is-valid");
        fnac = "";
        $("#txtNacimiento")
            .val("")
            .removeClass("is-invalid")
            .removeClass("is-valid");
        cel = "";
        $("#txtCelular").val("").removeClass("is-invalid").removeClass("is-valid");
        pais = "";
        $("#cmbPais").val("").removeClass("is-invalid").removeClass("is-valid");
        gen = "";
        $("#cmbGenero").val("").removeClass("is-invalid").removeClass("is-valid");
        code = "";
        $("#txtcode").val("");
    };

    // Validar correo
    $("#btnSubmit").click((e) => {
        email = partAction === 0 ? $("#txtEmail").val() : email;
        if (partAction === 0) {
            if (document.getElementById("txtEmail").validity.valid) {
                var formData = new FormData();
                formData.append("email", email);
                fetch("./verifiedCorreo.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .catch((error) => console.error("Error:", error))
                    .then((response) => {
                        $("#txtEmail").val(email);
                        if (response.cantidad === 0 || response.cantidad === "0") {
                            $("#lblEmail").text("Correo");
                            $("#txtEmail")
                                .removeClass("is-invalid")
                                .addClass("is-valid")
                                .attr("readonly", "");
                            $("#passBox").fadeIn("slow").removeClass("d-none");
                            $("#passBox input").focus();
                            $("#btnSubmit").text("REGISTRARSE");
                            partAction = 1;
                        } else {
                            $("#txtEmail").removeClass("is-valid").addClass("is-invalid");
                            $("#correoMessage").html(
                                "¡El correo ya está registrado! <a href='./iniciosesion.php'>Inicia sesión aquí</a>"
                            );
                        }
                    });
            } else
                $("#correoMessage")
                    .text("¡Debe ingresar su correo!")
                    .addClass("is-invalid");
        } else if (partAction === 1) {
            if (document.getElementById("txtPass").validity.valid) {
                pass = $("#txtPass").val();
                $("#first-data").addClass("d-none");
                $("#second-data").fadeIn("slow").removeClass("d-none");
                $("#txtNombres").focus();
                $("#btnSubmit").text("CONTINUAR →");
                partAction = 2;
            } else {
                $("#txtPass").addClass("is-invalid");
            }
        }

        else if (partAction === 2) {
            if (
                document.getElementById("txtNombres").validity.valid &&
                document.getElementById("txtAPaterno").validity.valid &&
                document.getElementById("txtAMaterno").validity.valid &&
                document.getElementById("cmbTDocumento").validity.valid &&
                document.getElementById("txtDocumento").validity.valid
            ) {
                firstname = $("#txtNombres").val();
                lastname1 = $("#txtAPaterno").val();
                lastname2 = $("#txtAMaterno").val();
                tdoc = $("#cmbTDocumento").val();
                doc = $("#txtDocumento").val();
                $("#txtNacimiento").focus();
                $("#second-data").removeClass("d-block").addClass("d-none");
                $("#three-data").removeClass("d-none");
                partAction = 3;
            }
        } else if (partAction === 3) {
            if (
                document.getElementById("txtNacimiento").validity.valid &&
                document.getElementById("txtCelular").validity.valid &&
                document.getElementById("cmbPais").validity.valid &&
                document.getElementById("cmbGenero").validity.valid &&
                document.getElementById("txtcode")
            ) {
                fnac = $("#txtNacimiento").val();
                cel = $("#txtCelular").val();
                pais = $("#cmbPais").val();
                gen = $("#cmbGenero").val();
                code = $("#txtcode").val();

                var formData = new FormData();
                formData.append("nombres_registrar", firstname);
                formData.append("apellidoPat_registrar", lastname1);
                formData.append("apellidoMat_registrar", lastname2);
                formData.append("email_user_registrar", email);
                formData.append("pass_registrar", pass);
                formData.append("telef_registrar", cel);
                formData.append("tipo_documento", tdoc);
                formData.append("num_docu_registrar", doc);
                formData.append("sexo", gen);
                formData.append("fecha_registrar", fnac);
                formData.append("pais_registrar", pais);
                formData.append("codigo_registrar", code);

                fetch("./register.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.ok)
                    .catch((error) => console.error("Error:", error))
                    .then(() => {
                        Reset_data();
                        $("#regSuccess").modal({ backdrop: "static" });
                    });
            }
        }
    });

    $("#btnTogoLogin").click(() => {
        window.location.href = "./iniciosesion.php";
    });
});