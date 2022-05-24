const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
  el.addEventListener("click", function() {
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
  });
}


for (const el of closeEls) {
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
}



// Cerrar haciendo click en el botón cancelar.
$(document).ready(function(){

	$(".btnCancelar").click(function(){

		document.querySelector(".modal.is-visible").classList.remove(isVisible);

            Swal.fire({
        
              icon: 'error',
              allowOutsideClick: false,
              title: 'Cancelaste tu pago por tarjeta VISA',
              confirmButtonText: 'Aceptar',

        
            }).then((result) => {
      
              if (result.isConfirmed) {

                  // Limpiar
                  $('input[type="text"]').val('');
                

              } else if (result.isDenied) {
              
              }
            })
	});
});



// Cerrar haciendo click en ESC.
/*
document.addEventListener("keyup", e => {
  // if we press the ESC
  if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});
*/