
  

$(document).ready(function(){


    $.ajax({
        url: "api/movimientosall.api.php",
        method: "POST",
      
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
          if (respuesta != 0) {
            
            $.each(respuesta, function(i, item) {
              
              $("#tbody-movimientos").append(`
              <tr>
              <td> ${(respuesta[i]['banco'] == null) ? respuesta[i]['banco_inter'] : respuesta[i]['banco']}</td>
              <td>${(respuesta[i]['n_titular'] == null) ? respuesta[i]['n_titular_inter'] : respuesta[i]['n_titular']} ${(respuesta[i]['a_titular'] == null) ? respuesta[i]['a_titular_inter'] : respuesta[i]['a_titular']}</td>
              <td>${(respuesta[i]['monto']) == null ? respuesta[i]['monto_inter'] : respuesta[i]['monto'] }</td>
              <td>${(respuesta[i]['monto_actual']) == null ? ((respuesta[i]['signo'] == '+') ? '<span class="text-success">'+respuesta[i]['monto_actual_inter']+'</span>' :'<span class="text-danger"> -'+respuesta[i]['monto_actual_inter']+'</span>') : (respuesta[i]['signo'] == '+') ? '<span class="text-success"> -'+respuesta[i]['monto_actual']+'</span>': '<span class="text-danger"> -'+respuesta[i]['monto_actual']+'</span>'}</td>
              <td>${respuesta[i]['operacion']}</td>
              <td>${(respuesta[i]['signo'] == '+') ? '<i class="fas fa-arrow-alt-circle-up text-success"></i>': '<i class="fas fa-arrow-alt-circle-down text-danger"></i>'}</td>
            </tr>
            `);
              });
            }else{
            $("#tbody-movimientos").append('<tr><td colspan="5" class"text-center">Sin movimientos<td><tr>');
  
          }
          
            }
  })
   
  
  })



$('.verMovimientos').on('click',function() {

  $('#movimientos').DataTable().destroy()
  console.log('click')
  const iDmovi = $(this).attr('idCuenta');

  const data = new FormData()
  data.append('id',iDmovi)

  $.ajax({
    url:'api/movimiento-vene.api.php',
    method:'POST',
    data:data,
    dataType:'json',
    cache:false,
    contentType:false,
    processData:false,
    success: function (res) {
      // console.log(res.data[0].id)
      $('.modal-title').html(`${res.data[0].nombre} - ${res.data[0].n_titular} ${res.data[0].a_titular}`)


    }
  })
  $('#movimientos').DataTable( {
    "order": [[ 1, "desc" ]],
    "dom": 'Bfrtip',
    "buttons": [
      { extend: 'pdf', className: 'btn-danger' },
      { extend: 'excel', className: 'btn-success' },
      { extend: 'print', className: 'btn-primary'}
    ],
    "ajax": {
      "url": "api/movimiento-vene.api.php",
      "type": "POST",
      "data" : { 'id' : iDmovi },
      "dataSrc": "data"
  },
  "columns":[
    {data:"created_at"},
    {data:"operacion"},
    {data: "signo", render: function(data, type) {
   
      if (data == '-') {
          let color = 'red';

          return '<span style="color:' + color + '">' + 'DEBITO' + '</span>';
      }

      return '<span style="color:green">' + 'CREDITO' + '</span>';

  }},
    {data:"monto"},
    {data:"monto_actual"}
  ],
  "deferRender": true,
  "retrieve": true,
  "processing": true,
   "language": {
  
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  
  }
  
  } );



})