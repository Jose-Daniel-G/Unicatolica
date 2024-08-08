<?php  
$subt=0;
$tsubt=0;
$i=1;
$dsto=0;
$tdsto=0;
$tiva=0;
if($detallePL <> null){
    foreach($detallePL as $detalle){
        $valor_Bruto=$detalle["Valor_Unitario"] * $detalle["Cantidad"];
        if($detalle["Porcentaje_Descuento"] > 0){
            $destouno=$valor_Bruto   * ($detalle["Porcentaje_Descuento"]/100);
            $subt= $valor_Bruto - $destouno;   
        }
        else{
            $destouno=0;
            $subt= $valor_Bruto;
        }
       
        $tsubt+=$subt;
        $tdsto+=$destouno;
        $tiva+= $detalle["Valor_Iva"];
        ?>
        <div id="Detalle_GER">

            <div id="options_productos" style="display: none;">
                <option value="">Seleccione ...</option>
                <?php foreach ($servicios as $servicio): ?>
                <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                <?php endforeach;?>
            </div>

            <div class="pt-2 pb-2 fila_DetalleGER row">

                <div class="col-6">
                    <div class="row">
                            <input type="hidden" id="item<?=$i;?>" name="item[]" class="item" value="<?=$i;?>">
                        <div class="col-6">
                            <select name="producto[]" id="producto<?=$i;?>" class="form-control select2 productos_servicios" data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax");  ?>" required>
                                <option value="">Seleccione ...</option>
                                <?php foreach ($servicios as $servicio): ?>
                                <?php if ($servicio["Codigo"] == $detalle["Codigo_Producto"]): ?>
                                <option value="<?=$servicio["Codigo"];?>" selected><?=$servicio["Descripcion"];?></option>
                                <?php else: ?>
                                <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input type="hidden" name="iva[]" id="iva<?=$i;?>" class="ivaDetalle" value="<?=$detalle["Porcentaje_Iva"]; ?>">
                        <input type="hidden" name="valoriva[]" id="valoriva<?=$i;?>" class="valorivaDetalle" value="<?=$detalle["Valor_Iva"]; ?>">

                        <div class="p-0 col-6">
                            <input type="text" name="detalle[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="row">
                        <div class="col-3">
                            <input type="text" name="cant[]" id="cant<?=$i;?>" class="form-control text-center number cantDetalle" value="<?=$detalle["Cantidad"]; ?>" required>
                        </div>

                        <div class="p-0 col-3">
                            <input type="text" name="valor[]" id="valor<?=$i;?>" class="format form-control text-right valorDetalle" value="<?=$detalle["Valor_Unitario"]; ?>" required>
                        </div>

                        <div class="col-3">
                            <input type="text" name="desc[]" id="desc<?=$i;?>" class="form-control text-center number descDetalle" value="<?=$detalle["Porcentaje_Descuento"]; ?>" required>
                        </div>

                        <div class="p-0 col-3">
                            <input type="text" name="subtotal[]" id="subtotal<?=$i;?>" class="format form-control text-right subtotalDetalle" value="<?=$subt ;?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-1 align-self-center">
                    <button type="button" class="btn btn-danger fa fa-minus btn_eliminarGER" title="Eliminar fila"></button>
                </div>

            </div>
        </div>
        
        <?php
        $i++;
    }     
}
else{
    ?>
    <div id="Detalle_GER">

        <div id="options_productos" style="display: none;">
            <option value="">Seleccione ...</option>
            <?php foreach ($servicios as $servicio): ?>
            <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
            <?php endforeach;?>
        </div>

        <div class="pt-2 pb-2 fila_DetalleGER row">

            <div class="col-6">
                <div class="row">
                    <input type="hidden" id="item<?=$i;?>" name="item[]" class="item" value="<?=$i;?>">
                    <div class="col-6">
                        <select name="producto[]" id="producto1" class="form-control select2 productos_servicios" data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax");  ?>" required>
                            <option value="">Seleccione ...</option>
                            <?php foreach ($servicios as $servicio): ?>
                            <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <input type="hidden" name="iva[]" class="ivaDetalle" id="iva1">
                    <input type="hidden" name="valoriva[]" class="valorivaDetalle" id="valoriva1">

                    <div class="p-0 col-6">
                        <input type="text" name="detalle[]" id="detalle1" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col-3">
                        <input type="text" name="cant[]" id="cant1" class="form-control text-center number cantDetalle" required>
                    </div>

                    <div class="p-0 col-3">
                        <input type="text" name="valor[]" id="valor1" class="format form-control text-right valorDetalle" required>
                    </div>

                    <div class="col-3">
                        <input type="text" name="desc[]" id="desc1" class="form-control text-center number descDetalle" required>
                    </div>

                    <div class="p-0 col-3">
                        <input type="text" name="subtotal[]" id="subtotal1" class="format form-control text-right subtotalDetalle" required>
                    </div>
                </div>
            </div>

            <div class="col-1 align-self-center">
                <button type="button" class="btn btn-danger fa fa-minus btn_eliminarGER" title="Eliminar fila"></button>
            </div>

        </div>
    </div>
<?php
}
?>

<script>
$(".select2").select2({
    language: "es",
    width: "100%",
    theme: "bootstrap"
});
$(".format").each(function () {
    $(this).val(numeral($(this).val()).format("0,0"));
});
$(".format").on({
    "input": function (event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    },
    "keyup": function (event) {
        let format = numeral($(event.target).val());
        $(event.target).val(format.format("0,0"));
    }
});
</script>