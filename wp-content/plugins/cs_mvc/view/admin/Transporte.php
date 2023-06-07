<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new TransporteViewModel();
?>
<div class="wrap">
<h2>Transportes(<?=count($model->getTransportes())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_transportes','admin/Transporte_edit','Transporte','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_transportes">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th width="20px">Id</th>
        <th>Foto</th>
        <th>Nombre</th>
        <th>TextoCorto</th>
        <th>Tipo de Transporte</th>
        <th>Chofer</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getTransportes() as $item): ?>
        <tr>
			<th><?=$item->id?></th>
            <td><img src="<?=View::getFoto($item->foto )?>" width="100px"></td>
            <td><?=HTML::truncate(__( $item->nombre ))?></td>
            <td><?=HTML::truncate(__( $item->textoCorto ))?></td>
            <td><?=HTML::truncate(__( $item->getTipoTransporte()->__toString() ))?></td>
            <td><?=HTML::truncate(__( $item->getChofer()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_transportes','admin/Transporte_edit','Transporte',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_transportes','Transporte',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
