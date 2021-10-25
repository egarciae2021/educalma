document.addEventListener("DOMContentLoaded", () => {
  $("#btnToggle").click(() => {
    $("#mainContex").toggleClass("show");
  });

  $("#iconUser").click(() => {
    $("#mainData").toggleClass("show");
  });
});
