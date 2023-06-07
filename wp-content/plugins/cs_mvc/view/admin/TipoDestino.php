<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new TipoDestinoViewModel();
?>
<div class="wrap">
<h2>TipoDestinos(<?=count($model->getTipoDestinos())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_tipo_destinos','admin/TipoDestino_edit','TipoDestino','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_tipo_destinos">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>TextoCorto</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getTipoDestinos() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->textoCorto ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_tipo_destinos','admin/TipoDestino_edit','TipoDestino',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_tipo_destinos','TipoDestino',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
