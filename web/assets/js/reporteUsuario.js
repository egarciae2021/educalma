$(document).ready(()=>{
    console.log("red");
});

const completarTabla = ()=>{
    //filtros
    const nombre = document.getElementById("inputNombre").value
    const curso = document.getElementById("inputCurso").value
    const fecha = document.getElementById("inputInscripcion").value
    const fecha_final = document.getElementById("inputFinalizacion").value
    const avance = document.getElementById("inputAvance").value
    const estado = document.getElementById("inputEstado").value

    const tableBody = document.getElementById("body-table-filter")
    $.ajax({
        type:"POST",
        url:"controlador/ControladorFiltroReporte.php",
        data:{nombre,curso,fecha,fecha_final,avance,estado},
        success:(response)=>{
            tableBody.innerHTML=response
        },
        error:(err)=>{
            console.log(err);
        }
    })
}