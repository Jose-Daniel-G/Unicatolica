<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Reporte Cotizaciones</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="frm_ReporteCotizacion" autocomplete="off" action="<?=getUrl("Reportes", "Reportes", "listarReporteCotizacion", false, "ajax");  ?>">

            <div class="container-fluid">
    
                <div class="pt-3 pb-3 align-items-center row">

                    <div class="col-12">

                        <div class="row">

                            <div class="col-5">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="nit">Sede</label>
                                    </div>
                                    <div class="col-8">
                                        <select name="sedeReporte" id="nit_sede" data-campo="#nit_empresa" class="form-control" 
                                        data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax");?>">
                                            <option value="">Seleccione ...</option>
                                            <?php if ($usua_perfil == 1): ?>
                                            <?php foreach ($sedes as $sede): ?>
                                                <option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
                                            <?php endforeach;?>
                                            <?php else: ?>
                                            <input type="hidden" name="sedeReporte" value="<?=$nit_Empresa_sede;?>">
                                            <?php endif;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="px-3 py-2 btn btn-primary" id="btnBuscarCliente" title="Buscar">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>

                                        <div class="col-6">
                                            <button type="reset" class="px-3 py-2 btn btn-primary" id="btnNuevaBusqueda" title="Nueva búsqueda">
                                                <i class="fa fa-file"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-10">
                                <div class="pt-3 pb-3 row">
                                    <div class="col-1">
                                        <label for="nit_cliente">Cliente</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="nit_cliente" id="nit_empresa" class="form-control select2">
                                            <option value="">Seleccione ...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label label="fecha_desde">Desde</label>
                                            </div>

                                            <div class="col-9">
                                                <div class="input-group-prepend">
                                                    <input type="text" name="fecha_desde" id="fecha_desde" class="form-control text-center datepicker" placeholder="aaaa-mm-dd"
                                                        readonly>
                                                    <div class="d-flex align-items-center ml-1" style="color: #337ab7; cursor: pointer;">
                                                        <i class="fa fa-window-close fa-2x removeDatepicker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label label="fecha_hasta">Hasta</label>
                                            </div>

                                            <div class="col-9">
                                                <div class="input-group-prepend">
                                                    <input type="text" name="fecha_hasta" id="fecha_hasta" class="form-control text-center datepicker fechaAutocompletar"
                                                        placeholder="aaaa-mm-dd" readonly>
                                                    <div class="d-flex align-items-center ml-1" style="color: #337ab7; cursor: pointer;">
                                                        <i class="fa fa-window-close fa-2x removeDatepicker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="proceso">Proceso</label>
                                            </div>
                                            <div class="col-8">
                                                <select name="proceso" id="proceso" class="form-control">
                                                    <option value="">Seleccione ...</option>
                                                    <option value="A">Aprobadas</option>
                                                    <option value="NA">Sin Aprobar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="estado">Estado</label>
                                            </div>
                                            <div class="col-8">
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="">Seleccione ...</option>
                                                    <option value="A">Solo Activas</option>
                                                    <option value="I">Solo Anuladas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="pt-3 row">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-1">
                                        <label for="vendedorReporte">Vendedor</label>
                                    </div>

                                    <div class="col-5">
                                        <select class="form-control select2" id="vendedor" name="vendedorReporte" 
                                        data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax"); ?>">
                                            <option value="">Seleccione ...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
    
    			</div>

            </div>
        </form>
    </div>

    <div class="container-fluid">
        <div class="pt-4 pb-4 nuevaBusqueda" id="containerTablaReporteCotizacion" style="display: none;">
            <table id="tablaReporteCotizacion" class="table-bordered table-hover" width="100%;">

                <thead class="table text-white bg-primary thead-primary">
                    <tr>
                        <th>N° de Documento</th>
                        <th>Fecha Documento</th>
                        <th>Cliente</th>
                        <th>N° de Ingreso</th>
                        <th>Equipo</th>
                        <th>Potencia</th>
                        <th>Velocidad</th>
                        <th>Voltaje</th>
                        <th>Subtotal</th>
                        <th>Iva</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Vendedor</th>
                        <th>Outsourcing</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>
    </div>
    
