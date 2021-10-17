
//datatable
$(function() {
    $("#pagosR").DataTable({
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




$(document).off("click", ".btnPagarP").on("click", ".btnPagarP",function () {
    $('.off-meto').remove()
    $('.contenedor-texto').html(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
    $('#clienteP, #BancoTransfer, #metodoPagosalida').empty()
    $('#BancoTransfer').append(`<option value="" selected>--- seleccionar un banco ---</option>`)
    $('#metodoPagosalida').append(`<option value="" selected>--- seleccionar un metodo de pago ---</option>`)
    //mandar datos id al ajax de perfil//

    const idPago = $(this).attr('idPagosP')

    const data = new FormData();
    data.append('idPagos', idPago)

    /////////////////////////////
    //Perfil del pago pendiente//
    /////////////////////////////
    
    $.ajax({
        url:'api/pagos.api.php',
        method:'POST',
        data:data,
        async:true,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success: function (respuesta) {
         

            $('#remesa_id').val(respuesta.id);
            $('#monto-cobro').val(respuesta.total_envio);
            $('#correlativo').html(respuesta.correlativo);
            $('.tipo-moneda').html(respuesta.simbolo_tasa);
            $('#clienteP').append(`<h2 class="saldo" style="font-size: 35px;" id="saldo">${respuesta.cliente}</h2>`)
            $('.receptor').html(` <strong> Titular: ${respuesta.receptor}</strong><br>  
            <strong>Doc.: ${respuesta.tipo_doc} - ${respuesta.n_doc}</strong><br>  
            <strong>Banco: ${respuesta.banco} </strong><br>
            <strong>Cuenta ${respuesta.n_cuenta}</strong>`);
            $('.saldoTransferencia').html(`<strong style="font-size:17px;color:green;"><i class="fas fa-money-bill-alt"></i> Saldo deposito</strong>
            <div><h2 style="font-size: 27px;">${respuesta.simbolo_moneda}${respuesta.total_envio} (${respuesta.iso_moneda})</h2></div><hr>
            <strong style="font-size:17px;color:red;"><i class="fas fa-money-bill-alt"></i> Saldo a Transferir</strong>
            <div><h2 style="font-size: 27px;">${respuesta.simbolo_tasa}${respuesta.total_remesa} (${respuesta.iso_tasa})</h2></div>`)
            $('#monto-salida').val(respuesta.total_remesa)
           
    
             
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
                 
                    if (respuesta.iso_tasa == 'VEN') {
                        var tipoBanco1='vene'
                    }else{
                        var tipoBanco1='inter'
                    }
                    $('#tipoBancoSalida').val(tipoBanco1)

                    if (respuesta.iso_moneda == 'VEN') {
                        var tipoBanco3='vene'
                    }else{
                        var tipoBanco3='inter'
                    }
                    $('#tipoBancoEntrada').val(tipoBanco3)
                    // metodo pago pago end //
                    $.each(res,function (i, item) {
                     
                        if (respuesta.iso_tasa == res[i].iso) {
                            
                            $('#BancoTransfer').append(`<option value="${res[i].id_cuenta}">${res[i].n_titular} ${res[i].a_titular} - ${res[i].nombre}: ${res[i].simbolo}${res[i].saldo} (${res[i].iso})</option>`)
                        }
                    })
                    if (respuesta.iso_tasa == 'VEN') {     
                        $('#metodoPagosalida').append(`<option value="transferencia">Transferencia</option><option value="transferencia digital">Transferencia Digital</option><option value="pago movil">Pago Movil</option>`);
                    }else{
                        $('#metodoPagosalida').append(`<option value="transferecia">Transferencia</option><option value="deposito">Deposito</option>`);

                    }
                

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
                                    <input type="hidden"  name="id_remesa" class="id_remesa" value="${respuesta.id}">
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
                                    <input type="hidden"  name="id_remesa" class="id_remesa" value="${respuesta.id}">
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
                                            const monto = parseFloat(sumarTotalMonto())
                                            const saldo = parseFloat(Number.parseFloat(respuesta.total_envio).toFixed(6))
                                            // console.log(respuesta.total_envio)
                                          
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

                                if (respuesta.iso_moneda == 'VEN') {
                                    var tipoBanco2='vene'
                                }else{
                                    var tipoBanco2='inter'
                                }
                        
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
                                <select class="form-control bancoselect BancoDeposito" name="BancoDeposito" required>
                                        
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
                                <span class="input-group-text tipo-moneda">${respuesta.simbolo_moneda}</span>
                              </div>
                                <input type="number" step="any" name="monto" class="form-control monto" >
                                <input type="hidden" name="id_remesa" class="id_remesa" value="${respuesta.id}">
                                <input type="hidden" name="tipoBanco" class="tipoBanco" value="${tipoBanco2}">
                                </div>
                                </div>
                                </div>
                                `)
                                $('.BancoDeposito').append(`<option value="" selected>--- seleccionar un banco ---</option>`)
                                $('.metodoPago').append(`<option value="" selected>--- seleccionar un metodo de pago ---</option>`)


                            //  metodo pago pago end //
                             $.each(res,function (i, item) {
                            
                                 if (respuesta.iso_moneda == res[i].iso) {
                                    
                                     $('.BancoDeposito').append(`<option value="${res[i].id_cuenta}">${res[i].n_titular} ${res[i].a_titular} - ${res[i].nombre}: ${res[i].simbolo}${res[i].saldo} (${res[i].iso})</option>`)
                                 }
                             })
                                    $('.eliminarCuentaDeposito').on('click',function(e){
                                        
                                        e.preventDefault()
                                      $(this).parent().parent().remove()
                                        })

                             $('.metodoPago').append(`<option value="transferecia">Transferencia</option><option value="deposito">Deposito</option>`);

                            $('#form-pago').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                                const monto = parseFloat(sumarTotalMonto().toFixed(6))
                                const saldo = parseFloat(Number.parseFloat(respuesta.total_envio).toFixed(6))
                                // console.log(respuesta.total_envio)
                               
                                   if (monto > saldo) {
                                        toastr.error('El monto es incorrecto, supera la cantidad del saldo a cobrar')
                                        $('.monto').val('')
                                    }else{
                                          listarMetodo()

                                       }
                             

                            })


                            })                               
                             //  metodo pago pago end //
                                ///////////////////////////////
                            //   cuenta que deposito  end  //
                            //////////////////////////////

                }
            })

             ///////////////////////////////
            //   cuenta que transfiere  end //
            //////////////////////////////



              

      


        }
    })


     
  
/*=============================================
    EJECUTANDO PAGOS
=============================================*/
    
    $('#form-pago').off('submit').on('submit',function(e){
        e.preventDefault()
        const clasesMetodo = $('.off-meto')
        const montoCobrar = Number.parseFloat($('#monto-cobro').val())


        //datos de ingreso 
        const datos = new FormData()
        datos.append('metodo',listarMetodo())
        datos.append('BancoTransfer',parseFloat($('#BancoTransfer').val()))
        datos.append('metodoPagosalida',$('#metodoPagosalida').val())
        datos.append('nOpeSalida',$('#nOpeSalida').val())
        datos.append('monto-salida',Number.parseFloat($('#monto-salida').val()).toFixed(2))
        datos.append('remesa_id',parseFloat($('#remesa_id').val()))
        datos.append('tipoBancoSalida',$('#tipoBancoSalida').val())
        datos.append('tipoBancoEntrada',$('#tipoBancoEntrada').val())

        if (clasesMetodo.length <= 0) {
            toastr.warning('Debe agregar un metodo de pago')
        }else{
                if ($('.metodoPago').val() != 'Credito') {
                    if (sumarTotalMonto() > montoCobrar) {
                        toastr.error('El monto de deposito supera la cantidad del saldo a cobrar')
                    }else if (sumarTotalMonto() < montoCobrar) {
                        toastr.warning('Si desea puede elejir el metodo de credito.')
                       toastr.error('El monto es menor a la cantidad del saldo a cobrar.')
                       
                    }else{
                     
              
                 
                            $.ajax({
                                url:'api/pagosp.api.php',
                                data:datos,
                                method:'POST',
                                dataType:'json',
                                processData:false,
                                cache:false,
                                contentType:false,
                                success: function(res){
                                  
                                    if (res == 'ok') {
                                        swal({
                                            type: "success",
                                            title: "¡El pago se registro correctamente!",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location ="pagos-pendientes"
                                            }
                                        })
                                    }else{
                                      

                                        swal({
                                                type: "error",
                                                title: "¡Algo salio mal",
                                                text: "Verique los montos y vuelva a intentarlo",
                                                showConfirmButton: true,
                                                confirmButtonText: "Cerrar",
                                                closeOnConfirm: false
                                
                                            }).then((result)=>{
                                
                                                if(result.value){
                                                    $("#pagosR").DataTable().destroy()
                                                    $('#modal-pagarP').modal('hide')
                                                }
                                
                                            });
                                    
                                    }
                                    


                                }
                            })

           
                    }
                    
                }else{
                 
        
                    $.ajax({
                        url:'api/pagosp.api.php',
                        data:datos,
                        method:'POST',
                        dataType:'json',
                        processData:false,
                        cache:false,
                        contentType:false,
                        success: function(res){
                            if (res == 'ok') {
                                swal({
                                    type: "success",
                                    title: "¡El pago a crédito se registro correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location ="pagos-pendientes"
                                    }
                                })
                            }else{
                              

                                swal({
                                        type: "error",
                                        title: "¡Algo salio mal",
                                        text: "Verique los montos y vuelva a intentarlo",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                        
                                    }).then((result)=>{
                        
                                        if(result.value){
                                            $("#pagosR").DataTable().destroy()
                                            $('#modal-pagarP').modal('hide')
                                        }
                        
                                    });
                            
                            }
                            

                            
                 

                        }
                    })


                }
     
        }
      
            
        



    })


})

 
  
/*=============================================
SUMAR METODOS LOS MONTOS
=============================================*/


function sumarTotalMonto(){

	var montoRemesa = $(".monto");
	var arraySumaMonto = [];  

	for(var i = 0; i < montoRemesa.length; i++){

        arraySumaMonto.push(Number($(montoRemesa[i]).val()));
		 
	}

	function sumaArrayMonto(total, numero){

		return total + numero;

	}
// return sumaArrayMonto()
	var sumaTotalPrecio = arraySumaMonto.reduce(sumaArrayMonto);
	
       return sumaTotalPrecio;



}


  
/*=============================================
LISTAR METODOS DE PAGO
=============================================*/
function listarMetodo(){

  
    var listaMetodos = [];
    var bancodeposito = $(".BancoDeposito");
    var monto = $(".monto");
    var metodoPago = $(".metodoPago");
    var nOperacion = $(".nOperacion");
    var id_remesa = $(".id_remesa");
    var tipoBanco = $(".tipoBanco");

    for(var i = 0; i < bancodeposito.length; i++){

        listaMetodos.push({
                            "id_remesa" : parseFloat($(id_remesa[i]).val()),
                            "banco" : parseFloat($(bancodeposito[i]).val()),
                            "tipoBanco" : $(tipoBanco[i]).val(),
                            "monto" : Number.parseFloat($(monto[i]).val()).toFixed(2),
                            "metodo" : $(metodoPago[i]).val(),
                            "nOperacion" : $(nOperacion[i]).val()})

    }

    return JSON.stringify(listaMetodos);

}


/////////////////////////////////////////////////////
/// notificaciones pagos ////////////
/////////////////////////////////////////////////////

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
  


/////////////////////////////////////////////////////
/// ver pagos ////////////
/////////////////////////////////////////////////////
$(".tablas").on("click", ".btnverPago", function(){

	var idPagos = $(this).attr("idPagos");

  window.open("index.php?ruta=invoice&id="+idPagos, "_blank");

})



/////////////////////////////////////////////////////
/// creditos notificacion ////////////
/////////////////////////////////////////////////////
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