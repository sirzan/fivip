
//pagar deuda
$(document).on("click",".btnPagar",function() {
    $('.saldo').remove()
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
          
            $('#saldo').append('  <h2 class="saldo" style="font-size: 45px;" id="saldo">'+respuesta['simbolo_moneda']+' '+respuesta['total_envio']+' ('+respuesta['iso_moneda']+')</h2>')
            $('#idPagoRemesa').val(respuesta['id']);
      
      

            $("#MetodoPago").on('change', function () {
              $('.efectivo').remove()
              $('.deposito').remove()
              $('#bancoTrans').remove()
                 
                  const metodoPago = $("#MetodoPago").val()
       
               if (metodoPago == 'Efectivo') {
               
                   $(".pagometodo").after('<div class="input-group mb-3 col-md-4 efectivo"><span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                   '<input type="number" class="form-control input-lg" id="pagoefectivo" name="pagoefectivo" step="any" readonly required> </div>');
                      
        
             
                        $('#pagoefectivo').val(respuesta['total_envio'])
               }else if(metodoPago == 'Desposito' || metodoPago == 'Transferencia'){
               
                
                  $(".pagometodo").after(`<div class="input-group mb-3 col-md-3 "><select class="form-control" id="bancoTrans" name="bancoTrans" required></div>`)
                  $.ajax({
                    url: "api/bancoall.api.php",
                    method: "POST",
                  
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta2) {
                           
                    
              
                           $.each(respuesta2, function(i, item) {
                            $('#bancoTrans').append( '<option value="' + respuesta2[i]['nombre'] + '">' + respuesta2[i]['nombre'] + '</option>');
                        });
                      
              
                    }
                   }) 
                
                $(".pagometodo").after('<div class="input-group mb-3 col-md-3 efectivo"><input type="number" class="form-control input-lg" step="any" id="pagoefectivo2" name="pagoefectivo" readonly required> </div>');
                $(".pagometodo").after(
                  '<div class="input-group mb-3 col-md-3 deposito"><span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
              '<input type="number" class="form-control input-lg" id="numero_deposito" name="numero_deposito"  placeholder="N° de transacción"  required></div>');
       
                $('#pagoefectivo2').val(respuesta['total_envio'])
               }
                  
             });
          }
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


 $(".tablas").on("click", ".btnverPago", function(){
    console.log('diste click')
	var idPagos = $(this).attr("idPagos");

  window.open("index.php?ruta=invoice&id="+idPagos, "_blank");

})
