
//trncar decimales
function trunc (x, posiciones = 0) {
    var s = x.toString()
    var l = s.length
    var decimalLength = s.indexOf('.') + 1
  
    if (l - decimalLength <= posiciones){
      return x
    }
    // Parte decimal del número
    var isNeg  = x < 0
    var decimal =  x % 1
    var entera  = isNeg ? Math.ceil(x) : Math.floor(x)
    // Parte decimal como número entero
    // Ejemplo: parte decimal = 0.77
    // decimalFormated = 0.77 * (10^posiciones)
    // si posiciones es 2 ==> 0.77 * 100
    // si posiciones es 3 ==> 0.77 * 1000
    var decimalFormated = Math.floor(
      Math.abs(decimal) * Math.pow(10, posiciones)
    )
    // Sustraemos del número original la parte decimal
    // y le sumamos la parte decimal que hemos formateado
    var finalNum = entera + 
      ((decimalFormated / Math.pow(10, posiciones))*(isNeg ? -1 : 1))
    
    return finalNum
  }


//decimales 
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }


//Datemask dd/mm/yyyy
 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
 //Datemask2 mm/dd/yyyy
 $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
 //Money Euro
 $('[data-mask]').inputmask()


//datatable
$(function() {
    $("#user").DataTable({
        "order": [[ 1, "desc" ]],
        "responsive": true,
        "lengthChange": true,
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

//editar usuario
$(document).on("click",".btnEditarUsuario",function() {
    var idUsuario = $(this).attr('idUsuario');
    var info = $(this).attr('info');

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("info", info);

    $.ajax({
        url: "api/usuarios.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editarUsuario").val(respuesta['usuario'])
            $("#editarNombre").val(respuesta['nom_user'])
            $("#editarPerfil").html(respuesta['rol'])

            //informacion actual
            $("#editarPerfil").val(respuesta['rol'])
            $("#actualPassword").val(respuesta['password'])
        }
    })

})

// activar usuario
$(document).on("click",".btnActivar", function(){
    var idUsuario = $(this).attr('idUsuario');
    var estadoUsuario = $(this).attr('estadoUsuario');

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url: "api/usuarios.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
           if(window.matchMedia("(max-width:767px)").matches){
               swal({
                   title:"El usuario ha sido actualizado",
                   type:"success",
                   confirmButtonText:"!Cerrar¡"
               }).then(function(result){
                   if(result.value){
                       window.location ="usuario"
                   }
               })
           }
        }
    })

    if(estadoUsuario == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('1');
    }else{
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('0');
    }
})

//validar el usuario para agregar
$("#nuevoUsuario").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();
    var info = $("#info").val();

    var datos = new FormData();
    datos.append("validarUsuario", usuario);
    datos.append("info", info);

    $.ajax({
        url:"api/usuarios.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
           if(respuesta){
               $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe</div>');
               $("#nuevoUsuario").val("");
           }
        }
    })

})

$(document).on("click",".btnEliminarUsuario",function(){

    var idUsuario = $(this).attr("idUsuario");
    swal({
        title:'¿Estas seguro de borrar el usuario?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar usuario!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=usuario&idUsuario="+idUsuario;
        }
    })
})





//Editar Monedas

$(document).on("click",".btnEditarMoneda",function() {
    var idMoneda = $(this).attr('idMoneda');
    var info = $(this).attr('info');
    var datos = new FormData();
    datos.append("idMoneda", idMoneda);
    datos.append("info", info);

    $.ajax({
        url: "api/monedas.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
       
            $("#editarMoneda").val(respuesta['moneda'])
             $("#editarSimbolo").val(respuesta['simbolo'])
             $("#editarPais").val(respuesta['pais'])
             $("#editarIso").val(respuesta['iso'])
             $("#editarIdMoneda").val(respuesta['id'])

           
        }
    })

})


//Eliminar Moneda

$(document).on("click",".btnEliminarMoneda",function(){

    var idMoneda = $(this).attr("idMoneda");
    var info = $(this).attr("info");
    swal({
        title:'¿Estas seguro de borrar la moneda?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la moneda!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=moneda&idMoneda="+idMoneda+"&info="+info;
        }
    })
})

