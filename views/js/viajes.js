// // Numero correlativo

// $(document).ready(function(){
//     var fecha = new Date();
// var ano = fecha.getFullYear();

   

//     $.ajax({
//         url: "api/numeroserie.api.php",
//         method: "POST",
      
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function(respuesta) {
//             // console.log(respuesta)
//             if (respuesta['correlativo'] == undefined) {
//                 $('#nuevaserie').val( ano +' - '+ ('000' + '1').slice(-4))
//                 // console.log(serie)
//             }else{
//                 const serie = parseFloat(respuesta['correlativo'].substr(6,5))  + 1;
               
//                 $('#nuevaserie').val( ano +' - '+ ('000' + serie).slice(-4))

//                 }

//             }
//  })

// })
       





 
$(document).ready(function () {
    $("#paisClienteSalida, #paisClienteDestino").find("option:first").text("---  Pais de salida ---")
    $("#paisClienteDestino").find("option:first").text("---  Pais de Destino ---")
    fetch('api/paises.json')
    .then(response => response.json())
    .then(data => (
     
        Object.entries(data['countries']).forEach(([key, value]) => {
            $("<option/>").attr("value", value.id).text(value.name).appendTo($("#paisClienteSalida"));
            $("<option/>").attr("value", value.id).text(value.name).appendTo($("#paisClienteDestino"));
          })
 
    ));

})


$("#paisClienteSalida").change(function () {
    $("#estadoClienteSalida").find("option:gt(0)").remove();
   
    // $("#estadoClienteSalida").find("option:first").text("---  Estado de salida ---");
    
    fetch('api/estados.json')
    .then(response => response.json())
    .then(data => (
     
        Object.entries(data['states']).forEach(([key, value]) => {
            if ($("#paisClienteSalida").val() == value.id_country) {       
                $("<option/>").attr("value", value.id).text(value.name).appendTo($("#estadoClienteSalida"));
            }
         
          })
 
    ));

});

$("#paisClienteDestino").change(function () {
    $("#estadoClienteDestino").find("option:gt(0)").remove();
    // $("#estadoClienteSalida").find("option:first").text("---  Estado de salida ---");
    
    fetch('api/estados.json')
    .then(response => response.json())
    .then(data => (
     
        Object.entries(data['states']).forEach(([key, value]) => {
        
            if ($("#paisClienteDestino").val() == value.id_country) {       
                $("<option/>").attr("value", value.id).text(value.name).appendTo($("#estadoClienteDestino"));
            }
          })
 
    ));

});

               
               $('#efectivo-viaje').on('click', function(event){
                    event.preventDefault()
                    $('.off-pago-viaje').empty()
                    $('.off-pago-viaje').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Pago en efectvo</h4>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="number" class="form-control" step="any" id="pago-efectivo" name="pago-efectivo" placeholder="ingregar el monto pagado" value="">
                    <input type="hidden" class="form-control" id="metodoPagoViaje" name="metodoPagoViaje" value="efectivo">
                    </div>`)
                  })

                $('#td-viaje').on('click', function(event){
                    event.preventDefault()

                    $('.off-pago-viaje').empty()
     
                    $('.off-pago-viaje').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Deposito</h4>
              
            
                  <div class="form-group row">
                    <div class="input-form col-md-6">
                      <label for="metodoPagoRemeda2">Metodo de Pago</label>
                      <select class="form-control bancoselect" id="metodoPagoRemeda2" name="metodoPagoRemeda2" required>
                                <option value="" selected>-- Seleccionar un Metodo --</option>
                                <option value="transferencia" >Transferencia</option>
                                <option value="deposito" >Deposito</option>
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
                          <input type="number" id="pago-efectivo" name="pago-efectivo" class="form-control" value="">
                          <input type="hidden" class="form-control" id="metodoPagoViaje" name="metodoPagoViaje" value="credito">
                         
                      </div>
                      </div>
                   </div>`)
                  })

                  
                $('#credito-viaje').on('click', function(event ){
                    event.preventDefault()
                    $('.off-pago-viaje').empty()
                    $('.off-pago-viaje').append(`<h4><i class="fas fa-exclamation-circle text-warning"></i> Cuenta crédito</h4>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="number" name="pago-efectivo" class="form-control" value="0" readonly>
                    <input type="hidden" class="form-control" id="metodoPagoViaje" name="metodoPagoViaje" value="credito">
                  </div>
                  `)
                  })

               $('#promotor').on('change', function(){
                   $('.promotor').empty()  
                if( $('#promotor').prop('checked') ) {
                        $('.promotor').append( `<div class="input-group mb-3 col-md-12">
                        <input type="texte" class="form-control" id="nuevoNumeroDocumento" name="nuevoNumeroDocumento" placeholder="Ingrese el nombre del promotor" >
                        </div>`)
                }
              })