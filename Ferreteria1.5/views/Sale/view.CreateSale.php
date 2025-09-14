<div class="card">
    <div class="card-header">
        <h4>Registro de ventas</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_Sale" method="POST" autocomplete="off" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-1">
                                <label for="nit_costumer">Nit:</label>
                            </div>
                            <div class="col-2">
                               <input type="text" class="form-control"  id="nit_costumer" name="nit_costumer" readonly>
                            </div>
                            <div class="col-1">
                                <label for="name_customer">Nombres:</label>
                            </div>
                            <div class="col-3">
                               <input type="text" class="form-control" id="name_customer" name="name_customer" readonly>
                            </div>
                            <div class="col-1">
                                <label for="lastName_customer">Apellidos:</label>
                            </div>
                            <div class="col-3">
                               <input type="text" class="form-control" id="lastName_customer" name="lastName_customer" readonly>
                            </div>
                            <div class="col-1">
                                <button type="button" id="searchCustomer" name="searchCustomer" class="btn btn-primary form-control"><i class="fas fa-search"></i></button>  
                            </div>
                        </div>
                        <div class="row pt-1">
                             <div class="col-sm-1">
                                <label for="phone_customer">Telefono:</label>
                            </div>
                            <div class="col-sm-2">
                               <input type="text" class="form-control" id="phone_customer" name="phone_customer" readonly>
                            </div>
                             <div class="col-sm-1">
                                <label for="addres_customer">Direccion:</label>
                            </div>
                            <div class="col-sm-3">
                               <input type="text" class="form-control" id="addres_customer" name="addres_customer" readonly>
                            </div>
                             <div class="col-sm-1">
                                <label for="email">Correo:</label>
                            </div>
                            <div class="col-sm-3">
                               <input type="text" class="form-control" id="email" name="email" readonly>
                            </div>
                        </div>
                        <div class="mt-4 form-group row">
                            <div class="col-sm-2">
                                <label for="">Producto:</label>
                            </div>
                            <div class="col-sm-6">
                                <select name="product[]" id="selectProduct" class="select2 form-control"> </select>
                            </div>
                            <div class="col-sm-1">
                                <label for="amount">Cantidad</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class=" form-control" id="amount" name="amount" required>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="listProduct" name="listProduct" class="btn btn-primary form-control"><i class="fas fa-arrow-circle-left"></i></button>
                            </div>
                            <input type="hidden" name="saleSubTotal" id="saleSubTotal" >

                            <input type="hidden" name="saleTotal" id="saleTotal" >
                        </div>
                    </div>
                </div>
                <!-- ----------/       TABLE ADD PRODUCT     / --------------- -->
                <div class="justify-content-center border-top pt-3 row">
                    <div class="col-6">
                        <table id="tableAddProduct" name="tableAddProduct" class="table-bordered table-hover" width="100%">
                            <thead class="table text-white bg-primary thead-primary">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th> 
                                    <th>Valor Unitario</th> 
                                    <th>Importe</th> 
                                    <th>Borrar</th>  
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                            <tr>
                                <td id="subtotal" colspan="4"></td>
                                <td id="subtotalSale" name="subtotalSale" colspan="2"></td> 
                            </tr>
                            <tr id="registerSale" style="display: none;" align="center">
                                <td id="total" colspan="4"></td>
                                <td id="totalSale" name = "totalSale"></td> 
                                <td i  ><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button></td> 
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- ------------------------------------------------------- -->
            </div>
       
        </form>
   
    </div>
</div>
    
<style>
div.dataTables_wrapper {
		margin: 0 auto;
		width: 100%;
	}
</style>


<!--/ MODAL VALIDATE COSTUMER  / -->
<div class="modal fade" id="validateCostumerModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="container-fluid">

        <div class="modal-content">

			<div class="text-center modal-header">
				<h3 class="w-100 modal-title">Cliente</h3>
				<button type="button" class="close" data-dismiss="modal" title="Cerrar">
					<i class="fa fa-window-close fa-2x text-danger"></i>
				</button>
			</div>

			<div class="modal-body">
                <form id="form_ValidateCostumer" action="">
                    <div class="row pt-1">
                        <div class="col-sm-1">
                            <label for="idCostumer">Cedula:</label>
                        </div>
                        <div class="col-sm-6"><input type="text" class="form-control" placeholder="Ingrese su cedula" id="idCustomer" name="idCustomer"></div>
                        <div class="col-sm-4"><button type="submit" class="btn btn-primary" placeholder="Ingrese su cedula" name="idCostumer">
                        <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
