<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new DestinoTuristicoViewModel();
?>
<div class="wrap">
<h2>Destinos Turisticos(<?=count($model->getDestinoTuristicos())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_destino_turisticos','admin/DestinoTuristico_edit','DestinoTuristico','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_destino_turisticos">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th WIDTH="20PX">Id</th>
        <th width="100PX">Foto</th>
        <th>Nombre</th>
        <th>Texto Corto</th>
        <th width="80px">Tipo de Destino</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getDestinoTuristicos() as $item): ?>
        <tr>
			<td><B><?=$item->id?></B></td>
            <td><img src="<?=View::getFoto($item->foto)?>" width="100%" height="80px"></td>
            <td><?=HTML::truncate(__( $item->nombre ))?></td>
            <td><?=HTML::truncate(__( $item->textoCorto ))?></td>
            <td><?=HTML::truncate(__( $item->getTipoDestino()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_destino_turisticos','admin/DestinoTuristico_edit','DestinoTuristico',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_destino_turisticos','DestinoTuristico',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
