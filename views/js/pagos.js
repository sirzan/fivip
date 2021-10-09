
//pagar deuda
$(document).on("click",".btnPagar",function() {
    $('.saldo').remove()
    $('#numero-remesa').empty()
    $('.datos').empty()
    var idPagos = $(this).attr('idPagos');

    var datos = new FormData();
    datos.append("idPagos", idPagos);

    $.ajax({
        url: "api/pagos.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
     
          var locality = 'es-ES';
            $('#saldo').append('  <h2 class="saldo" style="font-size: 27px;" id="saldo">'+respuesta['simbolo_moneda']+' '+parseFloat(respuesta['total_envio']).toLocaleString(locality , {minimumFractionDigits: 2 })+' ('+respuesta['iso_moneda']+')</h2>')
            $('#transferir').append('  <h2 class="saldo" style="font-size: 27px;" id="saldo">'+respuesta['simbolo_tasa']+' '+parseFloat(respuesta['total_remesa']).toLocaleString(locality , {minimumFractionDigits: 2 })+' ('+respuesta['iso_tasa']+')</h2>')
            $('#cliente').append('  <h2 class="saldo" style="font-size: 35px;" id="saldo">'+respuesta['cliente']+'</h2>')
            $('#numero-remesa').html(respuesta['correlativo'])
            $('#idPagoRemesa').val(respuesta['id']);
            $('#titular-receptor').html(respuesta['receptor']);
            $('#titular-documento').html(respuesta['tipo_doc']);
            $('#numero-documento').html(respuesta['n_doc']);
            $('#banco-receptor').html(respuesta['banco'] + (respuesta['ban_pa_m'] ?" - "+respuesta['ban_pa_m'] : '') );
            $('#cuenta-receptor').append(respuesta['n_cuenta']);
            $('#monto-transferencia').val(respuesta['total_remesa']);
            $('#id_remesa').val(respuesta['id']);

            if (respuesta['iso_tasa'] == "VEN") {
              $('#tipo_cuenta_salida').val('vene');
            }else{
              $('#tipo_cuenta_salida').val('inter');
            }

            ////////////////////////////////////////////////////////////
            ///////////   Tipos de bancos para transferir      /////////
            ////////////////////////////////////////////////////////////

            $.ajax({
              url: "api/cuentasall.api.php",
              method: "POST",
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function(res) {
              
                        $('#seleccionarBancoTransfer').empty()
                        $('#metodoPagoTransfer').empty()
                      $.each(res, function(i, item) {

                        if(respuesta['iso_tasa'] ==res[i]['iso']){
                          $('#seleccionarBancoTransfer').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                        }

                    });
                      
                    if(respuesta['iso_tasa'] == "VEN" ){
                        $('#metodoPagoTransfer').append( '<option value="transferencia">Transferencia</option>');
                        $('#metodoPagoTransfer').append( '<option value="transferencia digital">Transferencia Digital</option>');
                        $('#metodoPagoTransfer').append( '<option value="pago movil">Pago Movil</option>');
                      }else{
                        $('#metodoPagoTransfer').append( '<option value="transferecia">Transferencia</option>');
                        $('#metodoPagoTransfer').append( '<option value="deposito">Deposito</option>');

                      }
        
                  }
        })
      




            ////////////////////////////////////////////////////////////
            ///////////        tipos de pagos recibidos        /////////
            ////////////////////////////////////////////////////////////

                    // Pago en condicion de efectivo

                        $('#m-efectivo').on('click', function(){
                          $('.off').empty()
                          $('.off').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Pago en efectvo</h4>
                          <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                          </div>
                          <input type="number" class="form-control" step="any" id="pago-efectivo" name="pago-efectivo" placeholder="ingregar el monto pagado" value="${respuesta['total_envio']}">
                          <input type="hidden" class="form-control" id="metodoPagoRemeda2" name="metodoPagoRemeda2" value="efectivo">
                          </div>`)
                                 })

                    // Pago en condicion de creditos

                  $('#m-cred').on('click', function(){
                    $('.off').empty()
                    $('.off').append(`<h4><i class="fas fa-exclamation-circle text-warning"></i> Cuenta crédito</h4>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="number" name="pago-efectivo" class="form-control" value="0" readonly>
                    <input type="hidden" class="form-control" id="metodoPagoRemeda2" name="metodoPagoRemeda2" value="credito">
                  </div>
                  `)
                  })
        

        
            $('#m-dt').on('click', function(){


              $.ajax({
                url: "api/cuentasall.api.php",
                method: "POST",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
            
                  $('.off').empty()
                 
                  $('.off').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Deposito</h4>
            
            
                  <div class="form-group">
                      <label for="exampleInputEmail1">Bancos</label>
                      <select class="form-control bancoselect" id="seleccionarBancoInter2" name="seleccionarBancoInter2" required>
                              <option value="" selected>-- Seleccionar un banco --</option>
                      </select>
                </div>
          
                <div class="form-group row">
                  <div class="input-form col-md-6">
                    <label for="metodoPagoRemeda2">Metodo de Pago</label>
                    <select class="form-control bancoselect" id="metodoPagoRemeda2" name="metodoPagoRemeda2" required>
                              <option value="" selected>-- Seleccionar un Metodo --</option>
                          </select>
                  </div>

                  <div class="form-group col-md-6">

                    <label for="exampleInputEmail1">N° de Trans. o Dep.</label>
                    <div class="input-group ">
                       <input type="number" id="n-op-salida" name="n-op-salida" class="form-control">
                </div>
                  </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Monto a Transferir</label>
                      <div class="input-group ">
                        <input type="number" id="pago-efectivo" name="pago-efectivo" class="form-control" value="${respuesta['total_envio']}">
                        <input type="text" id="tipo_cuenta_entrada" name="tipo_cuenta_entrada" class="form-control">
                        <input type="text" id="id_cuenta_entrada" name="id_cuenta_entrada" class="form-control">
                       
                    </div>
                    </div>
                 </div>`)
               
                  $.each(res, function(i, item) {

                    if(respuesta['iso_moneda'] ==res[i]['iso']){
                 
                      $('#seleccionarBancoInter2').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                    }

                    

                  });
                   
                    if (respuesta['iso_moneda'] == 'VEN') {
                      $('#tipo_cuenta_entrada').val('vene');
                    }else{
                      $('#tipo_cuenta_entrada').val('inter');
                    }

                    if(respuesta['iso_moneda'] == res['iso']){
                      $('#metodoPagoRemeda2').append( '<option value="tn">Transferencia</option>');
                      $('#metodoPagoRemeda2').append( '<option value="td">Transferencia Digital</option>');
                      $('#metodoPagoRemeda2').append( '<option value="pm">Pago Movil</option>');
                    }else{
                      $('#metodoPagoRemeda2').append( '<option value="transferencia">Transferencia</option>');
                      $('#metodoPagoRemeda2').append( '<option value="deposito">Deposito</option>');
                    }

                    $('#seleccionarBancoInter2').on('change', function(){
                      console.log($('#seleccionarBancoInter2').val())
                    })

          
                    }
          })
        
                      
        
            })
            ////////////////////////////////////////////////////////////
            ///////////     tipos de pagos recibidos  end      /////////
            ////////////////////////////////////////////////////////////

          }
           ////////////////////////////////////////////////////////////
                                    // end //
           ////////////////////////////////////////////////////////////
    })

})