</div>

<!-- Modal Sumatoria -->
<div class="modal fade" id="modalSumatoriaCotizaciones" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <label class="header-blue">Sumatoria (Subtotal, Iva, Total)</label>

                            <div class="col-12">
                                <div class="pt-2 pb-2 row">
                                    <div class="col-3">
                                        <label for="sumSubtotal">Subtotal</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="sumSubtotal" id="sumSubtotal" class="form-control text-center format" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="border-top pt-2 pb-2 row">
                                    <div class="col-3">
                                        <label for="sumIva">Iva</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="sumIva" id="sumIva" class="form-control text-center format" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="border-top pt-2 pb-2 row">
                                    <div class="col-3">
                                        <label for="sumTotal">Total</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="sumTotal" id="sumTotal" class="form-control text-center format" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- Fin Modal Sumatoria -->


<!-- Modal No Aprobación CT -->
<div class="modal fade" id="modalNoAprobacionCT" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

               <form id="formNoAprobacionCT" method="post" action="<?=getUrl("Reportes", "Reportes", "procesoNoAprobacionCT", false, "ajax"); ?>" autocomplete="off">
                
                    <input type="hidden" name="numero_cotizacion" id="numero_cotizacion">

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <label class="header-blue">Proceso de No Aprobación (CT)</label>
    
                                <div class="col-12">
                                    <div class="pt-2 pb-2 row">
                                        <div class="col-3">
                                            <label for="DescripcionNoAutorizada">Descripción&nbsp;No&nbsp;Autorizada</label>
                                        </div>
                                        <div class="col-9">
                                            <textarea name="DescripcionNoAutorizada" id="DescripcionNoAutorizada" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" title="Grabar Proceso">
                            <i class="fa fa-save"></i>
                        </button>
                        <button type="button" class="btn btn-danger" id="cerrarModalProcesoCT" title="Cerrar">Cerrar</button>
                    </div>
               </form>

        </div>
    </div>
</div>
<!-- Fin Modal No Aprobación CT -->

