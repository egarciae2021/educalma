// Creado por: Lorenzo GR
document.addEventListener("DOMContentLoaded", () => {
  // Ocultar mensajes de los input al iniciar
  hiddenMsg();

  // Enlaces a elementos
  let btnImage = document.getElementById("searchImage");
  let inputImage = document.getElementsByName("imagen")[0];
  let imgView = document.getElementById("imgView");
  let pass = document.getElementById("txtPass");
  let passRep = document.getElementById("txtRepPass");

  // Click de foto de perfil
  btnImage.addEventListener("click", () => {
    inputImage.click();
  });

  // Saber cuando se selecciona una imagen
  inputImage.addEventListener("change", () => {
    const archivos = inputImage.files;

    // Si contiene un archivo asignarlo a un IMG
    if (archivos.length == 1) {
      const objectURL = URL.createObjectURL(archivos[0]);
      imgView.src = objectURL;
    }

    btnImage.querySelector("span").style.display = "none";
    imgView.style.display = "block";
  });

  // Cuando cargan la IMG
  imgView.addEventListener("load", () => {
    if (this.innerWidth >= this.innerHeight) imgView.style.width = "100%";
    else imgView.style.height = "100%";
  });

  // Al soltar una tecla en input:password
  pass.addEventListener("keyup", (e) => {
    // Siguiente elemento del elemento que causo el evento
    let nivel = e.target.nextElementSibling;

    let lng = pass.value.length;

    // Validaciones para input:password
    var eRegMay = "[A-Z]";
    var eRegMin = "[a-z]";
    var eRegNum = /^[0-9]+$/;
    var eRegCar = "[!-#-$-*-+-:-;-<->]";

    // Si la lognitud de caracteres es >= 8 hacer
    nivel.querySelector("ul > .min8").style.color = lng >= 8 ? "green" : "red";

    var menMay = false,
      menMin = false,
      menNum = false,
      menCar = false;
    // Ciclo para recorrer cada uno de los caracteres
    for (var i = 0; i < lng; i++) {
      if (pass.value[i].match(eRegMay)) menMay = true;
      if (pass.value[i].match(eRegMin)) menMin = true;
      if (pass.value[i].match(eRegNum)) menNum = true;
      if (pass.value[i].match(eRegCar)) menCar = true;
    }
    // Asignar color GREEN cuando un valor este en TRUE
    nivel.querySelector("ul > .men-may").style.color = menMay ? "green" : "red";
    nivel.querySelector("ul > .men-min").style.color = menMin ? "green" : "red";
    nivel.querySelector("ul > .men-num").style.color = menNum ? "green" : "red";
    nivel.querySelector("ul > .men-car").style.color = menCar ? "green" : "red";
  });

  // Al soltar un tecla en input:password repeat
  passRep.addEventListener("keyup", () => {
    // Cambiar de color a su hermano del elemento que causo el evento
    passRep.nextElementSibling.style.color =
      pass.value === passRep.value
        ? "transparent"
        : passRep.value == ""
        ? "transparent"
        : "#dc3545";
    passRep.nextElementSibling.style.fontWeight =
      pass.value === passRep.value ? "" : "bold";
  });

  // Funciones para soltar
  const dropArea = document.getElementById("searchImage");

  dropArea.addEventListener("dragover", (event) => {
    event.stopPropagation();
    event.preventDefault();
    // Style the drag-and-drop as a "copy file" operation.
    event.dataTransfer.dropEffect = "copy";
  });

  dropArea.addEventListener("drop", (event) => {
    event.stopPropagation();
    event.preventDefault();
    const fileList = event.dataTransfer.files;
    // imgView.src = URL.createObjectURL(fileList.item(0));
    var files2 = new Array(fileList.item(0));
    inputImage.value = files2;
  });
});

// Function para ocultar los mensajes de validaciones
let hiddenMsg = () => {
  let selects = document.querySelectorAll("form .input > select");
  // Recorrer select por select
  for (var i = 0; i < selects.length; i++) {
    if (selects[i].value == 0) {
      selects[i].nextElementSibling.style.color = "transparent";
      listenSelect(selects[i]);
    }
  }
};

// Suscripcion a evento CHANGE
let listenSelect = (slc) => {
  slc.addEventListener("change", (e) => {
    e.target.nextElementSibling.style.color =
      e.target.value != 0 ? "transparent" : "#dc3545";
  });
};
