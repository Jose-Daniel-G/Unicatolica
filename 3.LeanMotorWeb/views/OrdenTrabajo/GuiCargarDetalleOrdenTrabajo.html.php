    <?php $i=1; ?>
    <?php if($Detalle != null): ?>
    <?php foreach($Detalle as $detalle): ?>
    <div id="Detalle_General">

        <div id="options_productos" style="display: none;">
            <option value="">Seleccione ...</option>
            <?php foreach ($servicios as $servicio): ?>
            <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
            <?php endforeach;?>
        </div>

        <div class="pt-2 pb-2 fila_Detalle_General row">

            <div class="col-10">
                <div class="row">
                    <input type="hidden" id="item<?=$i;?>" name="item[]" class="item" value="<?=$i;?>">
                    <div class="col-5">
                        <select name="producto[]" id="producto<?=$i;?>" class="form-control select2 productos_servicios" required>
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

                    <div class="col-7">
                        <input type="text" name="detalle[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-1">
                <div class="row">
                    <div class="p-0 col-11">
                        <input type="text" name="cant[]" id="cant<?=$i;?>" class="form-control text-center number cantDetalle" value="<?=$detalle["Cantidad"]; ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-1 align-self-center">
                <button type="button" class="btn btn-danger fa fa-minus btn_eliminarFilaDetalle_General" title="Eliminar fila"></button>
            </div>
        </div>
    </div>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <div id="Detalle_General">

        <div id="options_productos" style="display: none;">
            <option value="">Seleccione ...</option>
            <?php foreach ($servicios as $servicio): ?>
            <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
            <?php endforeach;?>
        </div>

        <div class="pt-2 pb-2 fila_Detalle_General row">

            <div class="col-10">
                <div class="row">
                    <input type="hidden" id="item1" name="item[]" class="itemDetalle" value="1">
                    <div class="col-5">
                        <select name="producto[]" id="producto1" class="form-control select2 productos_servicios" required>
                            <option value="">Seleccione ...</option>
                            <?php foreach ($servicios as $servicio): ?>
                            <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="col-7">
                        <input type="text" name="detalle[]" id="detalle1" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-1">
                <div class="row">
                    <div class="p-0 col-11">
                        <input type="text" name="cant[]" id="cant1" class="form-control text-center number cantDetalle" required>
                    </div>
                </div>
            </div>

            <div class="col-1 align-self-center">
                <button type="button" class="btn btn-danger fa fa-minus btn_eliminarFilaDetalle_General" title="Eliminar fila"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        $(".select2").select2({
            language: "es",
            width: "100%",
            theme: "bootstrap"
        });
        $(".number").on({
			"input": function (event) {
				this.value = this.value.replace(/[^0-9]/g, '');
			}
		});
    </script>