<script>
$(document).ready(function (){
    
    $("#fecha_desde").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: "1940:2040",
        showMonthAfterYear: true,
        onSelect: function (dateText) {
            var fecha1 = dateText.split("-");
            var ano = fecha1[0];
            var mes = fecha1[1];
            var dia = fecha1[2];

            var ultimoDia = new Date(ano, mes, 0).getDate();
            var fecha2 = ano + "-" + mes + "-" + ultimoDia;

            if (dia == "01" || dia == "15") {
                $(".fechaAutocompletar").val(fecha2);
            }
        }
    });

    $(document).on("submit", "#frm_ReporteCotizacion", function (event) {

        event.preventDefault();

        if ($("select[name=sedeReporte]").val() || $("select[name=nit_cliente]").val() || $("input[name=fecha_desde]").val() && $("input[name=fecha_hasta]").val() || 
            $("select[name=proceso]").val() || $("select[name=estado]").val() || $("select[name=vendedorReporte]").val()) {
            $("#containerTablaReporteCotizacion").show();

            var sumSubtotal = 0,
                sumIva = 0,
                sumTotal = 0;

            var tablaReporteCotizacion = $("#tablaReporteCotizacion").DataTable({
                language: {
                    "url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
                },
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "excelHtml5",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                        },
                        text: '<i class="fa fa-file-excel"></i>',
                        titleAttr: "Exportar a Excel",
                        className: "bg-success mr-4",
                        filename: "Reporte Cotizaciones",
                        sheetName: "Reporte Cotizaciones"
                    },
                    {
                        text: '<i class="fa fa-sigma"></i>',
                        titleAttr: "Sumatoria",
                        action: function () {
                            $("#modalSumatoriaCotizaciones").modal();
                        }
                    }
                ],
                destroy: true,
                order: [[ 1, "desc" ]],
                pageLength: 10,
                autoWidth: false,
                lengthChange: false,
                columnDefs: [
                    {"className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 11, 12, 13, 14]},
                    { "className": "text-center sumSubtotal", "targets": [8] },
                    { "className": "text-center sumIva", "targets": [9] },
                    { "className": "text-center sumTotal", "targets": [10] },
                ],
                drawCallback: () => {
                    tablaReporteCotizacion.columns.adjust();
                },
                createdRow: (row, data, dataIndex) =>{

                    if (data.CotizacionAutorizada == "N") {
                        $(row).addClass("bg-yellow");
                    }
                    
                    $("td.sumSubtotal", row).each(function () {
                        sumSubtotal += numeral($(this).html()).value();
                    });
                    $("td.sumIva", row).each(function () {
                        sumIva += numeral($(this).html()).value();
                    });
                    $("td.sumTotal", row).each(function () {
                        sumTotal += numeral($(this).html()).value();
                    });

                    $("#sumSubtotal").val(numeral(sumSubtotal).format("0,0"));
                    $("#sumIva").val(numeral(sumIva).format("0,0"));
                    $("#sumTotal").val(numeral(sumTotal).format("0,0"));
                },
                ajax: {
                    url: $(this).prop("action"),
                    method: $(this).prop("method"),
                    data: {
                        "fecha_desde": $("input[name=fecha_desde]").val(),
                        "fecha_hasta": $("input[name=fecha_hasta]").val(),
                        "nit_sede": $("select[name=sedeReporte]").val(),
                        "nit_empresa": $("select[name=nit_cliente]").val(),
                        "proceso": $("select[name=proceso]").val(),
                        "estado": $("select[name=estado]").val(),
                        "vendedor": $("select[name=vendedorReporte]").val(),
                    },
                },
                columns: [
                    {data: "numero_documento"},
                    {data: "fecha_documento"},
                    {data: "cliente"},
                    {data: "numero_ingreso"},
                    {data: "equipo"},
                    {data: "potencia"},
                    {data: "velocidad"},
                    {data: "voltaje"},
                    {data: "subtotal"},
                    {data: "iva"},
                    {data: "total"},
                    {data: "estado"},
                    {data: "vendedor"},
                    {data: "outsourcing"},
                    {data: "seleccionar"}
                ],
            });

            $(document).on("click", "#tablaReporteCotizacion input[type=checkbox]", function () {
                let data = $("#tablaReporteCotizacion").DataTable().row($(this).parents("tr")).data();
                $(this).closest("tr").addClass("bg-yellow");
                $("#numero_cotizacion").val(data.numero_documento);

                if ($(this).is(":checked")) {
                    $("#modalNoAprobacionCT").modal({
                        backdrop: "static",
                        keyboard: false
                    });
                }

                $("#modalNoAprobacionCT").on("hidden.bs.modal", function(){
                    $(this).find("textarea").val("");
                });

                $(document).on("click", "#cerrarModalProcesoCT", () => {
                    $(this).prop("checked", false);
                    $("#modalNoAprobacionCT").modal("hide");
                    if (data.CotizacionAutorizada == null) {
                        $(this).closest("tr").removeClass("bg-yellow");
                    }
                });
            });

            $(document).on("submit", "#formNoAprobacionCT", function (event) {
                
                event.preventDefault();

                $.ajax({
                    url: $(this).prop("action"),
                    method: $(this).prop("method"),
                    dataType: "json",
                    data: {
                        "Numero_Documento": $("input[name=numero_cotizacion]").val(),
                        "DescripcionNoAutorizada": $("textarea[name=DescripcionNoAutorizada]").val()
                    }
                }).done((res) => {
                    if (res.tipoRespuesta == true) {
                        swal({
                            type: "success",
                            title: "Registro Actualizado Con Éxito",
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.value) {
                                $("#modalNoAprobacionCT").modal("hide");
                                $("#tablaReporteCotizacion").DataTable().ajax.reload(null, false);
                            }
                        });
                    }
                });
            });

        } else {
            swal({
                type: "warning",
                title: "Seleccione un critero de búsqueda"
            });
        }
    });
});
</script>