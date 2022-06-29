// Tabla para mis consultas - consultas aceptadas
$(document).ready(function () {
  $("#tablaCursos").DataTable({
    //"responsive": true, 
    "lengthChange": false, 
    "autoWidth": true,
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
    }
  }).buttons().container().appendTo('#tablaCursos_wrapper .col-md-6:eq(0)');
});
$(document).ready(function () {
$("#tablaCategorias").DataTable({
  //"responsive": true, 
  "lengthChange": false, 
  "autoWidth": true,
  "scrollX": true,
  "searching": false,
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
    } ,
   
  }
}).buttons().container().appendTo('#tablaCategorias_wrapper .col-md-6:eq(0)');
});

//Tabla para administrar medicos
$(document).ready(function () {
$("#tableUsuarios").DataTable({
  //"responsive": true, 
  "lengthChange": false, 
  "autoWidth": true,
  "scrollX": true,
  "searching": false,
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
  }
}).buttons().container().appendTo('#tableAdminMedico_wrapper .col-md-6:eq(0)');
});

$(document).ready(function () {
$("#tablaEmpleados").DataTable({
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
  }
}).buttons().container().appendTo('#tablaEmpleados_wrapper .col-md-6:eq(0)');
});

//Tabla para administrar usuarios
$(document).ready(function () {
$("#tableAdminUser").DataTable({
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
}).buttons().container().appendTo('#tableAdminUser_wrapper .col-md-6:eq(0)');
});

//Tabla para administrar admins
$(document).ready(function () {
$("#example1").DataTable({
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
}).buttons().container().appendTo('#tableAdmins_wrapper .col-md-6:eq(0)');
});

