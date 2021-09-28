
 // Combobox Banco

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
 