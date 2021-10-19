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
       
// Numero correlativo

$(document).ready(function(){
    var fecha = new Date();
var ano = fecha.getFullYear();

   

    $.ajax({
        url: "api/numeroserie.api.php",
        method: "POST",
      
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta)
            if (respuesta['correlativo'] == undefined) {
                $('#nuevaserieViaje').val( 'V - '+ano +' - '+ ('000' + '1').slice(-4))
                // console.log(serie)
            }else{
                const serie = parseFloat(respuesta['correlativo'].substr(6,5))  + 1;
               
                $('#nuevaserieViaje').val( 'V - '+ano +' - '+ ('000' + serie).slice(-4))

                }

            }
 })

})




 
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

           

               $('#promotor').on('change', function(){
                   $('.promotor').empty()  
                if( $('#promotor').prop('checked') ) {
                        $('.promotor').append( `<div class="input-group mb-3 col-md-12">
                        <input type="texte" class="form-control" id="promotorName" name="promotorName" placeholder="Ingrese el nombre del promotor" >
                        </div>`)
                }
              })


                                    
$(document).ready(function(){
  ///////////////////////////////
     //   cuenta que transfiere   //
     //////////////////////////////

     $.ajax({
       url:'api/cuentasall.api.php',
       method:'POST',
       dataType:'json',
       async:true,
       cache:false,
       contentType:false,
       processData:false,
       success: function (res) {

                    ///////////////////////////////
                   // metodo de pago en credito//
                   //////////////////////////////


                    ///////////////////////////////
                   // metodo de pago en credito end//
                   //////////////////////////////

                   $(document).off('click','#m-credP').on('click','#m-credP',function(){
                      
                       $('.off-meto').remove()
                       $('.contenedor-texto').empty()
                       $('.contenedor-texto').append(`<h5><i class="fas fa-exclamation-circle text-warning"></i> Cuenta crédito</h5>`)
                       

                           $('.off-deposito-pago').append(`
                           <div class="form-group row cont-credi off-meto">
                           <div class="col-md-3">
                           <label for="exampleInputEmail1">Monto en efectivo</label>
                           <div class="input-group mb-3">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                           </div>
                           <input type="number" class="form-control monto" step="any"  name="monto" placeholder="ingregar el monto pagado" value="0" readonly>
                           <input type="hidden" class="form-control BancoDeposito" name="BancoDeposito" value="null">
                           <input type="hidden" class="form-control metodoPago" name="metodoPago" value="Credito">
                           <input type="hidden" class="form-control nOperacion" name="nOperacion" value="null">
                           <input type="hidden"  name="id_remesa" class="id_remesa" value="">
                           <input type="hidden"  name="tipoBanco" class="tipoBanco" value="null">
                           </div>
                           </div>
                       </div>
                           `)    
                          
                   })  


                   ///////////////////////////////
                   // metodo de pago en efectivo//
                   //////////////////////////////
                   $(document).off('click','#m-efectivoP').on('click','#m-efectivoP',function(){
                      
                       $('.cont-credi').remove()
                       $('.contenedor-texto').empty()
                       $('.contenedor-texto').append(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
                       const claseEfec = $('.cont-efec')
                       if (claseEfec.length <= 0) {
                           $('.off-deposito-pago').append(`
                           <div class="form-group row cont-efec off-meto" style="border-bottom:1px solid #C1C1C1">
                           <div class="m-3">
                           <a href="" class="btn btn-danger btn-lg eliminarCuentaEfectivo"><i class="fas fa-trash-alt"></i></a>
                           </div>
                           
                           <div class="col-md-3">
                           <label for="exampleInputEmail1">Monto en efectivo</label>
                           <div class="input-group mb-3">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                           </div>
                           <input type="number" class="form-control monto" step="any"  name="monto" placeholder="ingregar el monto pagado" >
                           <input type="hidden" class="form-control BancoDeposito" name="BancoDeposito" value="null">
                           <input type="hidden" class="form-control metodoPago" name="metodoPago" value="Efectivo">
                           <input type="hidden" class="form-control nOperacion" name="nOperacion" value="null">
                           <input type="hidden"  name="id_remesa" class="id_remesa" value="">
                           <input type="hidden"  name="tipoBanco" class="tipoBanco" value="null">
                           </div>
                           </div>
                           </div>
                         
                           `)    
                       }else{
                     
                           toastr.warning('Solo se puedes agregar un metodo en efectivo')
                          
                       }
               
                           $('.eliminarCuentaEfectivo').on('click',function(e){
                               
                               e.preventDefault()
                             $(this).parent().parent().remove()
                               })
                               $('#form-pago').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                                   const monto =parseFloat(sumarTotalMonto()) 
                                   const saldo = Number.parseFloat(respuesta.total_envio)
                               
                                 
                                      if (monto > saldo) {
                                           toastr.error('El monto es incorrecto, supera la cantidad del saldo a cobrar')
                                           $('.monto').val('')
                                       }else{
                                             listarMetodo()
   
                                          }
                               })
                                })     


                   ///////////////////////////////
                   // metodo de pago en efectivo end//
                   //////////////////////////////




                       ///////////////////////////////
                   //   cuenta que deposito   //
                   //////////////////////////////
                               
                   // metodo de pago salido end
               
                   $(document).off('click','#m-dtP').on('click','#m-dtP',function(){

               
               
                       $('.cont-credi').remove()
                       $('.contenedor-texto').empty()
                       $('.contenedor-texto').append(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
                       $('.BancoDeposito').empty()
                       $('.metodoPago').empty()
                     
                       $('.off-deposito-pago').append(`
                       <div class="form-group row cont-depo off-meto" style="border-bottom:1px solid #C1C1C1">
                       <div class="m-2 pt-2">
                       <a href="" class="btn btn-danger btn-lg eliminarCuentaDeposito"><i class="fas fa-trash-alt"></i></a>
                       </div>
                       <div class="input-form col-md-4">
                       <label for="exampleInputEmail1">Bancos de transferencia</label>
                       <select class="form-control bancoselect BancoDeposito " name="BancoDeposito" required>
                               
                       </select>
                       </div>
                         <div class="input-form col-md-3">
                       <label for="exampleInputEmail1">Metodo de Pago</label>
                       <select class="form-control metodoPago" name="metodoPago" required>
                           
                       </select>
                       </div>

                       <div class="form-group col-md-2 float-right">
                       <label for="exampleInputEmail1">N° de Trans.</label>
                       <div class="input-group ">
                           <input type="number"  name="nOperacion" class="form-control nOperacion" >
                       </div>
                       </div>
                       <div class="form-group col-md-2 float-right">
                       <label for="exampleInputEmail1">Monto a Transferir</label>
                       <div class="input-group "> <div class="input-group-prepend">
                       <span class="input-group-text tipo-moneda"></span>
                     </div>
                       <input type="number" step="any" name="monto" class="form-control monto" >
                       <input type="hidden" name="id_remesa" class="id_remesa" value="">
                       <input type="hidden" name="tipoBanco" class="tipoBanco" value="">
                       </div>
                       </div>
                       </div>
                       `)
                       $('.BancoDeposito').append(`<option value="" selected>--- seleccionar un banco ---</option>`)
                       $('.metodoPago').append(`<option value="" selected>--- seleccionar un metodo de pago ---</option>`)


                   //  metodo pago pago end //
                    $.each(res,function (i, item) {
                   
                    
                           
                            $('.BancoDeposito').append(`<option value="${res[i].id_cuenta}">${res[i].n_titular} ${res[i].a_titular} - ${res[i].nombre}: ${res[i].simbolo}${res[i].saldo} (${res[i].iso})</option>`)
                        
                    })
                           $('.eliminarCuentaDeposito').on('click',function(e){
                               
                               e.preventDefault()
                             $(this).parent().parent().remove()
                               })

                    $('.metodoPago').append(`<option value="transferecia">Transferencia</option><option value="deposito">Deposito</option>`);

                   $('#formulario-boletos').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                    console.log('cambio') 
                    const bancosSelect=JSON.parse(listarMetodo())
                    
                    
                     const busqueda = bancosSelect.reduce((acc, banco) => {
                         acc[banco.banco] = ++acc[banco.banco] || 0;
                         return acc;
                       }, {});
                       
                       const duplicados = bancosSelect.filter( (banco) => {
                           return busqueda[banco.banco];
                       });

                     
                     if (duplicados.length > 0) {
                         toastr.error('No puede seleccionar la misma cuenta de banco dos veces')
                         $('.BancoDeposito option').each(function () {
                                 this.selected = true;
                                 return false;
                         });
                     }
           
                     
                     const monto = sumarTotalMonto()
               
                    console.log(listarMetodo()) 
                     

                   })


                   })                               
                    //  metodo pago pago end //
                       ///////////////////////////////
                   //   cuenta que deposito  end  //
                   //////////////////////////////

       }
   })
})





$('#formulario-boletos').on('submit', function(e){
  e.preventDefault()
  var fechaR =$('#fechahoraR').val();
      var data = [{
          "correlativo" : $('#nuevaserieViaje').val(),
          "cliente" : $('#seleccionarCliente').val(),
          "tipoDocumento" : $('#nuevotipodocumento').val(),
          "nDoc" : $('#nuevoNumeroDocumento').val(),
          "fechaR" : fechaR,
          "fechaS" : $('#fechahoraS').val(),
          "rutaS" : {
              "pais":$('#paisClienteSalida').val(),
              "estado":$('#estadoClienteSalida').val(),
          },
          "rutaD" :{
              "pais":$('#paisClienteDestino').val(),
              "estado":$('#estadoClienteDestino').val(),
          },
          "sa" : $('#serviciosA').val(),
          "obs" : ($('#obs').val())? $('#obs').val():null,
          "promotor" :($('#promotorName').val())? $('#promotorName').val():null ,
          "metodo" : listarMetodo()
      }]
      console.log(data)

})
