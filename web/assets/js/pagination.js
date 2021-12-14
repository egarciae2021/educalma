$(document).ready(function () {
    $("#example5").DataTable({
      //"responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "scrollX": true,
      "language": {
        "lengthMenu": "Display _MENU_ records per page",
        "zeroRecords": "Nada que ver. Lo sentimos.",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "Sin datos disponibles.",
        "infoFiltered": "(Filtrado de _MAX_ datos totales.)",
        "paginate": {
          "first":    'Pimero',
          "previous": "Anterior",
          "next": "Siguiente",
          "last": "Último",
        },
        "search": "Buscar: "
      },
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)');
});
