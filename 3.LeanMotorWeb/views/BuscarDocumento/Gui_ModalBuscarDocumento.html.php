<div class="card-body">
    <form method="post" autocomplete="off" id="frm_BuscarDocumentos" action="<?php echo getUrl("Utilidades","Utilidades", "ListarDocumentos", false, "ajax"); ?>">
        
        <input type="hidden" id="tipo_documento" name="tipo_documento" value="CT">
        
        <div class="container-fluid">
            <div class="pb-4 border row">
                <label class="header-blue">Criterios de Búsqueda</label>

                <div class="col-12">
                    <div class="row">
                    
                        <div class="col-8">
                            <div id="buscarPorDocumento" class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="tipo_docum">Tipo&nbsp;de&nbsp;documento</label>
                                        </div>
                                        <div class="col-7">
                                            <select name="tipo_docum" id='tipo_docum' class="form-control">
                                                <option value="">Seleccione</option>
                                                <?php
                                                    $seleccion = "";
                                                    $td = "";
                                                    foreach ($tipos_doc as $tdoc) {
                                                        if ($td == $tdoc[0]) {
                                                            $seleccion = "selected";
                                                        }
                                                        echo "<option value='" . $tdoc[0] . "' $seleccion>" . $tdoc[1] . "</option>";
                                                        $seleccion = "";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="numero_doc">N°&nbsp;de&nbsp;documento</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="numero_doc" id="numero_doc" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                
                                <div class="col-8">

                                    <div id="menu-ir-a-Doc" class="row" style="display: none;">

                                        <div class="p-0 col-3">
                                            <div class="btn-group" role="group">
                                                <a id="ir-a-documento-cicloVida" class="px-3 py-2 btn btn-primary" href="" target="_blank" title="Ir a los Estados del Documento">
                                                    <i class="fa fa-align-justify"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="p-0 col-4">
                                            <div class="btn-group" role="group" aria-label="dropdownVer">
                                                <div class="btn-group" role="group">
                                                    <a id="btnDropdownVerDoc" class="px-3 py-2 btn btn-primary" href="" target="_blank">Ver</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-0 col-4">
                                            <div class="btn-group" role="group" aria-label="dropdownEditar">
                                                <div class="btn-group" role="group">
                                                    <a id="btnDropdownEditarDoc" class="px-3 py-2 btn btn-primary" href="" target="_blank">Editar</a>
                                                </div>
                                            </div>
                                        </div>
            
                                    </div>

                                </div>

                                <div class="p-0 col-4">
                                    <button type="submit" class="px-3 py-2 btn btn-primary" id="btnBuscarCliente" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button type="reset" class="px-3 py-2 btn btn-primary" id="btnNuevaBusqueda" title="Nueva búsqueda">
                                        <i class="fa fa-file"></i>
                                    </button>
                                </div>

                            </div>
				        </div>

                    </div>
                </div>

                <div class="mt-4 col-12 ">
                    <div class="row">

                        <div class="col-2">
                            <input type="radio" name="criterioIng" id="opc_fecha">
                            <label for="">Por Fecha</label>
                        </div>

                        <div class="col-10">

                            <div id="buscarDocumentoDesdeHasta" class="nuevaBusqueda row" style="display: none;">

                                <div class="col-5">

                                    <div class="row">
                                        <div class="col-5">
                                            <label label="fecha_desde">Desde</label>
                                        </div>
                                        <div class="col-7">
                                            <div class="input-group-prepend">
                                                <input type="text" name="fecha_desde" id="fecha_desde" class="form-control text-center datepicker"
                                                    placeholder="aaaa-mm-dd" readonly>
                                                <div class="d-flex align-items-center ml-1" style="color: #337ab7; cursor: pointer;">
                                                    <i class="fa fa-window-close fa-2x removeDatepicker"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-5">

                                    <div class="row">
                                        <div class="col-5">
                                            <label label="fecha_hasta">Hasta</label>
                                        </div>
                                        <div class="col-7">
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

                    </div>
                </div>

                <div class="mt-4 col-12">
                    <div class="row">

                        <div class="col-2">
                            <div class="row">
                                <div class="col-1">
                                    <input type="radio" name="criterioIng" id="opc_noIngreso_cliente">
                                </div>
                                <div class="p-0 col-9">
                                    <label for="">Por N° de ingreso o Cliente</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10">
                            <div id="buscarDocumentoNoIngreso-Cliente" class="nuevaBusqueda row" style="display: none;">
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="">N° de ingreso</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="numero_ingreso" id="numero_ingreso" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="empresa">Empresa</label>
                                        </div>
                                        <div class="col-10">
                                            <select name="nit_empresa" id="empresa" class="form-control select2">
                                                <option value="">Seleccione ...</option>
                                                <?php foreach ($empresas as $empresa): ?>
                                                <option value="<?=$empresa[0];?>"><?=$empresa[1];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-4 col-12">
                    <div class="row">

                        <div class="col-5">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Estados del documento</label>
                                </div>
                                <div class="col-6">
                                    <select name="estado_doc" id="estado_doc" class="form-control">
                                        <option value="">Seleccione ...</option>
                                        <option value="T">Todos</option>
                                        <option value="A">Activos</option>
                                        <option value="I">Anulados</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row">
                                <div class="col-2">
                                    <label for="sede">Sede</label>
                                </div>
                                <div class="col-9">
                                    <select name="nit_sede" id="sedeDoc" data-campo-1="#empresa" class="form-control" 
                                        data-url="<?=getUrl("Utilidades", "Utilidades", "buscarConsecutivoSedeYcliente", false, "ajax"); ?>">
                                        <option value="">Seleccione ...</option>
                                        <?php foreach ($sedes as $sede): ?>
                                        <option value="<?=$sede[0];?>"><?=$sede[1];?></option>
                                        <?php endforeach;?>
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

<div class="container">
    <div class="nuevaBusqueda" id="containerTablaModalBuscarDocumentos" style="display: none;">
        <table id="tablaModalBuscarDocumentos" class="table-bordered table-hover" width="100%;">

            <thead class="table text-white bg-primary thead-primary">
                <tr>
                    <th>N° de Documento</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>N° de Ingreso</th>
                    <th>Usuario Crea</th>
                    <th>Sede</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody></tbody>

        </table>
    </div>
</div>

<script>
    $(".select2").select2({
        language: "es",
        width: "100%",
        theme: "bootstrap",
    });
    $(".datepicker").css({
        fontSize: 17,
    });
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
    $(".datepicker").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: "1940:2040",
    });
    $(document).on("click", ".removeDatepicker", function () {
        $(this).parent().parent().find("input").val("");
    });
</script>