//pago notificacion


$(document).ready(function(){

  $.ajax({
      url: "api/pagosnoti.api.php",
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
          $('.notipago').after('<span class="right badge badge-danger notipago">'+respuesta[0]['pagos']+'</span>')

          }
})

})

//creditos notificacion
$(document).ready(function(){

  $.ajax({
      url: "api/credinoti.api.php",
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
          $('.noticredi').after('<span class="right badge badge-danger noticredi">'+respuesta[0]['creditos']+'</span>')

          }
})

})


 $(".tablas").on("click", ".btnverPago", function(){

	var idPagos = $(this).attr("idPagos");

  window.open("index.php?ruta=invoice&id="+idPagos, "_blank");

})


//pagar deuda
$(document).on("click",".btnCreditos",function() {
  $('.saldo').remove()
  $('#numero-remesa').empty()
  var idPagos = $(this).attr('idPagos');

  var datos = new FormData();

  datos.append("idPagos", idPagos);

          $.ajax({
            url: "api/creditos.api.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
          
            var locality = 'es-ES';
            $('#saldo').append('  <h2 class="saldo" style="font-size: 27px;" id="saldo">'+respuesta['simbolo_moneda']+' '+parseFloat(respuesta['total_envio']).toLocaleString(locality , {minimumFractionDigits: 2 })+' ('+respuesta['iso_moneda']+')</h2>')
            $('#cliente').append('  <h2 class="saldo" style="font-size: 35px;" id="saldo">'+respuesta['nombres']+' '+respuesta['apellidos']+'</h2>')
            $('#numero-remesa').html(respuesta['correlativo'])
            $('#remesas_id').val(respuesta['remesas_id']);

                    $.ajax({
                      url: "api/cuentasall.api.php",
                      method: "POST",
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType: "json",
                      success: function(res) {
                      
                                $('#seleccionarBancoTransfer').empty()
                                $('#metodoPagoTransfer').empty()
                              $.each(res, function(i, item) {

                                if(respuesta['iso_moneda'] ==res[i]['iso']){
                                  $('#seleccionarBancoTransfer').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                                }

                            });
                              
                            if(respuesta['iso_tasa'] == "VEN" ){
                                $('#metodoPagoTransfer').append( '<option value="transferencia">Transferencia</option>');
                                $('#metodoPagoTransfer').append( '<option value="transferencia digital">Transferencia Digital</option>');
                                $('#metodoPagoTransfer').append( '<option value="pago movil">Pago Movil</option>');
                              }else{
                                $('#metodoPagoTransfer').append( '<option value="transferecia">Transferencia</option>');
                                $('#metodoPagoTransfer').append( '<option value="deposito">Deposito</option>');

                              }
                
                          }
                })




                
            ////////////////////////////////////////////////////////////
            ///////////        tipos de pagos recibidos        /////////
            ////////////////////////////////////////////////////////////

                    // Pago en condicion de efectivo

                    $('#m-efectivo').on('click', function(){
                      $('.off').empty()
                      $('.off').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Pago en efectvo</h4>
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                      </div>
                      <input type="number" class="form-control" id="pago-efectivo" name="pago-efectivo" placeholder="ingregar el monto pagado" value="${respuesta['total_envio']}">
                      <input type="hidden" class="form-control" id="metodoPagoRemeda2" name="metodoPagoRemeda2" value="efectivo">
                      </div>`)
                             })


                             $('#m-dt').on('click', function(){


                              $.ajax({
                                url: "api/cuentasall.api.php",
                                method: "POST",
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function(res) {
                            
                                  $('.off').empty()
                                 
                                  $('.off').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Deposito</h4>
                            
                            
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Bancos</label>
                                      <select class="form-control bancoselect" id="seleccionarBancoInter2" name="seleccionarBancoInter2" required>
                                              <option value="" selected>-- Seleccionar un banco --</option>
                                      </select>
                                </div>
                          
                                <div class="form-group row">
                                  <div class="input-form col-md-6">
                                    <label for="metodoPagoRemeda2">Metodo de Pago</label>
                                    <select class="form-control bancoselect" id="metodoPagoRemeda2" name="metodoPagoRemeda2" required>
                                              <option value="" selected>-- Seleccionar un Metodo --</option>
                                          </select>
                                  </div>
                
                                  <div class="form-group col-md-6">
                
                                    <label for="exampleInputEmail1">N° de Trans. o Dep.</label>
                                    <div class="input-group ">
                                       <input type="number" id="n-op-salida" name="n-op-entrada" class="form-control">
                                </div>
                                  </div>
                                    <div class="form-group col-md-6">
                                      <label for="exampleInputEmail1">Monto a Transferir</label>
                                      <div class="input-group ">
                                        <input type="number" id="pago-efectivo" name="pago-efectivo" class="form-control" value="${respuesta['total_envio']}">
                                        <input type="hidden" id="tipo_cuenta_entrada" name="tipo_cuenta_entrada" class="form-control">
                                        <input type="hidden" id="id_cuenta_entrada" name="id_cuenta_entrada" class="form-control">
                                       
                                    </div>
                                    </div>
                                 </div>`)
                
                                  $.each(res, function(i, item) {
                
                                    if(respuesta['iso_moneda'] ==res[i]['iso']){
                
                                      $('#seleccionarBancoInter2').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                                    }
                
                                    
                
                                  });
                
                                    if (respuesta['iso_moneda'] == res['iso']) {
                                      $('#tipo_cuenta_entrada').val('vene');
                                    }else{
                                      $('#tipo_cuenta_entrada').val('inter');
                                    }
                
                                    if(respuesta['iso_moneda'] == res['iso']){
                                      $('#metodoPagoRemeda2').append( '<option value="tn">Transferencia</option>');
                                      $('#metodoPagoRemeda2').append( '<option value="td">Transferencia Digital</option>');
                                      $('#metodoPagoRemeda2').append( '<option value="pm">Pago Movil</option>');
                                    }else{
                                      $('#metodoPagoRemeda2').append( '<option value="transferencia">Transferencia</option>');
                                      $('#metodoPagoRemeda2').append( '<option value="deposito">Deposito</option>');
                                    }
                
                                    $('#seleccionarBancoInter2').on('change', function(){
                                      console.log($('#seleccionarBancoInter2').val())
                                    })
                
                          
                                    }
                          })
                        
                                      
                        
                            })


            }
        })

})


