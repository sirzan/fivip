////////////////////////////////////////////////////////////////////
///////////////////  cuenta de bancos venezuela  ///////////////////
////////////////////////////////////////////////////////////////////


//Recargar cuenta

$(document).on("click",".recargarCuenta",function() {

    $('.infocuenta').empty();
    $('#camposocultos').empty();
    
    $('.modal-title').html('<i class="fas fa-arrow-alt-circle-up text-success"></i>  Recargar Saldo')
    $('.btnModal').html('Cargar Saldo')
    var idCuenta = $(this).attr('idCuenta');
    var info = $(this).attr('info');
   
    var datos = new FormData();
    datos.append("idCuenta", idCuenta);
    datos.append("info", info);
    
    $.ajax({
        url: "api/recargar-cuenta.api.php",
        method: "POST",
        data: datos,
        async:true,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
       
            var locality = 'es-ES';
          $('.infocuenta').append(`<span class="info-box-icon bg-primary"><i class="fas fa-university"></i></span>     
          <div class="info-box-content">
         
            <span class="info-box-text"> <strong> ${respuesta['nombre']}</strong></span>
            <span class="info-box-text">${respuesta['n_titular']} ${respuesta['a_titular']}</span>
            <span class="info-box-number"><h3>${respuesta['simbolo']} ${parseFloat(respuesta['saldo']).toLocaleString(locality , { 
                minimumFractionDigits: 2 })}</h3></span>
          </div>
          `)
          $('#camposocultos').append(`<input type="hidden" id="idSaldo" name="idSaldo"><input type="hidden" id="idcuentaActualRecarga" name="idcuentaActualRecarga">
          <input type="hidden" id="operacionRecarga" name="operacion" value="recarga">
          <input type="hidden" id="simboloRecarga" name="simboloRecarga">`)

          $('#saldoActual').val(parseFloat(respuesta['saldo']))
          $('#idSaldo').val(respuesta['id_saldo'])
          $('#idcuentaActualRecarga').val(respuesta['id_cuenta'])
          $('#simboloRecarga').val(respuesta['simbolo'])
        },
        error: function(error) {
          alert('Error al llamar el api'+error);
        }
    })
 
})

//Descargar cuenta

$(document).on("click",".descargarCuenta",function() {
    $('.infocuenta').empty();
    $('#camposocultos').empty();
    $('.modal-title').html('<i class="fas fa-arrow-alt-circle-down text-danger"></i>  Descargar Saldo')
    $('.btnModal').html('Descargar Saldo')
    var idCuenta = $(this).attr('idCuenta');
    var info = $(this).attr('info');
    var datos = new FormData();
    datos.append("info", info);
    datos.append("idCuenta", idCuenta);

    $.ajax({
        url: "api/recargar-cuenta.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            var locality = 'es-ES';
          $('.infocuenta').append(`<span class="info-box-icon bg-primary"><i class="fas fa-university"></i></span>     
          <div class="info-box-content">
         
            <span class="info-box-text"> <strong> ${respuesta['nombre']}</strong></span>
            <span class="info-box-text">${respuesta['n_titular']} ${respuesta['a_titular']}</span>
            <span class="info-box-number"><h3>${respuesta['simbolo']} ${parseFloat(respuesta['saldo']).toLocaleString(locality , { 
                minimumFractionDigits: 2 })}</h3></span>
          </div>
          `)
          $('#camposocultos').append(`<input type="hidden" id="idSaldo" name="idSaldo"><input type="hidden" id="idcuentaActualDescarga" name="idcuentaActualDescarga">
          <input type="hidden" id="operacionDescarga" name="operacion" value="descargar">
          <input type="hidden" id="simboloRecarga" name="simboloRecarga">`)

          $('#saldoActual').val(parseFloat(respuesta['saldo']))
          $('#idcuentaActualDescarga').val(respuesta['id_cuenta'])
          $('#idSaldo').val(respuesta['id_saldo'])
          $('#simboloRecarga').val(respuesta['simbolo'])
        },
        error: function() {
          alert('Error al llamar el api');
        }
    })
 
})


//Transferir Cuenta

