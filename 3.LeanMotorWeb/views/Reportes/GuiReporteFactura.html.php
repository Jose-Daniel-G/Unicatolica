<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Reporte Facturas</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="frm_ReporteFactura" autocomplete="off" action="<?=getUrl("Reportes", "Reportes", "listarReporteFactura", false, "ajax");  ?>">

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
        <div class="pt-4 pb-4 nuevaBusqueda" id="containerTablaReporteFactura" style="display: none;">
            <table id="tablaReporteFactura" class="table-bordered table-hover" width="100%;">

                <thead class="table text-white bg-primary thead-primary">
                    <tr>
                        <th>N° de Documento</th>
                        <th>Fecha Documento</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>Iva</th>
                        <th>Descuentos</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>
    </div>
    
</div>

<!-- Modal Sumatoria -->
<div class="modal fade" id="modalSumatoriaFacturas" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <div class="col-4">
                                        <label for="sumDescuento">Descuentos</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="sumDescuento" id="sumDescuento" class="form-control text-center format" readonly>
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

    $(document).on("submit", "#frm_ReporteFactura", function (event) {

        event.preventDefault();

        if ($("select[name=sedeReporte]").val() || $("select[name=nit_cliente]").val() || $("input[name=fecha_desde]").val() && $("input[name=fecha_hasta]").val() || 
            $("select[name=proceso]").val() || $("select[name=estado]").val() || $("select[name=vendedorReporte]").val()) {
            $("#containerTablaReporteFactura").show();

            var sumSubtotal = 0,
                sumIva = 0,
                sumDescuento = 0,
                sumTotal = 0;

            var tablaReporteFactura = $("#tablaReporteFactura").DataTable({
                language: {
                    "url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
                },
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "excelHtml5",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        text: '<i class="fa fa-file-excel"></i>',
                        titleAttr: "Exportar a Excel",
                        className: "bg-success mr-4",
                        filename: "Reporte Facturas",
                        sheetName: "Reporte Facturas"
                    },
                    {
                        text: '<i class="fa fa-sigma"></i>',
                        titleAttr: "Sumatoria",
                        action: function () {
                            $("#modalSumatoriaFacturas").modal();
                        }
                    }
                ],
                destroy: true,
                order: [[ 1, "desc" ]],
                pageLength: 10,
                autoWidth: false,
                lengthChange: false,
                columnDefs: [
                    {"className": "text-center", "targets": [0, 1, 2, 7]},
                    { "className": "text-center sumSubtotal", "targets": [3] },
                    { "className": "text-center sumIva", "targets": [4] },
                    { "className": "text-center sumDescuento", "targets": [5] },
                    { "className": "text-center sumTotal", "targets": [6] },
                ],
                drawCallback: () => {
                    tablaReporteFactura.columns.adjust();
                },
                createdRow: (row, data, dataIndex) =>{
                    $("td.sumSubtotal", row).each(function () {
                        sumSubtotal += numeral($(this).html()).value();
                    });
                    $("td.sumIva", row).each(function () {
                        sumIva += numeral($(this).html()).value();
                    });
                    $("td.sumDescuento", row).each(function () {
                        sumDescuento += numeral($(this).html()).value();
                    });
                    $("td.sumTotal", row).each(function () {
                        sumTotal += numeral($(this).html()).value();
                    });

                    $("#sumSubtotal").val(numeral(sumSubtotal).format("0,0"));
                    $("#sumIva").val(numeral(sumIva).format("0,0"));
                    $("#sumDescuento").val(numeral(sumDescuento).format("0,0"));
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
                    {data: "subtotal"},
                    {data: "iva"},
                    {data: "descuentos"},
                    {data: "total"},
                    {data: "estado"},
                ],
            });

            $(document).on("click", "#tablaReporteFactura input[type=checkbox]", function () {
                $("td", $(this).parents("tr")).toggleClass("bg-yellow");
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