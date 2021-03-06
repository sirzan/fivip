
  

$(document).ready(function(){
  const info = $('#info').val();
  // console.log(info)
  const data = new FormData();
  data.append('info',info)

    $.ajax({
        url: "api/movimientosall.api.php",
        method: "POST",
        data:data,
        async:true,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
          if (respuesta.legth != 0) {
            
            $.each(respuesta, function(i, item) {
              
              $("#tbody-movimientos").append(`
              <tr>
              <td> ${(respuesta[i]['banco'] == null) ? respuesta[i]['banco_inter'] : respuesta[i]['banco']}</td>
              <td>${(respuesta[i]['n_titular'] == null) ? respuesta[i]['n_titular_inter'] : respuesta[i]['n_titular']} ${(respuesta[i]['a_titular'] == null) ? respuesta[i]['a_titular_inter'] : respuesta[i]['a_titular']}</td>
              <td>${(respuesta[i]['monto']) == null ? respuesta[i]['monto_inter'] :respuesta[i]['monto']}</td>
              <td>${(respuesta[i]['monto_actual']) == null ? ((respuesta[i]['signo'] == '+') ? '<span class="text-success">'+respuesta[i]['monto_actual_inter']+'</span>' :'<span class="text-danger"> -'+respuesta[i]['monto_actual_inter']+'</span>') : (respuesta[i]['signo'] == '+') ? '<span class="text-success">'+respuesta[i]['monto_actual']+'</span>': '<span class="text-danger"> -'+respuesta[i]['monto_actual']+'</span>'}</td>
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

    $.ajax({
        url: "api/movimientosefectivo.api.php",
        method: "POST",
        data:data,
        async:true,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          
          if (res.legth != 0) {
            
            $.each(res, function(i, item) {
              
              $("#tbody-efectivo").append(`
              <tr>
              <td> ${res[i]['correlativo']}</td>
              <td>${res[i]['metodo_p']}</td>
              <td>${res[i]['simbolo_moneda']} ${Math.round10(res[i]['monto'],-3)} (${res[i]['iso_moneda']})</td>
              <td>${(res[i]['signo'] == '+') ? '<i class="fas fa-arrow-alt-circle-up text-success"></i>': '<i class="fas fa-arrow-alt-circle-down text-danger"></i>'}</td>
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
  const info = $(this).attr('info');
  
  const data = new FormData()
  data.append('id',iDmovi)
  data.append('info',info)

  $.ajax({
    url:'api/movimiento-vene.api.php',
    method:'POST',
    data:data,
    dataType:'json',
    cache:false,
    contentType:false,
    processData:false,
    success: function (res) {
   
      $('.modal-title').html(`${res.data[0].nombre} - ${res.data[0].n_titular} ${res.data[0].a_titular}`)


    }
  })
  $('#movimientos').DataTable( {
 
    "order": [[ 0, "desc" ]],
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "dom": 'Bfrtip',
    "buttons": [
      { extend: 'pdf', className: 'btn-danger' },
      { extend: 'excel', className: 'btn-success' },
      { extend: 'print', className: 'btn-primary'}
    ],
    "ajax": {
      "url": "api/movimiento-vene.api.php",
      "async":true,
      "type": "POST",
      "data" : { 'id' : iDmovi,'info': info},
      "dataSrc": "data"
  },
  "columns":[
    {data:"created_at" },
    {data:"operacion"},
    {data: "signo", render: function(data, type) {
   
      if (data == '-') {
          let color = 'red';

          return '<span style="color:' + color + '">' + 'DEBITO' + '</span>';
      }

      return '<span style="color:green">' + 'CREDITO' + '</span>';

  }},
    {data:"monto", render: function(data,type){

          return trunc(data,2)
    }},
    {data:"monto_actual", render: function(data,type){

      return trunc(data,2)
}}
  ],
  "deferRender": true,
  "retrieve": true,
  "processing": true,
   "language": {
  
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ning??n dato disponible en esta tabla",
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
      "sLast":     "??ltimo",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colecci??n",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  
  }
  
  });
 


})