$(document).on("click",".TransferirSaldo",function() {
  $('#codigobanco').remove();
  $('#codigobanco2').remove(); 
    $('.infocuenta').empty();
    $('#camposocultos').empty();
    $('.modal-title').html('<i class="fas fa-exchange-alt text-warning"></i> Tranferir Saldo')
    $('.btnModal').html('Transferir')
  
    var idCuenta = $(this).attr('idCuenta');
    var info = $(this).attr('info');
    
    var datos = new FormData();
    datos.append("idCuenta", idCuenta);
    datos.append("info", info);
    $.ajax({
        url: "api/recargar-cuenta.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $('#cuentasBancarias option').each(function() {
                if ( $(this).val() == respuesta['id_cuenta'] ) {
                    $(this).css('display','none');
                }else{
                    $(this).css('display','');
                }
            });
          
            // $('option[value='+respuesta['id_cuenta']+']').remove()
            var locality = 'es-ES';
          $('.infocuenta').append(`<span class="info-box-icon bg-primary"><i class="fas fa-university"></i></span>     
          <div class="info-box-content">
         
            <span class="info-box-text"> <strong> ${respuesta['nombre']}</strong></span>
            <span class="info-box-text">${respuesta['n_titular']} ${respuesta['a_titular']}</span>
            <span class="info-box-number"><h3>${respuesta['simbolo']} ${parseFloat(respuesta['saldo']).toLocaleString(locality , { 
                minimumFractionDigits: 2 })}</h3></span>
          </div>
          `)
          $('#camposocultos2').append(`<input type="hidden" id="idSaldo" name="idSaldo"><input type="hidden" id="idCuentaactual" name="idCuentaactual">
          <input type="hidden" id="operacionDescarga" name="operacion" value="Transferencia">
          <input type="hidden" id="simboloRecarga" name="simboloRecarga"><input type="hidden" id="codigobanco" name="codigobanco"><input type="hidden" id="codigobanco2" name="codigobanco2">`)

          $('#saldoActual2').val(parseFloat(respuesta['saldo']))
          $('#idCuentaactual').val(parseFloat(respuesta['id_cuenta']))
          $('#idSaldo').val(respuesta['id_saldo'])
          $('#simboloRecarga').val(respuesta['simbolo'])
          $('#codigobanco').val(respuesta['codigo'])

          $("#cuentasBancarias").on('change', function () {

            var idCuenta = $("#cuentasBancarias").val();
       
            
      
            var datos = new FormData();
            datos.append("idCuenta", idCuenta);
        
            $.ajax({
                url: "api/recargar-cuenta.api.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
            
                  $('#codigobanco2').val(respuesta['codigo'])
                 
                }
            })
      
           
       });

      
        },
        error: function() {
          alert('Error al llamar al api');
        }
    })
 
})

// //combo box


$(document).ready(function(){
  $("#cuentasBancarias").on('change', function () {

      var idCuenta = $("#cuentasBancarias").val();
      var info = $(".TransferirSaldo").attr('info');
 
      

      var datos = new FormData();
      datos.append("idCuenta", idCuenta);
      datos.append("info", info);
  
      $.ajax({
          url: "api/recargar-cuenta.api.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(respuesta) {
      
            $("#cuentasBancarias").after('<input type="hidden" id="cuentasBancariasId" name="cuentasBancariasId">')
            $("#cuentasBancarias").after('<input type="hidden" id="cuentaId" name="cuentaId">')
            $("#cuentasBancarias").after('<input type="hidden" step="any" id="saldoCuentaTransferir" name="saldoCuentaTransferir">')
            $("#cuentasBancarias").after('<input type="hidden" id="operacion2" name="operacion2" value="Cargo por Transferencia">')
            $("#saldoCuentaTransferir").val(respuesta['saldo'])
            $("#cuentasBancariasId").val(respuesta['id_saldo'])
            $("#cuentaId").val(respuesta['id_cuenta'])
           
          }
      })

     
 });
})


// ////////////////////////////////////////////////////////////////////
// ////////////////  cuenta de bancos internacionales  ////////////////
// ////////////////////////////////////////////////////////////////////



// //Recargar cuenta

$(document).on("click",".recargarCuentaInter",function() {
  $('.infocuenta').empty();
  $('#camposocultos').empty();
  
  $('.modal-title').html('<i class="fas fa-arrow-alt-circle-up text-success"></i>  Recargar Saldo')
  $('.btnModal').html('Cargar Saldo')
  var idCuenta = $(this).attr('idCuenta');
  var info = $(this).attr('info');
  
  var datos = new FormData();
  datos.append("idCuenta", idCuenta);
  datos.append("info", info);
  
  $.ajax({
      url: "api/recargar-cuenta-inter.api.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
     
          var locality = 'es-ES';
        $('.infocuenta').append(`<span class="info-box-icon bg-danger"><i class="fas fa-university"></i></span>     
        <div class="info-box-content">
       
          <span class="info-box-text"> <strong> ${respuesta['nombre']}</strong></span>
          <span class="info-box-text">${respuesta['n_titular_inter']} ${respuesta['a_titular_inter']}</span>
          <span class="info-box-number"><h3>${respuesta['simbolo']} ${parseFloat(respuesta['saldo_inter']).toLocaleString(locality , {minimumFractionDigits: 2 })}</h3></span>
        </div>
        `)
        $('#camposocultos').append(`<input type="hidden" id="idSaldo" name="idSaldo">
        <input type="hidden" id="idcuentaActualRecarga" name="idcuentaActualRecarga">
        <input type="hidden" id="operacionRecarga" name="operacion" value="recarga">
        <input type="hidden" id="simboloRecarga" name="simboloRecarga">`)

        $('#saldoActual').val(parseFloat(respuesta['saldo_inter']))
        $('#idSaldo').val(respuesta['id_saldo'])
        $('#idcuentaActualRecarga').val(respuesta['cuenta_inter_id'])
        $('#simboloRecarga').val(respuesta['simbolo'])
      },
      error: function() {
        alert('Error al llamar el api');
      }
  })

})





