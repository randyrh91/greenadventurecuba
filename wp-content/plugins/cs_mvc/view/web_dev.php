<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */

$model = new SigerViewModel;
?>
<h3>La web de desarrollo donde los crud corren por la libre</h3>
<?=$model->getDev()?>
<div class="pull-right">
    <a id="btn_moreinfo" class="btn btn-info" href="#">Mas información...</a>
</div>
<div id="moreinfo" class="col-md-12">

</div>
<div class="col-md-12">
    Llmando a metodos de VM probando la carga, consulta y relaciones de datos.
<?php
?>
</div>
<div id="print" style="display: none">
    <div>
        Este es el contenido a imprimir
    </div>
</div>
<script>
    window.onload=function(event) {
    };
</script>