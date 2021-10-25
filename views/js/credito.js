$(document).off("click", ".idPagos").on("click", ".btnCreditos",function () {
   
    const idCredito = $(this).attr('idCreditos')
  
    const data = new FormData();
        data.append('idPagos', idCredito)


    $.ajax({
        url:'api/pagos-pendientes.api.php',
        method:'POST',
        data:data,
        async:true,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success: function (respuesta) {
          
            $('#correlativo').html(respuesta.correlativo);
            $('#id_remesa').val(respuesta.remesas_id);
            $('#abonadototal').val(Math.round10(respuesta.total_envio,-3) - Math.round10(respuesta.abonado,-3) );
            $('#clienteC').html(`<h2 class="saldo" style="font-size: 30px;" id="saldo">${respuesta.nombres} ${respuesta.apellidos}</h2>`)
            $('#deuda').html(`<div class="row">
            <div class="col-md-6"> <strong style="font-size:20px;color:red;"><i class="fas fa-money-bill-alt"></i> Saldo pendiete</strong>
            <div><h2 style="font-size: 30px;">${respuesta.simbolo_moneda}${Math.round10(respuesta.total_envio,-3)} (${respuesta.iso_moneda})</h2></div></div>
           
            <div class="col-md-6">
            <strong style="font-size:20px;color:green;"><i class="fas fa-money-bill-alt"></i> Saldo abonado</strong>
            <div><h2 style="font-size: 30px;">${respuesta.simbolo_moneda}${Math.round10(respuesta.abonado,-3)} (${respuesta.iso_moneda})</h2></div></div>
            </div>
            `)


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
                if (respuesta.iso_moneda == 'VEN') {
                    var tipoBanco3='vene'
                }else{
                    var tipoBanco3='inter'
                }
                $('#tipoBancoEntrada').val(tipoBanco3)
                  ///////////////////////////////
                          // metodo de pago en efectivo//
                          //////////////////////////////
                          $(document).off('click','#m-efectivoC').on('click','#m-efectivoC',function(){
                        
                           $('.cont-credi').remove()
                           $('.contenedor-texto').empty()
                           $('.contenedor-texto').append(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
                           const claseEfec = $('.cont-efecC')
                           if (claseEfec.length <= 0) {
                               $('.off-deposito-credito').append(`
                               <div class="form-group row cont-efecC off-meto" style="border-bottom:1px solid #C1C1C1">
                               <div class="m-3">
                               <a href="" class="btn btn-danger btn-lg eliminarCuentaEfectivo"><i class="fas fa-trash-alt"></i></a>
                               </div>
                               
                               <div class="col-md-4">
                               <label for="exampleInputEmail1">Monto en efectivo</label>
                               <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">${respuesta.simbolo_moneda}</span>
                               </div>
                               <input type="number" class="form-control monto" step="any"  name="monto" placeholder="ingregar el monto" >
                               <input type="hidden" class="form-control BancoDeposito" name="BancoDeposito" value="null">
                               <input type="hidden" class="form-control metodoPago" name="metodoPago" value="Efectivo">
                               <input type="hidden" class="form-control nOperacion" name="nOperacion" value="null">
                               <input type="hidden"  name="id_remesa" class="id_remesa" value="${respuesta.remesas_id}">
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
                                   $('.formularioCredito').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                                   
                                    
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
                      
                          $(document).off('click','#m-dtC').on('click','#m-dtC',function(){
                           
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
                          
                            $('.off-deposito-credito').append(`
                            <div class="form-group row cont-depo off-meto" style="border-bottom:1px solid #C1C1C1">
                            <div class="m-2 pt-2">
                            <a href="" class="btn btn-danger btn-lg eliminarCuentaDeposito"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            <div class="input-form col-md-4">
                            <label for="exampleInputEmail1">Bancos de transferencia</label>
                            <select class="form-control bancoselect BancoDeposito " name="BancoDeposito" required>
                                    
                            </select>
                        </div>
                        <div class="input-form col-md-2">
                            <label for="exampleInputEmail1">Metodo</label>
                            <select class="form-control metodoPago" name="metodoPago" required>
                                
                            </select>
                            </div>

                            <div class="form-group col-md-2 float-right">
                            <label for="exampleInputEmail1">N° de Trans.</label>
                            <div class="input-group ">
                                <input type="number"  name="nOperacion" class="form-control nOperacion" >
                            </div>
                            </div>
                            <div class="form-group col-md-3 float-right">
                            <label for="exampleInputEmail1">Monto</label>
                            <div class="input-group "> <div class="input-group-prepend">
                            <span class="input-group-text tipo-moneda">${respuesta.simbolo_moneda}</span>
                          </div>
                            <input type="number" step="any" name="monto" class="form-control monto" placeholder="ingregar el monto" >
                            <input type="hidden" name="id_remesa" class="id_remesa" value="${respuesta.remesas_id}">
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

                        $('.formularioCredito').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                          
                                          var bancosSelect=JSON.parse(listarMetodo())

                                     

                                        var busqueda = bancosSelect.reduce((acc, banco) => {
                                            acc[banco.banco] = ++acc[banco.banco] || 0;
                                            return acc;
                                            }, {});
                                            
                                            var duplicados = bancosSelect.filter( (banco) => {
                                                return busqueda[banco.banco];
                                            });

                                    
                                        if (duplicados.length > 0) {
                                            toastr.error('No puede seleccionar la misma cuenta de banco dos veces')
                                            $('.BancoDeposito option').each(function () {
                                                    this.selected = true;
                                                    return false;
                                            });
                                        }
                                
                                        
                                        const monto = sumarTotalMonto() + parseFloat(Number.parseFloat(respuesta.abonado).toFixed(6)) 
                                            const saldo = parseFloat(Number.parseFloat(respuesta.total_envio).toFixed(6)) 
                                   
                                        
                                            if (monto > saldo) {
                                                toastr.warning('Recuerde que el sistema toma en cuenta el saldo abonado más el actual')
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




        }
        })
    


                    
            
            $('.formularioCredito').off('submit').on('submit',function(e){


                e.preventDefault()
                const clasesMetodo = $('.off-meto')
                var abondoCompleto = $('#abonadototal').val() - sumarTotalMonto()
                var abotonoregistrado = sumarTotalMonto()
                //datos de ingreso 
                var datos = new FormData()
                datos.append('metodo',listarMetodo())
                datos.append('tipoBancoEntrada',$('#tipoBancoEntrada').val())
                datos.append('abonocompleto',abondoCompleto)
                datos.append('id_remesa', $('#id_remesa').val())
                
                if (clasesMetodo.length <= 0) {
                    toastr.warning('Debe agregar un metodo de pago')
                }else{
                    if (abondoCompleto >= 0) {
                        $.ajax({
                            url:'api/creditoabono.api.php',
                            data:datos,
                            method:'POST',
                            async:true,
                            dataType:'json',
                            processData:false,
                            cache:false,
                            contentType:false,
                            success: function(res){
                  
                                if (res == 'ok') {
                                    swal({
                                        type: "success",
                                        title: (abondoCompleto ==0)?"¡Remesa Pagada!":"Abono registrado",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location ="creditos"
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
                    }else if($('.monto').val() == ''){
                        toastr.warning('Debe ingresar el monto')
                    }
                    else{
                        toastr.warning('Recuerde que el sistema toma en cuenta el saldo abonado más el actual')
                        toastr.error('El monto es incorrecto, supera la cantidad del saldo a cobrar')
                        $('.monto').val('')
                    }
                   



                }


                
            })


})















///////////////////////////////////////////////////////////
// creditos para boletos *////////////////////////////////
/////////////////////////////////////////////////////////

$(document).off("click", ".idBoleto").on("click", ".btnCreditosBoletos",function () {
   
    const idBoleto = $(this).attr('idBoleto')
   
    const data = new FormData();
        data.append('idCredito', idBoleto)


    $.ajax({
        url:'api/boletos-consulta.api.php',
        method:'POST',
        data:data,
        async:true,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success: function (respuesta) {
    

            $('#correlativo').html(respuesta.correlativo);
            $('#boleto_id').val(respuesta.boleto_id);
            $('#abonadototal').val(Math.round10(respuesta.restante,-3));
            $('#clienteC').html(`<h2 class="saldo" style="font-size: 30px;" id="saldo">${respuesta.cliente}</h2>`)
            $('#deuda').html(`<div class="row">
            <div class="col-md-6"> <strong style="font-size:20px;color:red;"><i class="fas fa-money-bill-alt"></i> Saldo pendiete</strong>
            <div><h2 style="font-size: 30px;">${respuesta.simbolo}${Math.round10(respuesta.restante,-3)} (${respuesta.iso})</h2></div></div>
           
            <div class="col-md-6">
            <strong style="font-size:20px;color:green;"><i class="fas fa-money-bill-alt"></i> Saldo abonado</strong>
            <div><h2 style="font-size: 30px;">${respuesta.simbolo}${Math.round10(respuesta.abonado,-3)} (${respuesta.iso})</h2></div></div>
            </div>
            `)


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
                if (respuesta.iso == 'VEN') {
                    var tipoBanco3='vene'
                }else{
                    var tipoBanco3='inter'
                }
                $('#tipoBancoEntrada').val(tipoBanco3)
                  ///////////////////////////////
                          // metodo de pago en efectivo//
                          //////////////////////////////
                          $(document).off('click','#m-efectivoC').on('click','#m-efectivoC',function(){
                        
                           $('.cont-credi').remove()
                           $('.contenedor-texto').empty()
                           $('.contenedor-texto').append(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
                           const claseEfec = $('.cont-efecC')
                           if (claseEfec.length <= 0) {
                               $('.off-deposito-credito').append(`
                               <div class="form-group row cont-efecC off-meto" style="border-bottom:1px solid #C1C1C1">
                               <div class="m-3">
                               <a href="" class="btn btn-danger btn-lg eliminarCuentaEfectivo"><i class="fas fa-trash-alt"></i></a>
                               </div>
                               
                               <div class="col-md-4">
                               <label for="exampleInputEmail1">Monto en efectivo</label>
                               <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">${respuesta.simbolo}</span>
                               </div>
                               <input type="number" class="form-control monto" step="any"  name="monto" placeholder="ingregar el monto" >
                               <input type="hidden" class="form-control BancoDeposito" name="BancoDeposito" value="null">
                               <input type="hidden" class="form-control metodoPago" name="metodoPago" value="Efectivo">
                               <input type="hidden" class="form-control nOperacion" name="nOperacion" value="null">
                               <input type="hidden"  name="id_remesa" class="id_remesa" value="${respuesta.boleto_id}">
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
                                   $('.formularioCreditoBoleto').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                                  
                                    
                                    const monto =parseFloat(sumarTotalMonto()) 
                                       const saldo = Number.parseFloat(respuesta.restante)
                                   
                                     
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
                      
                          $(document).off('click','#m-dtC').on('click','#m-dtC',function(){
                           
                            if (respuesta.iso == 'VEN') {
                                var tipoBanco2='vene'
                            }else{
                                var tipoBanco2='inter'
                            }
                    
                            $('.cont-credi').remove()
                            $('.contenedor-texto').empty()
                            $('.contenedor-texto').append(` <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>`)
                            $('.BancoDeposito').empty()
                            $('.metodoPago').empty()
                          
                            $('.off-deposito-credito').append(`
                            <div class="form-group row cont-depo off-meto" style="border-bottom:1px solid #C1C1C1">
                            <div class="m-2 pt-2">
                            <a href="" class="btn btn-danger btn-lg eliminarCuentaDeposito"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            <div class="input-form col-md-4">
                            <label for="exampleInputEmail1">Bancos de transferencia</label>
                            <select class="form-control bancoselect BancoDeposito " name="BancoDeposito" required>
                                    
                            </select>
                        </div>
                        <div class="input-form col-md-2">
                            <label for="exampleInputEmail1">Metodo</label>
                            <select class="form-control metodoPago" name="metodoPago" required>
                                
                            </select>
                            </div>

                            <div class="form-group col-md-2 float-right">
                            <label for="exampleInputEmail1">N° de Trans.</label>
                            <div class="input-group ">
                                <input type="number"  name="nOperacion" class="form-control nOperacion" >
                            </div>
                            </div>
                            <div class="form-group col-md-3 float-right">
                            <label for="exampleInputEmail1">Monto</label>
                            <div class="input-group "> <div class="input-group-prepend">
                            <span class="input-group-text tipo-moneda">${respuesta.simbolo}</span>
                          </div>
                            <input type="number" step="any" name="monto" class="form-control monto" placeholder="ingregar el monto" >
                            <input type="hidden" name="id_remesa" class="id_remesa" value="${respuesta.boleto_id}">
                            <input type="hidden" name="tipoBanco" class="tipoBanco" value="${tipoBanco2}">
                            </div>
                            </div>
                            </div>
                            `)
                            $('.BancoDeposito').append(`<option value="" selected>--- seleccionar un banco ---</option>`)
                            $('.metodoPago').append(`<option value="" selected>--- seleccionar un metodo de pago ---</option>`)


                        //  metodo pago pago end //
                         $.each(res,function (i, item) {
                        
                             if (respuesta.iso == res[i].iso) {
                                
                                 $('.BancoDeposito').append(`<option value="${res[i].id_cuenta}">${res[i].n_titular} ${res[i].a_titular} - ${res[i].nombre}: ${res[i].simbolo}${res[i].saldo} (${res[i].iso})</option>`)
                             }
                         })
                                $('.eliminarCuentaDeposito').on('click',function(e){
                                    
                                    e.preventDefault()
                                  $(this).parent().parent().remove()
                                    })

                         $('.metodoPago').append(`<option value="transferecia">Transferencia</option><option value="deposito">Deposito</option>`);

                        $('.formularioCreditoBoleto').off('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto').on('change', '.BancoDeposito , .metodoPago, .nOperacion ,.monto', function(){
                          
                                          var bancosSelect=JSON.parse(listarMetodo())

                                     

                                        var busqueda = bancosSelect.reduce((acc, banco) => {
                                            acc[banco.banco] = ++acc[banco.banco] || 0;
                                            return acc;
                                            }, {});
                                            
                                            var duplicados = bancosSelect.filter( (banco) => {
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
                                            const saldo = Number.parseFloat(respuesta.restante)
                                    
                                        
                                            if (monto > saldo) {
                                                toastr.warning('Recuerde que el sistema toma en cuenta el saldo abonado más el actual')
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




        }
        })
    


                    
            
            $('.formularioCreditoBoleto').off('submit').on('submit',function(e){


                e.preventDefault()
                const clasesMetodo = $('.off-meto')
    
                
                if (clasesMetodo.length <= 0) {
                    toastr.warning('Debe agregar un metodo de pago')
                }else{

                                var abondoCompleto = $('#abonadototal').val() - sumarTotalMonto()
                            var abotonoregistrado = sumarTotalMonto()
                            
                            const valor = [{
                                'metodo':listarMetodo(),
                                'tipoBancoEntrada':$('#tipoBancoEntrada').val(),
                                'abonocompleto':abondoCompleto,
                                'boleto_id':$('#boleto_id').val()
                            }]
                            // datos de ingreso 
                            var data = new FormData()

                             data.append('datos',JSON.stringify(valor))
      
                    if (abondoCompleto >= 0) {
                        $.ajax({
                            url:'api/creditoabono.api.php',
                            data:data,
                            method:'POST',
                            async:true,
                            dataType:'json',
                            processData:false,
                            cache:false,
                            contentType:false,
                            success: function(res){
                  
                                // console.log(JSON.parse(res))
                                if (res == 'ok') {
                                    swal({
                                        type: "success",
                                        title: (abondoCompleto ==0)?"Boleto Pagado!":"Abono registrado",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location ="credito-boleto"
                                            // $("#credito-boleto").DataTable().destroy()
                                            // $('#modal-credito').modal('hide')
                                            // $("#credito-boleto").DataTable()
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
                    }else if($('.monto').val() == ''){
                        toastr.warning('Debe ingresar el monto')
                    }
                    else{
                        toastr.warning('Recuerde que el sistema toma en cuenta el saldo abonado más el actual')
                        toastr.error('El monto es incorrecto, supera la cantidad del saldo a cobrar')
                        $('.monto').val('')
                    }
                   



                }


                
            })


})
