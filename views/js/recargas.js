
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
