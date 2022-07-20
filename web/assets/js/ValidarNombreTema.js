$(document).ready(()=>{
    $("#buttonEnviar").on("click",()=>{
        event.preventDefault()
        const name = document.getElementById("temas_agregar").value
        const valid = name.match(/([A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$)/g);
        if(valid!==null){
            alertaAgregar()
            const form = document.getElementById("form-agretemas2")
            form.submit()
        }else{
            const label = document.getElementById("temaValido")
            label.style.display = ""
        }
    })
})