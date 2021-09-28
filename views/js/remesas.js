
 //Initialize Select2 Elements

 $(document).ready(function(){
  
    $('.select2').select2({
    ajax: {
    url: "api/clienteselect.api.php",
    type: "post",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      

    return {
    palabraClave: params.term // search term
    };
    },
    processResults: function (response) {
   

        return {
            results: $.map(response, function(obj) {
                return { id: obj.id, text: obj.nombres + " " + obj.apellidos + " - " + obj.tipo_doc + ": " + obj.numero_doc};
            })
        };

            // return {
            // results: JSON.stringify(response)
            // };
    },
    cache: true
    }
    });
    });

   //Initialize Select2 Elements
   $('.select2bs4').select2({
     theme: 'bootstrap4'
   })

 

// seleccion de banco por pago movil


$(document).ready(function(){
  $("#divRadios").on('click', function () {
    $('#bancocode').remove()
    $('#seleccionarBanco').find('option').remove();
    $('#seleccionarBanco').append( '<option selected>-- Seleccionar banco --</option>');
    
    var box = $("input:radio[name=banco]:checked").val()
    if (box == 'bancovene') {
      
      $.ajax({
        url: "api/bancoallvene.api.php",
        method: "POST",
      
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            
           
  
               $.each(respuesta, function(i, item) {
                $('#seleccionarBanco').append( '<option value="' + respuesta[i]['nombre'] + '">' + respuesta[i]['nombre'] + '</option>');
            });
            $('.bancocode').append('<input type="text" class="form-control" id="bancocode" name="bancocode" placeholder="codigo banco" readonly>')
           
        }
    }) 
    }else{
    
      $.ajax({
        url: "api/bancoall.api.php",
        method: "POST",
      
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
               
        
  
               $.each(respuesta, function(i, item) {
                $('#seleccionarBanco').append( '<option value="' + respuesta[i]['nombre'] + '">' + respuesta[i]['nombre'] + '</option>');
            });
          
  
        }
    }) 

    }

     
 });
})


 // Combobox Banco

 $(document).ready(function(){
    $(".bancoselect").on('change', function () {

        var bancoselect = $(".bancoselect").val();
   
        

        var datos = new FormData();
        datos.append("bancoselect", bancoselect);
    
        $.ajax({
            url: "api/bancoveneselect.api.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
           
                $("#bancocode").val(respuesta['codigo']);
                $("#cuenta-banco").val('');
            }
        })

       
   });
 })
 

 

// cargar data de remesas 

$.ajax({
    url: "api/datatable-remesas.api.php",
    success: function(respuesta){
        // console.log("respuesta", respuesta);
    }
})

//////////////////////////////////////////////////////////////////////////
////////////////////////////   localstorage    /////////////////////////////
//////////////////////////////////////////////////////////////////////////

if(localStorage.getItem("rangoFecha") != null){
 $("#daterange-btn span").html(localStorage.getItem("rangoFecha"));
}else{
  $("#daterange-btn span").html(' <i class="far fa-calendar-alt"></i> Rango de Fechas');

}

//////////////////////////////////////////////////////////////////////////
////////////////////////////   tabla dinamica    /////////////////////////////
//////////////////////////////////////////////////////////////////////////

 $('#remesas').DataTable( {
    "order": [[ 1, "desc" ]],
    "ajax": "api/datatable-remesas.api.php",
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

//Eliminar Moneda

$(document).on("click",".btnEliminarRemesas",function(){

    var idRemesa = $(this).attr("idRemesa");
    swal({
        title:'¿Estas seguro de borrar esta Remesa?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la Remesa!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=admin-remesa&idRemesa="+idRemesa;
        }
    })
})


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
                $('#nuevaserie').val( ano +' - '+ ('000' + '1').slice(-4))
                // console.log(serie)
            }else{
                const serie = parseFloat(respuesta['correlativo'].substr(6,5))  + 1;
               
                $('#nuevaserie').val( ano +' - '+ ('000' + serie).slice(-4))

                }

            }
 })

})



