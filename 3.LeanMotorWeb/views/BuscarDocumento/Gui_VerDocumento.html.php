<div class="container-flud">
<table class="table table-hover table-bordered" id="tablaModalBuscarDocumentos">
    <?php
    if (isset($documentos)) {
        echo "<thead class='bg-primary thead-primary'>";
        echo "<tr>";
        echo "<th>No Documento</th>";
        echo "<th>Fecha</th>";
        echo "<th>Cliente</th>";
        echo "<th>No Ingreso</th>";
        echo "<th>Estado</th>";
        echo "<th>Usuario Crea</th>";
        echo "<th>Sede</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($documentos as $documento) {
            echo "<tr class='tr_VerDoc' data-url='" . $data_url . "' data-numdoc='" . $documento["Numero_Documento"] . "' data-tdoc='" . $documento[7] . "' data-nit_sede='" . $documento[8] . "'>";
            echo "<td><a style='cursor:pointer'>" . $documento["Numero_Documento"] . "</a></td>";
            echo "<td>" . $documento["Fecha_Documento"] . "</td>";
            echo "<td>" . $documento["Razon_Social"] . "</td>";
            echo "<td>" . $documento["Numero_Ingreso"] . "</td>";
            echo "<td>" . $documento["Estado_Documento"] . "</td>";
            echo "<td>" . $documento["Usuario"] . "</td>";
            echo "<td>" . $documento["Sede"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    }
    ?>
</table>
</div>

<script>
var tablaModalBuscarDocumentos = $("#tablaModalBuscarDocumentos").DataTable({
    language: {
        "url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
    },
    pageLength: 5,
    autoWidth: true,
    lengthMenu: false,
    columnDefs: [{ "className": "text-center", "targets": "_all" }],
});
</script>