  ////////////////////////////////////
  //        tabla de boletos       //
  ///////////////////////////////////

  $(document).ready(function(){

    const info = $('#info').val()


    $('#boletos').DataTable( {
 
        "order": [[ 0, "desc" ]],
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [
          { extend: 'pdf',
           orientation: 'landscape',    exportOptions: {
            columns: [1,2,3,4,5,6,7,8]
        },
           extend: 'pdfHtml5', 
           className: 'btn-danger' },
          { extend: 'excel',  exportOptions: {
            columns: [1,2,3,4,5,6,7,8]
        }, className: 'btn-success' },
          { extend: 'print',  exportOptions: {
            columns: [1,2,3,4,5,6,7,8]
        },className: 'btn-primary'}
        ],
        "ajax": {
          "url": "api/boletos-consulta.api.php",
          "type": "POST",
          "data" : { 'all':'10', 'info':info },
          "dataSrc": "data"
      },
      "columns":[
        {data:"id" },
        {data:"correlativo" },
        {data:"cliente" },
        {data:"tipo_doc" },
        {data:"documento" },
        {data:"telefono" },
        {data:"fecha_s" },
        {data:"pais_s" },
        {data: "estado", render: function(data, type) {
       
          if (data == 0) {
              return "<span class='badge badge-warning'>Crédito</span>";
            }
            return "<span class='badge badge-success'>Procesado</span>";
    
      }},
        {data:"id", render: function(data, type) {
       
            return `<div class='btn-group'><button class='btn btn-primary btnVerBoleto' idBoleto="${data}"><i class='fas fa-eye'></i></button><div class='btn-group'><button class='btn btn-success btnImprimirBoleto' idBoleto="${data}"><i class='fas fa-file-pdf'></i></button></button><button class='btn btn-danger btnEliminarBoleto' idBoleto="${data}"><i class='fas fa-trash-alt'></i></button></div>`;
    
      }}
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
          "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad",
            "collection": "Colección",
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



  ////////////////////////////////////
  //  tabla de boletos a creditos  //
  ///////////////////////////////////

$('#credito-boleto').DataTable( {
 
    "order": [[ 0, "desc" ]],
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "ajax": {
      "url": "api/boletos-consulta.api.php",
      "type": "POST",
      "data" : { 'credito' : '10' },
      "dataSrc": "data"
  },
  "columns":[
    {data:"id" },
    {data:"correlativo" },
    {data:"cliente" },
    {data:"telefono" },
    {data:"abonado",render: function name(data, type) {
        return '<span style="color:green">' + data + '</span>';
    }},
    {data:"restante",render: function name(data, type) {
            return '<span style="color:red">' + data + '</span>';
    } },
    {data:"boleto_id", render: function(data, type) {
        return `<div class='btn-group'> <button class='btn btn-primary btnVerBoleto' idBoleto="${data}"><i class='fas fa-eye'></i></button> <button data-toggle="modal" data-target="#modal-credito" class='btn btn-success btnCreditosBoletos' idBoleto="${data}">Pagar</button></div>`;
  }}
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
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
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
                $('#nuevaserieViaje').val( 'V-'+ano +'-'+ ('000' + '1').slice(-4))
                // console.log(serie)
            }else{
                const serie = parseFloat(respuesta['correlativo'].substr(6,5))  + 1;
               
                $('#nuevaserieViaje').val( 'V-'+ano +'-'+ ('000' + serie).slice(-4))

                }

            }
 })

})

 /*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirBoleto", function(){

	var idBoleto = $(this).attr("idBoleto");

	window.open("extensions/tcpdf/pdf/ticket-boleto.php?id="+idBoleto, "_blank");

})

  /*=============================================
IMPRIMIR FACTURA END
=============================================*/



/////////////////////////////////////////////////////
/// ver pagos ////////////
/////////////////////////////////////////////////////
$(".tablas").on("click", ".btnVerBoleto", function(){

    var idBoleto = $(this).attr("idBoleto");
    
    window.open("index.php?ruta=view-boleto&id="+idBoleto, "_blank");
    
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
     const info = $('#info').val()
     const data= new FormData();
     data.append('info',info);
     $('#tipoMoneda').on('change', function(){
        $('.off-meto').remove()
        $('.alertaColocada').remove()
        $('#tipoMoneda').css('border','1px solid #ced4da')
        $('.costo').css('border','1px solid #ced4da')
     })

     $.ajax({
       url:'api/cuentasall.api.php',
       method:'POST',
       dataType:'json',
       data:data,
       async:true,
       cache:false,
       contentType:false,
       processData:false,
       success: function (res) {
           $(document).off('click','#m-credP').on('click','#m-credP',function(){
            $('#tipoPagoBtn').val('')
            $('#tipoPagoBtn').val('Credito')
            
                if ($('#tipoMoneda').val()!= '' && $('.costo').val() != '') {
                      
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
                   
                }else{
                    $('.alertaColocada').remove()
                    toastr.warning('Debe seleccionar el tipo de moneda e ingresar costo del servicios')
                    $('#tipoMoneda').css('border','1px solid #dc3545 ')
                    $('.costo').css('border','1px solid #dc3545 ')
                }
            })  
                    ///////////////////////////////
                   // metodo de pago en credito//
                   //////////////////////////////


                    ///////////////////////////////
                   // metodo de pago en credito end//
                   //////////////////////////////

              


                   ///////////////////////////////
                   // metodo de pago en efectivo//
                   //////////////////////////////
                   $(document).off('click','#m-efectivoP').on('click','#m-efectivoP',function(){
                    $('#tipoPagoBtn').val('')
                    $('#tipoPagoBtn').val('Efectivo')
                            if ($('#tipoMoneda').val()!= '' && $('.costo').val() != '') {
                                
                                
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

                            }else{
                                $('.alertaColocada').remove()
                                toastr.warning('Debe seleccionar el tipo de moneda e ingresar costo del servicios')
                                $('#tipoMoneda').css('border','1px solid #dc3545 ')
                                $('.costo').css('border','1px solid #dc3545 ')
                            }



                   })     


                   ///////////////////////////////
                   // metodo de pago en efectivo end//
                   //////////////////////////////




                       ///////////////////////////////
                   //   cuenta que deposito   //
                   //////////////////////////////
                               
                   // metodo de pago salido end
               
                   $(document).off('click','#m-dtP').on('click','#m-dtP',function(){
                    $('#tipoPagoBtn').val('')
                    $('#tipoPagoBtn').val('Transfer')
                    if ($('#tipoMoneda').val()!= '' && $('.costo').val() != '') {
                        if ($('#tipoMoneda').val() == 'VEN') {
                            var tipoBanco2='vene'
                        }else{
                            var tipoBanco2='inter'
                        }
                            $('#tipoBancoEntradaBoleto').val(tipoBanco2)
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
                            <label for="exampleInputEmail1">Monto depositado</label>
                            <div class="input-group ">
                            <div class="input-group-prepend">
                            <span class="input-group-text tipo-moneda"></span>
                          </div>
                            <input type="number" step="any" name="monto" class="form-control monto" >
                        
                            <input type="hidden" name="tipoBanco" class="tipoBanco">
                            </div>
                            </div>
                            </div>
                            `)
                            $('.tipoBanco').val(tipoBanco2)
                            $('.BancoDeposito').append(`<option value="" selected>--- seleccionar un banco ---</option>`)
                            $('.metodoPago').append(`<option value="" selected>--- seleccionar un metodo de pago ---</option>`)
     
     
                        //  metodo pago pago end //
                         $.each(res,function (i, item) {
                        
                             if ( $('#tipoMoneda').val()== res[i].iso) {
     
                                 $('.BancoDeposito').append(`<option value="${res[i].id_cuenta}">${res[i].n_titular} ${res[i].a_titular} - ${res[i].nombre}: ${res[i].simbolo}${res[i].saldo} (${res[i].iso})</option>`)
                             }
                                
                             
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
                          const costo = Number.parseFloat($('.costo').val())
                          console.log(monto,costo)
                         
                             if (monto > costo) {
                                  toastr.error('El monto es incorrecto, supera la cantidad del saldo a cobrar')
                                  $('.monto').val('')
                              }else{
                                    listarMetodo()

                                 }
                        })
                        }else{
                            $('.alertaColocada').remove()
                            toastr.warning('Debe seleccionar el tipo de moneda e ingresar costo del servicios')
                            $('#tipoMoneda').css('border','1px solid #dc3545 ')
                            $('.costo').css('border','1px solid #dc3545 ')
                      
                    
                        }
               
                   


                   })                               
                    //  metodo pago pago end //
                       ///////////////////////////////
                   //   cuenta que deposito  end  //
                   //////////////////////////////

       }
   })
})



function serviciosAdicionales(){
    const info = $('#info').val();
const data = new FormData()
data.append('mostrar','')
data.append('info',info)
   $.ajax({
       url:'api/ingresar-servicios.api.php',
       data:data,
       async:true,
       dataType:'json',
       method:'POST',
       cache:false,
       contentType:false,
       processData:false,
       success: function(res){
           $.each(res, function(i,item){
               $('#serviciosA').append(`<option value="${res[i].description}">${res[i].description}</option>`)
               $('#listaServicios').append(`
               <tr>
               <td>${res[i].description}</td>
               <td><a href="" class="btn btn-danger btn-sm btnEliminarServicios" info="${info}" idServicios="${res[i].id}"><i class="fas fa-trash-alt"></i></a></td>
               </tr>
               `)
           })
          
       }
   })
}
serviciosAdicionales()
  

$('#form-servicios').on('submit',function(e){
    e.preventDefault();
    const info = $('#info').val();
    const servicios = $('#serviciosAdicional').val();

    // console.log($('#serviciosAdicional').val());
    var datos = new FormData()
    datos.append('servicios', servicios)
    datos.append('info',info)
    $.ajax({
        url:'api/ingresar-servicios.api.php',
        data:datos,
        async:true,
        dataType:'json',
        method:'POST',
        cache:false,
        contentType:false,
        processData:false,
        success: function(res){
            if (res == 'ok') {
                swal({
                    type: "success",
                    title: "¡El servicio se registro correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result)=>{
                    if(result.value){

                        $('#listaServicios').empty()
                        $('#serviciosA').empty()
                        $('#serviciosA').append(` <option selected class="text-center">--- Seleccione un servicio -----</option>`)
                        serviciosAdicionales()
                        $('#agregarServicios').modal('hide')
                        $('#serviciosAdicional').val('')
                    }
                })
            }else{
                swal({
                    type: "error",
                    title: "¡Algo salio mal",
                    text: "Todos los campos son obligatorio",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
    
                }).then((result)=>{
    
                    if(result.value){
  
                        $('#agregarServicios').modal('hide')
                    }
    
                });
            }
          
        }
    })


})

$(document).on('click','.btnEliminarServicios',function(e){
   e.preventDefault()
   const idServiocio = $(this).attr('idServicios')
   const info = $(this).attr('info')


    var datos = new FormData()
    datos.append('eliminar', idServiocio)
    datos.append('info', info)

    $.ajax({
        url:'api/ingresar-servicios.api.php',
        data:datos,
        async:true,
        dataType:'json',
        method:'POST',
        cache:false,
        contentType:false,
        processData:false,
        success: function(res){
            if (res == 'ok') {
                swal({
                    type: "success",
                    title: "¡El servicio se elimino correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result)=>{
                    if(result.value){

                        $('#listaServicios').empty()
                        $('#serviciosA').empty()
                        $('#serviciosA').append(`<option selected class="text-center">--- Seleccione un servicio ---</option>`)
                        serviciosAdicionales()
                        $('#serviciosAdicional option').each(function () {
                            this.selected = true;
                            return false;
                    });
                    }
  
                })
            }else{
                swal({
                    type: "error",
                    title: "¡Algo salio mal",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
    
                }).then((result)=>{
    
                    if(result.value){
  
                        $('#agregarServicios').modal('hide')
                    }
    
                });
            }
          
        }
    })
})

$('#formulario-boletos').on('submit', function(e){
  e.preventDefault()


  e.stopImmediatePropagation()
  const monto = sumarTotalMonto()
  const costo = Number.parseFloat($('.costo').val())


  var datos = [{
    "correlativo" : $('#nuevaserieViaje').val(),
    "info" : $('#info').val(),
    "costo" : costo,
    "idMoneda" : $('#tipoMoneda').val(),
    "tipopago" : $('#tipoPagoBtn').val(),
    "cliente" : $('#seleccionarCliente').val(),
    "user_id" : $('#idVendedor').val(),
    "tipoBancoEntradaBoleto" :   $('#tipoBancoEntradaBoleto').val(),
   
    "fechaR" : $('#fechahoraR').val(),
    "fechaS" : $('#fechahoraS').val(),
    "rutaS" : {
        "pais":Number.parseInt($('#paisClienteSalida').val()),
        "estado":Number.parseInt($('#estadoClienteSalida').val()),
    },
    "rutaD" :{
        "pais":Number.parseInt($('#paisClienteDestino').val()),
        "estado":Number.parseInt($('#estadoClienteDestino').val()),
    },
    "sa" : $('#serviciosA').val(),
    "obs" : ($('#obs').val())? $('#obs').val():null,
    "promotor" :($('#promotorName').val())? $('#promotorName').val():null ,
    "metodo" : listarMetodo()
}]

const data = new FormData()
data.append('datos',JSON.stringify(datos))


  if ($('#tipoPagoBtn').val()!= 'Credito') {
      
      if (monto < costo) {
  
        toastr.warning('Si desea puede elegir el metodo de credito.')
        toastr.error('El monto es menor a la cantidad del saldo a cobrar.')
      
      }else{
        $.ajax({
            url:'api/boleto.api.php',
            data:data,
            method:'POST',
            async:true,
            dataType:'json',
            cache:false,
            processData:false,
            contentType:false,
            success: function(res){
             console.log(res)
    
              if (res.respuesta == 'ok') {
                                
                  swal({
                      type: "success",
                      title: "¡El Boleto se registro correctamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                  }).then((result)=>{
                    if(result.value){
                        window.open("extensions/tcpdf/pdf/ticket-boleto.php?id="+res.id, "_blank");
                        window.location ="admin-boletos"
                    }
                      
                  })
              }else{
                
    
                  swal({
                          type: "error",
                          title: "¡Algo salio mal",
                          text: "Verique que todo los campos esten correctos",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
          
                      })
              
              }
    
            },
        })
      }
  }else{

    $.ajax({
        url:'api/boleto.api.php',
        data:data,
        method:'POST',
        async:true,
        dataType:'json',
        cache:false,
        processData:false,
        contentType:false,
        success: function(res){
         console.log(res)

          if (res.respuesta == 'ok') {
                            
              swal({
                  type: "success",
                  title: "¡El Boleto se registro a crédito correctamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
              }).then((result)=>{
                if(result.value){
                    window.open("extensions/tcpdf/pdf/ticket-boleto.php?id="+res.id, "_blank");
                    window.location ="admin-boletos"
                }
                  
              })
          }else{
            

              swal({
                      type: "error",
                      title: "¡Algo salio mal",
                      text: "Verique que todo los campos esten correctos",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
      
                  })
          
          }

        },
    })
  }
     


})


