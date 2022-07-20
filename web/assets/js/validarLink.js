$(document).ready(()=>{
    $("#buttonEnviar").on("click",()=>{
        event.preventDefault()
        const inputLink = document.getElementById("linkValidate").value
        const valid = inputLink.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        if(valid!==null){
            alertaAgregar()
            const form = document.getElementById("form-agretemas2")
            form.submit()
        }else{
            const label = document.getElementById("labelLinkValidate")
            label.style.display = ""
        }
    })
})