//boton agregar tasas


  $(document).on("click",".botonagregar",function() {
// $('.botonagregar').click(function() {

    var boton =  $(this).parent().parent().find('td').eq(2)
    // var boton =  attr("selectTasa").parent().parent()
    // $("#agregarpais").val(respuesta['tipo_doc'])
  
    // datos.append("boton", boton);
  
     $('#nuevoProducto').html(`<span class="input-group-prepend">
     <button type="button" class="btn btn-danger eliminarTasa"><i class="fa fa-times"></i></button>
 </span>
 
 <div class="input-group col-md-2">
 <input type="hidden" class="form-control" id="idTasaenvio" name="idTasaenvio">
     <input type="text" class="form-control" id="agregarpais" name="agregarpais" readonly required>
 </div>
 <div class="input-group col-md-3">
     <input type="text" class="form-control" id="agregarmoneda" name="agregarmoneda" readonly required>
     <input type="hidden" class="form-control" id="agregarsimbolo" name="agregarsimbolo" readonly required>
 </div>
 <div class="input-group col-md-1">
     <input type="text" class="form-control" id="agregariso" name="agregariso" readonly required>
 </div>

 <div class="input-group col-md-2"><span class="input-group-addon"><i class="ion ion-social-usd"></i>
 </span><input type="text" class="form-control" step="any" id="agregartasa" name="agregartasa" readonly required>

 </div>
 
 <div class="input-group col-md-1">
     <input type="text" class="form-control" id="agregarsimboloTasa" name="agregarsimboloTasa" readonly required>
 </div> 
 <div class="input-group col-md-1">
     <input type="text" class="form-control" id="agregarisoTasa" name="agregarisoTasa" readonly required>
 </div>`)
 
    console.log($(this).parent().parent().find('td').eq(0).text());
    const tasa =$(this).parent().parent().find('td').eq(5).text()



     $('#idTasaenvio').val($(this).parent().parent().find('td').eq(0).text())
     $('#agregarpais').val($(this).parent().parent().find('td').eq(1).text())
     $('#agregarmoneda').val($(this).parent().parent().find('td').eq(2).text())
     $('#agregarsimbolo').val($(this).parent().parent().find('td').eq(3).text())
     $('#agregariso').val($(this).parent().parent().find('td').eq(4).text())
     $('#agregartasa').val(parseFloat(tasa))
     $('#agregarsimboloTasa').val($(this).parent().parent().find('td').eq(6).text())
     $('#agregarisoTasa').val($(this).parent().parent().find('td').eq(7).text())
 
   
    //  $('#agregartasa').val($(this).parent().parent().find('td').eq(2).text().replace(/[^0-9\.]+/g, "").replace(".",""))
    //  $('#agregartasa').val($(this).parent().parent().find('td').eq(2).text().replace(/[^0-9\.]+/g, "").replace(".",""))
    //  $('#agregarpais').val($(this).parent().parent().find('td').eq(2).text().replace(/[^0-9\.]+/g, "").replace(".",""))

    $('.eliminarTasa').click(function() {

        const boton = $(this).parent().parent().remove()
        $('#pedre').html('<div class="form-group row" id="nuevoProducto"></div>')
    
        $('#totalremesa').val('');
        $('#pagoremesa').val('');
        
        $('#pagoefectivo').val('');
        $('#cambiopago').val('');
    })

    $('#totalremesa').val('');
    $('#pagoremesa').val('');
    $('#pagoefectivo').val('');
    $('#cambiopago').val('');
  
})






//calculo del total de la remesa


$(document).ready(function(){
    $(".formularioVenta").on("change", "input#pagoremesa", function(){
    // $("#pagoremesa").keydown( function () {
        $(".alert").remove();
        if($("#pagoremesa").val() == ''){

            $('#totalremesa').val('');
        }
        else{

            const total = Number.parseFloat($("#pagoremesa").val()) * Number.parseFloat($('#agregartasa').val())
           
            if(isNaN(total)){
                $('#totalremesa').val('');
                $("#pagoremesa").parent().after('<div class="alert alert-warning">Debes seleccionar una tasa</div>');
                $("#pagoremesa").val('')
            }else{
  
                $('#totalremesa').val(Number.parseFloat(total));
            }
        }
    
       
   })
});





// seleccion de banco por pago movil

