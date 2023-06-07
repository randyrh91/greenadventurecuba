<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
$model = new AccionViewModel();
?>
<div class="wrap">
<h2>Acciones(<?=count($model->getAcciones())?>) <?=HTML::link_buttonVM('+ Añadir Nueva','cs_mvc_acciones','admin/accion_edit','accion','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_acciones">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="<?=__('Filter')?>">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
        <th>Nombre</th>
        <th>Descripción</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getAcciones() as $acc): ?>
        <tr>
            <td><?=__($acc->nombre)?></td><td><?=HTML::truncate(__($acc->descripcion))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_acciones','admin/accion_edit','accion',$acc->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_acciones','accion',"remove&id=$acc->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