//Validar Moneda
//validar el usuario para agregar
$("#nuevoMoneda").change(function(){

    $(".alert").remove();
    var moneda = $(this).val();
    var info = $("#info").val();

    var datos = new FormData();
    datos.append("validarMoneda", moneda);
    datos.append("info", info);

    $.ajax({
        url:"api/monedas.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
           if(respuesta){
           
               $("#nuevoMoneda").parent().after('<div class="alert alert-warning">Esta moneda ya existe</div>');
               $("#nuevoMoneda").val("");
           }
        }
    })

})




//Editar bancos de venezuela

$(document).on("click",".btnEditarBancoVene",function() {
    var idBancoVene = $(this).attr('idBancoVene');

    var datos = new FormData();
    datos.append("idBancoVene", idBancoVene);

    $.ajax({
        url: "api/banco-vene.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
       
            $("#editarBancoVene").val(respuesta['nombre'])
             $("#editarCodigo").val(respuesta['codigo'])
             $("#editarId").val(respuesta['id'])
           
        }
    })
 

})




//Eliminar banco venezuela

$(document).on("click",".btnEliminarBancoVene",function(){

    var idBancoVene = $(this).attr("idBancoVene");
    swal({
        title:'¿Estas seguro de borrar el banco?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la moneda!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=banco-venezuela&idBancoVene="+idBancoVene;
        }
    })
})



//Editar bancos 

$(document).on("click",".btnEditarBancoInter",function() {
    var idBancoInter = $(this).attr('idBancoInter');
    var info = $(this).attr('info');

    var datos = new FormData();
    datos.append("idBancoInter", idBancoInter);
    datos.append("info", info);

    $.ajax({
        url: "api/banco-inter.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
     
            $("#editarBancoInter").val(respuesta['nombre'])
             $("#editarIdBancoInter").val(respuesta['id'])
           
        }
    })
 

})




//Eliminar banco 

$(document).on("click",".btnEliminarBancoInter",function(){

    var idBancoInter = $(this).attr("idBancoInter");
    var info = $(this).attr("info");
    swal({
        title:'¿Estas seguro de borrar el banco?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la moneda!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=banco&idBancoInter="+idBancoInter+"&info="+info;
        }
    })
})









//Editar Tasa

$(document).on("click",".btnEditarTasa",function() {
    var idTasa = $(this).attr('idTasa');
    const info = $(this).attr('info');
    console.log(info)
    var datos = new FormData();
    datos.append("idTasa", idTasa);
    datos.append("info", info);
  
    
    $.ajax({
        url: "api/tasa.api.php",
        method: "POST",
        data: datos,
        async:true,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
    
            $("#editarPaisTasa").val(respuesta['pais'])
            $("#editarMoneda").val(respuesta['id_moneda'])
            $("#editartasaCambio").val(respuesta['tasa_c'])
            $("#editarIdTasa").val(respuesta['id'])
            $("#editarmonedaTasa").val(respuesta['id_tasa'])
           
        }
    })
 

})


//Eliminar Tasa

$(document).on("click",".btnEliminarTasa",function(){

    var idTasa = $(this).attr("idTasa");
    var info = $(this).attr("info");
    swal({
        title:'¿Estas seguro de borrar la tasa?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar la tasa!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=tasa&idTasa="+idTasa+"&info="+info;
        }
    })
})




//Editar Cliente

$(document).on("click",".btnEditarCliente",function() {
    var idCliente = $(this).attr('idCliente');
    var data = $(this).attr('info');

    var datos = new FormData();
    datos.append("idCliente", idCliente);
    datos.append("data", data);
    
    $.ajax({
        url: "api/clientes.api.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
           
            $("#editarTipoDocumento").val(respuesta['tipo_doc'])
            $("#editarNombrecliente").val(respuesta['nombres'])
            $("#editarApellidocliente").val(respuesta['apellidos'])
            $("#editarnumeroDocumento").val(respuesta['documento'])
            $("#editartelefonoCliente").val(respuesta['telefono'])
            $("#editarpaisCliente").val(respuesta['pais'])
            $("#editarIdCliente").val(respuesta['id'])
           
        }
    })
 
})


//Eliminar Cliente

$(document).on("click",".btnEliminarCliente",function(){

    var idCliente = $(this).attr("idCliente");
    var data = $(this).attr('info');
    swal({
        title:'¿Estas seguro de borrar el cliente?',
        text:'¡Si no estas seguro puedes cancelar la acción!',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonText:'¡Si, borrar el cliente!',
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=clientes&idCliente="+idCliente+'&info='+data;
        }
    })
})


  
//datatable
$(function() {
    $("#cliente").DataTable({
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