</div>

<script>  
$(document).ready(function () {
    //============SHOW MODAL VALIDATE COSTUMER=============//
    "use strict";
    $(function validateCostumerShow(){
        $("#validateCostumerModal").modal("show");
    });
    // ----------------------------------------------------//
    $(function validateCostumer(){
        $("#searchCustomer").on("click", function (event) {
            $("#validateCostumerModal").modal("show");

         });
    });
     //=================================MODAL SHARE CUSTOMER==============================//
    //==========================Es para poner los datos en el select2====================//
    $(function selectProduct() {

        $.ajax({
            url: "../../app/lib/ajax.php",
            method: "post",
            data: { modulo: "Sale", controlador: "Sale", funcion: "selectProduct"},
            drawCallback: () => { tableAddProduct.columns.adjust(); },
        }).done((res) => {
            $("#selectProduct").html(res);
        });
    });
    //===============================================================================//
     //******************************** ADD *TABLE* PRODUCT********************//
     $(function tableAddProduct() {
            
            var tableAddProduct = $("#tableAddProduct").DataTable({
                
                language: {
                    "url": "../../assets/vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
                },
                autoWidth: false,
                destroy: true,
                info: false,
                searching: false,
                bPaginate: false,
                pageLength: 10,
                lengthChange: false,
                columnDefs: [{ "className": "text-center",  "targets": "_all",},{"orderable": false, "targets": "_all", }],
                initComplete: () => {
                    var addProduct =  $(document).on("click", "#listProduct", function () {
                             if($("#nit_costumer").val()!=""){
                        let price = JSON.parse($("#selectProduct option:selected").attr("data"));

                        var product = $('#selectProduct option:selected').text(),
                            amount = $('#amount').val(),
                            code = $('#selectProduct option:selected').val(), 
                            importe = ((price)*amount),
                            totalProduct = importe;
                            if($("#subtotalSale").text() != ""){ totalProduct = importe + parseFloat($("#subtotalSale").text())} 

                            if(product!="" && amount!="" ){



                                    var error = false;
                                    $('input[name="code[]"]').each(function () {
                                        if ($(this).val() == code) {
                                            swal({
                                                type: 'warning',
                                                confirmButtonColor: "#428BCA",
                                                title: 'Ya se encuentra agregado este Producto',
                                            });
                                            error = true;
                                        }
                                    });
                                    if (error == false) {
                                        tableAddProduct.row.add([
                                                '<input type="text" name="code[]" class="text-center form-control" value="' +code+ '" readonly>',
                                                '<input type="text" name="product[]" class="text-center form-control" value="' +product+ '" readonly>',
                                                '<input type="text" name="amount[]" class="text-center form-control" value="' +amount+ '" readonly>',
                                                '<input type="text" name="price[]" class="text-center form-control" value="' +price+ '" readonly>',
                                                importe,
                                                '<button type="button" id="ver" class="btn btn-danger"><i class="fas fa-minus"></button>',
                                        ]).draw();
                                        var saleTotal=(totalProduct*(0.19))+totalProduct;   
                                        $("#subtotal").text("Subtotal");
                                        $("#subtotalSale").text(totalProduct);
                                        $("#total").text("total");
                                        $("#totalSale").text(saleTotal);
                                        $("#registerSale").show(500);
                                        $("#saleSubTotal").val(totalProduct);
                                        $("#saleTotal").val(saleTotal);
                                    }else{
                                        return false;
                                    };
                            }else{
                                swal({
                                    type: 'warning',
                                    confirmButtonColor: "#428BCA",
                                    title: 'Ingrese el producto o la cantidad',
                                });
                            }
                        } else {  
                            swal({
                                type: 'warning',
                                confirmButtonColor: "#428BCA",
                                title: 'Agregar datos cliente',
                            });
                        }
                    });
                    
                    
                    var deleteProduct = $(document).on("click", "#tableAddProduct button", function () {
                         var totalProduct = $("#subtotalSale").text();
                        //tomar valor de una columna de la que se va a borrar
                        var lessPrice = $(this).parents("tr").find("td").eq(4).text();
                        $("#subtotalSale").text(totalProduct-lessPrice);
                        $("#saleSubTotal").val($("#subtotalSale").text());

                        var saleTotal=  parseFloat($("#subtotalSale").text());   
                        $("#totalSale").text((saleTotal*(0.19))+saleTotal);

                        $("#saleTotal").val($("#totalSale").text());

                        var row = $("#tableAddProduct").DataTable().row($(this).parents("tr"));
                        $("#tableAddProduct").DataTable().row(row).remove().draw();
                    });	
                    //==============SAVE SALE====================//

                    $("#form_Sale").on("submit", function (event) { 
                        event.preventDefault();

                        var formData = new FormData(event.target);
                        formData.append("modulo", "Sale");
                        formData.append("controlador", "Sale");
                        formData.append("funcion", "createSale");
                            
                        $.ajax({
                                    
                            url: "../../app/lib/ajax.php",
                            method: "POST",
                            dataType: "json",
                            data:  formData,
                            cache: false,
                            contentType: false,
                            processData: false
                
                        }).done((res) => {
                            if (res.typeAnswer == true) {

                                swal({
                                    title: 'Factura guardada exitosamente',
                                    type: 'success',
                                });
                            }
                        });
                    });
                }
        }); 
       

    //==============VALIDATE COSTUMER====================//
        $("#form_ValidateCostumer").on("submit", function (event) { {
            event.preventDefault();

            if($("#idCustomer").val() != ""){
                $.ajax({
                    url: "../../app/lib/ajax.php",
                    method: "POST",
                    dataType: "json",
                    data: { 
                        modulo: "Sale",
                        controlador: "Sale",
                        funcion: "searchCustomer",
                        idCustomer: $("#idCustomer").val(),
                    },
        
                }).done((res) => {
                    if(res != ""){
                        $("#validateCostumerModal").modal('hide');//ocultamos el modal
                        // $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                        // $('.modal-backdrop').remove();
                        $("#nit_costumer").val(res.nit_costumer);
                        $("#name_customer").val(res.name_customer);
                        $("#lastName_customer").val(res.lastName_customer);
                        $("#phone_customer").val(res.phone_customer);
                        $("#addres_customer").val(res.address);
                        $("#email").val(res.email);
                    } else {
                        swal({
                            type: "warning",
                            title: "No existe usuario, por favor registrar"
                        });
                    }
                });
            } else {
				swal({
					type: "warning",
					title: "Por favor ingrese su cedula"
				});
			}

        };
        }); 
    });
    
});

