
 //Initialize Select2 Elements

 $(document).ready(function(){
    const info = $('#info').val()

    $('.select2').select2({
    ajax: {
    url: "api/clienteselect.api.php",
    type: "post",
    dataType: 'json',
    delay: 250,
    data: function (params) {
    return {
    palabraClave: params.term ,// search term
    info: info // search term
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
    
    const data = new FormData()
      data.append('info',$('#info').val())

    var box = $("input:radio[name=banco]:checked").val()
    if (box == 'bancovene') {
      
      $.ajax({
        url: "api/bancoallvene.api.php",
        method: "POST",
        data:data,
        async:true,
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
        data:data,
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
        datos.append('info',$('#info').val())
        $.ajax({
            url: "api/bancoveneselect.api.php",
            method: "POST",
            data: datos,
            async:true,
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
 
 
//////////////////////////////////////////////////////////////////////////
////////////////////////////   tabla dinamica    /////////////////////////////
//////////////////////////////////////////////////////////////////////////
$(document).ready(function () {



  var info = $('#info').val();
  $('#remesas').DataTable( {
 
    "order": [[ 0, "desc" ]],
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "dom": 'Bfrtip',
        "buttons": [
          { extend: 'pdf',
           orientation: 'landscape',    exportOptions: {
            columns: [1,2,3,4,5,6,7,8,9]
        },
           extend: 'pdfHtml5', 
           className: 'btn-danger' },
          { extend: 'excel',  exportOptions: {
            columns: [1,2,3,4,5,6,7,8,9]
        }, className: 'btn-success' },
          { extend: 'print',  exportOptions: {
            columns: [1,2,3,4,5,6,7,8,9]
        },className: 'btn-primary'}
        ],
 
    "ajax": {
      "url": "api/datatable-remesas.api.php",
      "type": "POST",
      "async":true,
      "data" : {  'remesas' : 'all','info':info },
      "dataSrc": "data"
  },
  "columns":[
    {data:"id" },
    {data:"correlativo" },
    {data:"clientes" },
    {data:"rol" },
    {data:"pais" },
    {data:null, render:function(data, type, row){
      return data.simbolo_tasa+parseFloat(data.tasa).toFixed(4)+" ("+data.iso_tasa+")"
    }  },
    {data:null, render:function(data, type, row){
      return data.simbolo_moneda+parseFloat(data.total_envio).toFixed(2)+" ("+data.iso_moneda+")"
    } },
    {data:null, render:function(data, type, row){
      return data.simbolo_tasa+parseFloat(data.total_remesa).toFixed(2)+" ("+data.iso_tasa+")"
    }  },
    {data:"fecha"},
    {data:"estado",render: function (data, type) {
          if (data==0) {
            return "<span class='badge badge-secondary'>Sin Verificar</span>";
          }else if(data== -1){
            return "<span class='badge badge-warning'>Crédito</span>";
            
          }else{
            return "<span class='badge badge-success'>Pagada</span>";

          }
    } },
    {data:"id", render: function (data, type) {
      return `<div class="btn-group"><button class="btn btn-primary btnVer" idRemesa="${data}" info="${info}"><i class="fas fa-eye"></i></button><div class="btn-group"><button class="btn btn-success btnImprimirFactura" idRemesa="${data}" info="${info}"><i class="fas fa-file-pdf"></i></button><button class="btn btn-danger btnEliminarRemesas" idRemesa="${data}" info="${info}"><i class='fas fa-trash-alt'></i></button></div> `
    }},
   

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




//Eliminar Moneda

$(document).on("click",".btnEliminarRemesas",function(){

    var idRemesa = $(this).attr("idRemesa");
    var info = $(this).attr("info");
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
            window.location = "index.php?ruta=admin-remesa&idRemesa="+idRemesa+"&info="+info;
        }
    })
})


// Numero correlativo

$(document).ready(function(){

  var fecha = new Date();
  var ano = fecha.getFullYear();
  const info = $('#info').val();

  const datos = new FormData()
  datos.append('info',info)
   
  $.ajax({
    url:"api/numeroserie.api.php",
    method:"POST",
    async:true,
    data:datos,
    dataType:'json',
    cache:false,
    processData:false,
    contentType:false,
    success: function (res) {
           if (res['correlativo'] == undefined) {
                 $('#nuevaserie').val( ano +' - '+ ('000' + '1').slice(-4))
                 // console.log(serie)
            }else{
                 const serie = parseFloat(res['correlativo'].substr(6,5))  + 1;
               
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
$("#divCalculo").on('click', function () {
  $("#pagoremesa").val('')
})

    $(".formularioVenta").on("change", "input#pagoremesa", function(){
 
        $(".alert").remove();
        if($("#pagoremesa").val() == ''){

            $('#totalremesa').val('');
        }
        else{
            if ($("input:radio[name=calculotasa]:checked").val() == 'multiplicar') {
           
              const total = Number.parseFloat($("#pagoremesa").val()) * Number.parseFloat($('#agregartasa').val())
              if(isNaN(total)){
                $('#totalremesa').val('');
                $("#pagoremesa").parent().after('<div class="alert alert-warning">Debes seleccionar una tasa</div>');
                $("#pagoremesa").val('')
                }else{
                
                    $('#totalremesa').val(trunc(Math.round10(Number.parseFloat(total),-3),2));
                
                }
           
            }else if ($("input:radio[name=calculotasa]:checked").val() == 'dividir') {
            
              const total = Number.parseFloat($("#pagoremesa").val()) / Number.parseFloat($('#agregartasa').val())
              if(isNaN(total)){
                $('#totalremesa').val('');
                $("#pagoremesa").parent().after('<div class="alert alert-warning">Debes seleccionar una tasa</div>');
                $("#pagoremesa").val('')
                }else{
                
                    $('#totalremesa').val(trunc(Math.round10(Number.parseFloat(total),-3),2));
                
                }
           
            }else{
              alert('Seleccione un metodo de calculo de tasa')
            }
            
           
          
        }
    
       
   })






// seleccion de banco por pago movil

$(document).ready(function(){
    $(".bancoselect").on('change', function () {
        $('.bancomovil-off').css('display','none')

     const data= new FormData()
     data.append('info',$('#info').val())

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
                data:data,
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
 



 /*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var idRemesa = $(this).attr("idRemesa");
	var info = $(this).attr("info");
	window.open("extensions/tcpdf/pdf/factura.php?id="+idRemesa+"&info="+info, "_blank");

})


$(".tablas").on("click", ".btnVer", function(){

	var idRemesa = $(this).attr("idRemesa");
	var info = $(this).attr("info");

  window.open("index.php?ruta=invoice&id="+idRemesa+"&info="+info, "_blank");

})



    


    
// Movimientos diarios

$(document).ready(function(){
  const info = $('#info').val();
  // console.log(info)
  const data = new FormData();
  data.append('info',info)
  //total monedas recibidas
  $.ajax({
      url: "api/remesarecibida.api.php",
      method: "POST",
      data:data,
      async:true,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
     
     
        if (respuesta != 0) {
          $.each(respuesta, function(i, item) {
            
            $(".totalRecibidas").append('<div class="col-sm-12 col-lg-3"><div class="small-box bg-info">'+
              '<div class="inner"><h3>'+respuesta[i]['simbolo_moneda']+''+Math.round10(respuesta[i]['total'],-3)+' ('+respuesta[i]['iso_moneda']+')</h3><p>Total de recibidos de hoy</p>'+
              '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
              '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
            });
          }else{
          $(".totalRecibidas").append('<div class="col-sm-12 col-lg-3"><div class="small-box bg-info">'+
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
  data:data,
  async:true,
  cache: false,
  contentType: false,
  processData: false,
  dataType: "json",
  success: function(respuesta) {
 
    if (respuesta != 0) {
      
      $.each(respuesta, function(i, item) {
        
        $(".totalEnviadas").append('<div class="col-sm-12 col-lg-3"><div class="small-box bg-info">'+
          '<div class="inner"><h3>'+respuesta[i]['simbolo_tasa']+''+Math.round10(respuesta[i]['total'],-3)+' ('+respuesta[i]['iso_tasa']+')</h3><p>Total de enviados de hoy</p>'+
          '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
          '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
        });
      }else{
      $(".totalEnviadas").append('<div class="col-sm-12 col-lg-3"><div class="small-box bg-info">'+
        '<div class="inner"><h3>0</h3><p>Total de enviados de hoy</p>'+
        '</div><div class="icon"><i class="fas fa-money-bill-alt"></i></div>'+
        '<a href="admin-remesa" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a></div></div>');
    }
      }
})

$.ajax({
  url: "api/clienteall.api.php",
  method: "POST",
  data:data,
  async:true,
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



$.ajax({
  url: "api/remesasall.api.php",
  method: "POST",
  data:data,
  async:true,
  cache: false,
  contentType: false,
  processData: false,
  dataType: "json",
  success: function(respuesta) {

    if (respuesta != 0) {
      
      $.each(respuesta, function(i, item) {
        
        $(".totalCliente").append('<div class="col-lg-3 col-6"><div class="small-box bg-success">'+
          '<div class="inner"><h3>'+respuesta[i]['remesa']+'</h3><p>Total de Remesas Enviadas</p></div>'+
          '<div class="icon"><i class="fas fa-coins"></i></div>'+
          '<a href="admin-remesa" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');
        });
      }else{
      $(".totalMonedas").append('<div class="col-lg-3 col-6"><div class="small-box bg-success">'+
      '<div class="inner"><h3>44</h3><p>Total de Remesas Enviadas</p></div>'+
      '<div class="icon"><i class="fas fa-coins"></i></div>'+
      '<a href="admin-remesa" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');

    }
    
      }
})


$.ajax({
  url: "api/remesasalltoday.api.php",
  method: "POST",
  data:data,
  async:true,
  cache: false,
  contentType: false,
  processData: false,
  dataType: "json",
  success: function(respuesta) {

    if (respuesta != 0) {
      
      $.each(respuesta, function(i, item) {
        
        $(".totalCliente").append('<div class="col-lg-3 col-6"><div class="small-box bg-primary">'+
          '<div class="inner"><h3>'+respuesta[i]['remesa']+'</h3><p>Remesas Enviadas hoy</p></div>'+
          '<div class="icon"><i class="fas fa-coins"></i></div>'+
          '<a href="admin-remesa" class="small-box-footer">Más Informacion<i class="fas fa-arrow-circle-right"></i></a></div></div>');
        });
      }else{
      $(".totalMonedas").append('<div class="col-lg-3 col-6"><div class="small-box bg-primary">'+
      '<div class="inner"><h3>44</h3><p>Remesas Enviadas hoy</p></div>'+
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
$("#btnReporteDiaA4").on("click", function(){
 const info=$(this).attr('info');

	window.open("extensions/tcpdf/pdf/reporte-dia-A4.php?info="+info, "_blank");

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
        const info=$('#info').val();
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

        var fechaInicial = start.format('YYYY-MM-DD');
        var fechaFinal = end.format('YYYY-MM-DD');
        var rangoFecha = $('#daterange-btn span').html();
        localStorage.setItem("rangoFecha", rangoFecha)
        window.open(`extensions/tcpdf/pdf/reporteA4.php?fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}&info=${info}`, "_blank");
        // window.location = "index.php?ruta=inicio&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

      }
    )

    //cancelar rango de fecha

    $(".cancelBtn").on("click",function(){
      localStorage.removeItem("rangoFecha");
      $("#daterange-btn span").html(' <i class="far fa-calendar-alt"></i> Rango de Fechas');
      window.location = "inicio";
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