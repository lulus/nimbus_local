$(function () {
    $("#dashboard").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#dashboard_wrapper .col-md-6:eq(0)');
    
    $("#services").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });

    $("#nas").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      });

    $("#policies").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
     });

     $("#roles").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
     }); 

     $("#users").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false
     });
});