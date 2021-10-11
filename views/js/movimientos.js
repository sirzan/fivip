
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