// //Descargar cuenta

$(document).on("click",".descargarCuentaInter",function() {
  $('.infocuenta').empty();
  $('#camposocultos').empty();
  $('.modal-title').html('<i class="fas fa-arrow-alt-circle-down text-danger"></i>  Descargar Saldo')
  $('.btnModal').html('Descargar Saldo')
  var idCuenta = $(this).attr('idCuenta');
  var info = $(this).attr('info');

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);
  datos.append("info", info);
  
  $.ajax({
      url: "api/recargar-cuenta-inter.api.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
          var locality = 'es-ES';
        $('.infocuenta').append(`<span class="info-box-icon bg-primary"><i class="fas fa-university"></i></span>     
        <div class="info-box-content">
       
          <span class="info-box-text"> <strong> ${respuesta['nombre']}</strong></span>
          <span class="info-box-text">${respuesta['n_titular_inter']} ${respuesta['a_titular_inter']}</span>
          <span class="info-box-number"><h3>${respuesta['simbolo']} ${parseFloat(respuesta['saldo_inter']).toLocaleString(locality , { 
              minimumFractionDigits: 2 })}</h3></span>
        </div>
        `)
        $('#camposocultos').append(`<input type="hidden" id="idSaldo" name="idSaldo"><input type="hidden" id="idcuentaActualDescarga" name="idcuentaActualDescarga">
        <input type="hidden" id="operacionDescarga" name="operacion" value="descargar">
        <input type="hidden" id="simboloRecarga" name="simboloRecarga">`)

        $('#saldoActual').val(parseFloat(respuesta['saldo_inter']))
        $('#idcuentaActualDescarga').val(respuesta['cuenta_inter_id'])
        $('#idSaldo').val(respuesta['id_saldo'])
        $('#simboloRecarga').val(respuesta['simbolo'])
      },
      error: function() {
        alert('Error al llamar el api');
      }
  })

})





// ////////////////////////////////////////////////////////
// /////////          Eliminar Cuenta      ///////////////
// ///////////////////////////////////////////////////////


$(document).on("click",".eliminarCuenta",function(){

  var idCuentaSaldo = $(this).attr("idCuentaSaldo");
  var idCuenta = $(this).attr("idCuenta");
  var estado = $(this).attr("estado");
  var info = $(this).attr("info");
  swal({
      title:'¿Estas seguro de borrar la cuenta?',
      text:'¡Si no estas seguro puedes cancelar la acción!',
      type:'warning',
      showCancelButton:true,
      confirmButtonColor:'#3085d6',
      cancelButtonColor:'#d33',
      cancelButtonText:'Cancelar',
      confirmButtonText:'¡Si, borrar la cuenta!',
  }).then((result)=>{
      if(result.value){
          window.location = "index.php?ruta=banco-cuentas-venezuela&idCuentaSaldo="+idCuentaSaldo+"&idCuenta="+idCuenta+"&estado="+estado+"&info="+info;
      }
  })
})
$(document).on("click",".eliminarCuentaInter",function(){

  var idCuentaSaldo = $(this).attr("idCuentaSaldo");
  var idCuenta = $(this).attr("idCuenta");
  var estado = $(this).attr("estado");
  var info = $(this).attr("info");
  swal({
      title:'¿Estas seguro de borrar la cuenta?',
      text:'¡Si no estas seguro puedes cancelar la acción!',
      type:'warning',
      showCancelButton:true,
      confirmButtonColor:'#3085d6',
      cancelButtonColor:'#d33',
      cancelButtonText:'Cancelar',
      confirmButtonText:'¡Si, borrar la cuenta!',
  }).then((result)=>{
      if(result.value){
          window.location = "index.php?ruta=banco-cuentas-inter&idCuentaSaldo="+idCuentaSaldo+"&idCuenta="+idCuenta+"&estado="+estado+"&info="+info;
      }
  })
})
