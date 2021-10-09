
 
 
//datatable
$(function() {
    $("#recargas").DataTable({
        "order": [[ 1, "desc" ]],
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
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
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio",
                        "not": "Diferente de"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con",
                        "not": "Diferente de"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d"
            },
            "select": {
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "$d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                },
                "rows": {
                    "1": "1 fila seleccionada",
                    "_": "%d filas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "AM",
                    "PM"
                ],
                "months": {
                    "0": "Enero",
                    "1": "Febrero",
                    "10": "Noviembre",
                    "11": "Diciembre",
                    "2": "Marzo",
                    "3": "Abril",
                    "4": "Mayo",
                    "5": "Junio",
                    "6": "Julio",
                    "7": "Agosto",
                    "8": "Septiembre",
                    "9": "Octubre"
                },
                "weekdays": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sab"
                ]
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,




    });
});

 // Combobox Recarga

 $(document).ready(function(){
    $("#nuevaMonedaRecarga").on('change', function () {
        $('.formulario-recarga').remove();
        var recargaselect = $("#nuevaMonedaRecarga").val();
   
        

        var datos = new FormData();
        datos.append("recargaselect", recargaselect);
    
        $.ajax({
            url: "api/recargaselect.api.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                $("#nuevaMonedaRecarga").after(`<div class="form-group formulario-recarga">
                <input type="hidden" class="form-control" id="monto_pago" name="monto_pago">
                <input type="hidden" class="form-control" id="moneda_monto_id" name="moneda_monto_id">
                <input type="hidden" class="form-control" id="recarga" name="recarga">
                <input type="hidden" class="form-control" id="moneda_recarga_id" name="moneda_recarga_id">
                </div>`)

                $('#monto_pago').val(respuesta['monto'])
                $('#moneda_monto_id').val(respuesta['id_moneda_monto'])
                $('#recarga').val(respuesta['total_recarga'])
                $('#moneda_recarga_id').val(respuesta['id_moneda_recarga'])
           
            }
        })

       
   });
 })
 

//Editar Monto Recarga

$(document).on("click",".btnEditarMontoR",function() {
    var idMontoR = $(this).attr('idMontoR');
    var datos = new FormData();
    datos.append("idMontoR", idMontoR);
  
    $.ajax({
        url: "api/monto-recarga.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(rest) {
     
            $("#editaroperadora").val(rest['operadora'])
            $("#editarMonedaMonto").val(rest['id_moneda_monto'])
            $("#editarMonto").val(rest['monto'])
            $("#editarRecarga").val(rest['total_recarga'])
            $("#editarMonedaRecarga").val(rest['id_moneda_r'])
            $("#idMonto_r").val(rest['id'])
           
        }
    })
 

})


//Editar Monto Recarga

$(document).ready(function(){

    $('.crearmonto').prop('disabled', true);
    $('#operadora, #nuevaMonedaMonto, #nuevoMonto,#nuevoRecarga').on('change',function(){
        $('.text-danger').remove()

        if ($('#operadora').find("option:selected").val() != '' && $('#nuevaMonedaMonto').find("option:selected").val() != '' && $('#nuevoMonto').val() != '' && $('#nuevoRecarga').val() != '') {     
            $('.crearmonto').prop('disabled', false);
            $('.text-danger').remove()
        }else{
            if ($('#operadora').find("option:selected").val() == '') {     
                $('#operadora').after('<p class="text-danger">Campo Obligatorio</p>')
            }
            if ($('#nuevaMonedaMonto').find("option:selected").val() == '') {
                $('#nuevaMonedaMonto').after('<p class="text-danger">Campo Obligatorio</p>')
            }
            if ($('#nuevoMonto').val() == '') {
                $('#nuevoMonto').after('<p class="text-danger">Campo Obligatorio</p>')
            }
            if ($('#nuevoRecarga').val() == '') {
                $('#nuevoRecarga').after('<p class="text-danger">Campo Obligatorio</p>')
            }
            $('.crearmonto').prop('disabled', true);

        }
    
        
    })
 
})


//Eliminar Monto Recarga

$(document).on("click",".btnEliminarMontoRecarga",function(){

    var idMontoR = $(this).attr("idMontoR");
    swal({
        title:'¿Estas seguro de borrar el Monto de la Recarga?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar el monto!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=crear-monto&idMontoR="+idMontoR;
        }
    })
})


$(document).on('click','#enviar-recarga',function(){

    $('#nuevaMonedaRecarga').empty()
    $('.montos').remove()
    $('#nuevaMonedaRecarga').append('<option value="" selected="selected">Seleccione un monto a recargar</option>')
    $.ajax({
        url:'api/selectrecarga.api.php',
        method:'POST',
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',
        success: function(res){
           
            $("#divRadios").on('click', function () {
                $('#nuevaMonedaRecarga').empty()
                $('#nuevaMonedaRecarga').append('<option value="" selected="selected">Seleccione un monto a recargar</option>')
                var box = $("input:radio[name=operadora]:checked").val()
              
            $.each(res, function(i, item) {
                    if (box == res[i]['operadora']) {
                       
                        $('#nuevaMonedaRecarga').append(`<option value="${res[i]['id']}" >${res[i]['operadora']}: ${res[i]['simbolo_monto']}${res[i]['monto']} (${res[i]['iso_monto']}) | Recarga: ${res[i]['simbolo_monto_r']}${res[i]['total_recarga']} (${res[i]['iso_monto_r']})</option>`)
                    }else{
                        $('.off2,.off').empty()
                    }
                })
            
            })


        }
    })


})

    //combo box recargas//
$(document).ready(function() {
    $("#nuevaMonedaRecarga").on('change', function () {
        
        if ( $("#nuevaMonedaRecarga").val() != '') {
            
            $('.montos').remove()
            var idMontoR = $("#nuevaMonedaRecarga").val();

            var datos = new FormData();
            datos.append("idMontoR", idMontoR);
        
            $.ajax({
                url: "api/monto-recarga.api.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                   
                    $('#nuevaMonedaRecarga').after(`
                    <input type="hidden" class="montos" id="operadora" name="operadora" value="${respuesta['operadora']}">
                    <input type="hidden" class="montos" id="monto" name="monto" value="${respuesta['monto']}">
                    <input type="hidden" class="montos" id="idMonedaMonto" name="idMonedaMonto" value="${respuesta['id_moneda_monto']}">
                    <input type="hidden" class="montos" id="montoRecarga" name="montoRecarga" value="${respuesta['total_recarga']}">
                    <input type="hidden" class="montos" id="idMonedaR" name="idMonedaR" value="${respuesta['id_moneda_r']}">`)
               
                    // cuenta deposito final//
                    $.ajax({
                        url: "api/cuentasall.api.php",
                        method: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(res) {
                   
                          $('.off').empty()
                         
                          $('.off').append(`<h4><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Deposito --------------------------------</h4>
                    
                    
                          <div class="form-group">
                              <label for="exampleInputEmail1">Bancos</label>
                              <select class="form-control bancoselect" id="seleccionarBancoInter2" name="seleccionarBancoInter2" required>
                                      <option value="" selected>-- Seleccionar un banco --</option>
                              </select>
                             
                        </div>
                  
                     
        
                          <div class="form-group col-md-6">
        
                            <label for="exampleInputEmail1">N° de Trans. o Dep.</label>
                            <div class="input-group ">
                               <input type="number" id="n-op-entrada" name="n-op-entrada" class="form-control">
                        </div>
                          </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Monto a Cobrar</label>
                              <div class="input-group ">
                                <input type="number" id="pago-monto" name="pago-monto" class="form-control" value="${respuesta['monto']}" readonly>
                              
                               
                               
                            </div>
                            </div>
                         </div>`)
        
                          $.each(res, function(i, item) {
        
                            if(respuesta['iso_monto'] ==res[i]['iso']){
        
                              $('#seleccionarBancoInter2').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                            }
        
                            
        
                          });
        
        
                            
        
                  
                            }
                  })
    
                  // cuenta deposito final//
    
                  //cuenta banco a transferir//
                  
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
                              $('.off2').empty()
                              $('.off2').append(`<h4><i class="fas fa-arrow-alt-circle-up text-danger"></i> Cuenta Pago --------------------------------------</h4>
                    
                    
                          <div class="form-group">
                              <label for="exampleInputEmail1">Bancos</label>
                              <select class="form-control bancoselect" id="seleccionarBancoTransfer" name="seleccionarBancoTransfer" required>
                                      <option value="" selected>-- Seleccionar un banco --</option>
                              </select>
                             
                        </div>
                  
                     
        
                          <div class="form-group col-md-6">
        
                            <label for="exampleInputEmail1">N° de Trans. o Dep.</label>
                            <div class="input-group ">
                               <input type="number" id="n-op-salida" name="n-op-salida" class="form-control">
                        </div>
                          </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Monto a Cobrar</label>
                              <div class="input-group ">
                                <input type="number" id="pago-recarga" name="pago-recarga" class="form-control" value="${respuesta['total_recarga']}" readonly>
                       
                            
                               
                            </div>
                            </div>
                         </div>`)
                            $.each(res, function(i, item) {
      
                              if(respuesta['iso_monto_r'] ==res[i]['iso']){
                                $('#seleccionarBancoTransfer').append( '<option value="' + res[i]['id_cuenta'] + '">' + res[i]['n_titular'] + ' ' + res[i]['a_titular'] + ' - ' + res[i]['nombre'] + ': ' + res[i]['simbolo'] + '' + res[i]['saldo'] + ' (' + res[i]['iso'] + ')</option>');
                            }
      
                          });
                            
                     
              
                        }
              })
    
                  //cuenta banco a transferir end//
                }
            })
        }else{
            $('.off2,.off').empty()
        }

   
 })
})






//Eliminar Monto Recarga

$(document).on("click",".btnEliminarRecargas",function(){

    var idRecargas = $(this).attr("idRecargas");
    swal({
        title:'¿Estas seguro de borrar la Recarga?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la  recarga!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=admin-recargas&idRecargas="+idRecargas;
        }
    })
})