//=====================ESTA FUNCION ES PARA MOSTRAR LOS DATOS DEL SELECT2 EN UNA TABLA SOLO SELECIONANDO ===========//
    // $(document).on("change", "#selectProduct", function () {
    //     // var select = $('#selectProduct option:selected').text()
    //     var select = $('#selectProduct option:selected').text(), amount = $('#amount').val() ;
    //     alert(select+" "+amount);
    //     if(select!="" && amount!="" ){
    //         var error = false;
    //         $('input[name="ingreso[]"]').each(function () {
    //             if ($(this).val() == select) {
    //                 swal({
    //                     type: 'warning',
    //                     confirmButtonColor: "#428BCA",
    //                     title: 'Ya se encuentra agregado este Producto',
    //                 });
    //                 error = true;
    //             }
    //         });
            
    //         if($(this).val()!="" && error==false){
                
    //             $("#tableAddProduct").DataTable().row.add([
                
    //             '<input type="text" name="ingreso[]" class="text-center form-control" value="' +select+ '" readonly>',
    //             '<input type="text" name="amount[]" class="text-center form-control" value="' +amount+ '" readonly>',
    //             '<button type="button" class="btn btn-danger fa fa-minus"></button>',
                
    //         ]).draw();
    //         }
    //     } else { 
    //         swal({   title: 'Ingrese el producto o la cantidad', type: 'warning',}); 
    //     }
       
        
    //     // var eliminarNoingreso = $(document).on("click", "#tablaAgregarIngreso button", function () {
    //     //     var row = $("#tablaAgregarIngreso").DataTable().row($(this).parents("tr"));
    //     //     $("#tablaAgregarIngreso").DataTable().row(row).remove().draw();
    //     // });		
    // });
    // ------------------------------------------------------------------------------//

	
</script>