$(document).ready(function(){
    $(".bancoselect").on('change', function () {
        $('.bancomovil-off').css('display','none')
    //   var beta =  $(".bancoselect").val()
    //     console.log(beta)
        if ($(".bancoselect").val() == 'PAGO MOVIL') {

            //Limpiar css
            $('.bancomovil-off').css('display','')
          
            $('#bancopagomovil').remove();
            $('.colocarpagomovil').after(`   <select class="form-control" id="bancopagomovil" name="bancopagomovil" required>

                  

            </select>`)
            // Limpiamos el select
             $('#bancopagomovil').find('option').remove();
              $('#bancopagomovil').append( '<option selected>-- Seleccionar banco --</option>');
        
            $.ajax({
                url: "api/bancoallvene.api.php",
                method: "POST",
              
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                     
                   

                       $.each(respuesta, function(i, item) {
                        $('#bancopagomovil').append( '<option value="' + respuesta[i]['nombre'] + '">' + respuesta[i]['nombre'] + '</option>');
                    });
          
                }
            }) 

        }
        
   });
 })
 

 
// seleccion metodo de pago

$(document).ready(function(){
    $("#nuevoMetodoPago").on('change', function () {
    $('.efectivo').remove()
    $('.deposito').remove()
    $('#bancoTrans').remove()
       
        const metodoPago = $("#nuevoMetodoPago").val()

     if (metodoPago == 'Efectivo') {
     
         $(".pagometodo").after('<div class="input-group mb-3 col-md-3 efectivo"><span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
         '<input type="number" class="form-control input-lg" id="pagoefectivo" name="pagoefectivo"  placeholder="Pago"  required> </div>'+
       '<div class="input-group mb-3 col-md-3 efectivo"><span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
            '<input type="number" class="form-control input-lg" id="cambiopago" step="any" name="cambiopago"  placeholder="cambio" readonly required> </div>');
            
           $(".formularioVenta").on("change", "input#pagoefectivo,input#pagoremesa", function(){
            $('.alert').remove()
               const efectivo =$(this).val()
            if( Number(efectivo) < Number($('#pagoremesa').val())) {
                $(this).val('').after('<div class="alert text-danger">Monto invalido</div>')
               }else{

                   const cambio =  Number(efectivo) - Number($('#pagoremesa').val()) 
                
                   $('#cambiopago').val(cambio);
               }
            })
   

     }else if(metodoPago == 'Desposito' || metodoPago == 'Transferencia'){
     
      
        $(".pagometodo").after(`<div class="input-group mb-3 col-md-3 "><select class="form-control" id="bancoTrans" name="bancoTrans" required></div>`)
        $.ajax({
          url: "api/bancoall.api.php",
          method: "POST",
        
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(respuesta) {
                 
          
    
                 $.each(respuesta, function(i, item) {
                  $('#bancoTrans').append( '<option value="' + respuesta[i]['nombre'] + '">' + respuesta[i]['nombre'] + '</option>');
              });
            
    
          }
      }) 
        $(".pagometodo").after('<div class="input-group mb-3 col-md-3 efectivo"><input type="number" class="form-control input-lg" id="pagoefectivo" name="pagoefectivo"  placeholder="Pago"  required> </div>');
      $(".pagometodo").after(
        '<div class="input-group mb-3 col-md-3 deposito"><span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
    '<input type="number" class="form-control input-lg" id="numero_deposito" name="numero_deposito"  placeholder="Numero de transacción"  required></div>'
    );
     }
        
   });
 })



 /*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var idRemesa = $(this).attr("idRemesa");

	window.open("extensions/tcpdf/pdf/factura.php?id="+idRemesa, "_blank");

})


$(".tablas").on("click", ".btnVer", function(){

	var idRemesa = $(this).attr("idRemesa");

  window.open("index.php?ruta=invoice&id="+idRemesa, "_blank");

})



//////////////////////////////////////////////////////////////////////////
////////////////////////////   datapicker    /////////////////////////////
//////////////////////////////////////////////////////////////////////////

    // Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Dia de ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 7 dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Mes pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

        var fechaInicial = start.format('YYYY-MM-DD');
        var fechaFinal = end.format('YYYY-MM-DD');
        var rangoFecha = $('#daterange-btn span').html();
        localStorage.setItem("rangoFecha", rangoFecha)

        window.location = "index.php?ruta=reporte-remesa&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

      }
    )


    //cancelar rango de fecha

    $(".cancelBtn").on("click",function(){
      localStorage.removeItem("rangoFecha");
      $("#daterange-btn span").html(' <i class="far fa-calendar-alt"></i> Rango de Fechas');
      window.location = "reporte-remesa";
    })

    
//validador de remesas boton
    $(document).ready(function(){
      jQuery('#idboton').prop('disabled', true);
    
      $('#seleccionarCliente, #nuevoMetodoPago, #seleccionarBanco').on('change',function(){
     
        if ($('#seleccionarCliente').find("option:selected").val() != '' && $('#nuevoMetodoPago').find("option:selected").val() != '' && $('#seleccionarBanco').find("option:selected").val() != '') {
          jQuery('#idboton').prop('disabled', false);
        }
      })
    
    })
    


    
// Movimientos diarios

$(document).ready(function(){

  //total monedas recibidas
  $.ajax({
      url: "api/remesarecibida.api.php",
      method: "POST",
    
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
     
     
        if (respuesta != 0) {
          $.each(respuesta, function(i, item) {
            
            $(".totalRecibidas").append('<div class="col-lg-3 col-6"><div class="small-box bg-info">'+
              '<div class="inner"><h3>'+respuesta[i]['simbolo_moneda']+''+respuesta[i]['total']+' ('+respuesta[i]['iso_moneda']+')</h3><p>Total de recibidos de hoy</p>'+
              '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
              '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
            });
          }else{
          $(".totalRecibidas").append('<div class="col-lg-3 col-6"><div class="small-box bg-info">'+
            '<div class="inner"><h3>0</h3><p>Total de recibidos de hoy</p>'+
            '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
            '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
        }
          }
})

  //total Monedas enviadas

 $.ajax({
  url: "api/remesasenviadas.api.php",
  method: "POST",

  cache: false,
  contentType: false,
  processData: false,
  dataType: "json",
  success: function(respuesta) {
 
    if (respuesta != 0) {
      
      $.each(respuesta, function(i, item) {
        
        $(".totalEnviadas").append('<div class="col-lg-3 col-6"><div class="small-box bg-info">'+
          '<div class="inner"><h3>'+respuesta[i]['simbolo_tasa']+''+respuesta[i]['total']+' ('+respuesta[i]['iso_tasa']+')</h3><p>Total de enviados de hoy</p>'+
          '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
          '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
        });
      }else{
      $(".totalEnviadas").append('<div class="col-lg-3 col-6"><div class="small-box bg-info">'+
        '<div class="inner"><h3>0</h3><p>Total de enviados de hoy</p>'+
        '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
        '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
    }
      }
})
})


$(document).ready(function(){

  $.ajax({
      url: "api/clienteall.api.php",
      method: "POST",
    
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
    
        if (respuesta != 0) {
          
          $.each(respuesta, function(i, item) {
            
            $(".totalCliente").append('<div class="col-lg-3 col-6"><div class="small-box bg-warning">'+
              '<div class="inner"><h3>'+respuesta[i]['name']+'</h3><p>clientes Registrados</p></div>'+
              '<div class="icon"><i class="far fa-user"></i></div>'+
              '<a href="clientes" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');
            });
          }else{
          $(".totalMonedas").append('<div class="col-lg-3 col-6"><div class="small-box bg-warning">'+
          '<div class="inner"><h3>44</h3><p>User Registrations</p></div>'+
          '<div class="icon"><i class="far fa-user"></i></div>'+
          '<a href="clientes" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');

        }
        
          }
})

})

$(document).ready(function(){

  $.ajax({
      url: "api/remesasall.api.php",
      method: "POST",
    
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
    
        if (respuesta != 0) {
          
          $.each(respuesta, function(i, item) {
            
            $(".totalCliente").append('<div class="col-lg-3 col-6"><div class="small-box bg-success">'+
              '<div class="inner"><h3>'+respuesta[i]['remesa']+'</h3><p>Remesas Enviadas</p></div>'+
              '<div class="icon"><i class="fas fa-coins"></i></div>'+
              '<a href="admin-remesa" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');
            });
          }else{
          $(".totalMonedas").append('<div class="col-lg-3 col-6"><div class="small-box bg-success">'+
          '<div class="inner"><h3>44</h3><p>Remesas Enviadas</p></div>'+
          '<div class="icon"><i class="fas fa-coins"></i></div>'+
          '<a href="admin-remesa" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');

        }
        
          }
})

})


 /*=============================================
IMPRIMIR REPORTE DEL DIA
=============================================*/

$("#btnReporteDia").on("click", function(){


	window.open("extensions/tcpdf/pdf/reporte-dia.php", "_blank");

})
