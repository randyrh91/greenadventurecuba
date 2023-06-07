<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new EstadoReservaViewModel();
?>
<div class="wrap">
<h2>EstadoReservas(<?=count($model->getEstadoReservas())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_estado_reservas','admin/EstadoReserva_edit','EstadoReserva','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_estado_reservas">
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
    <?php foreach($model->getEstadoReservas() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->textoCorto ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_estado_reservas','admin/EstadoReserva_edit','EstadoReserva',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_estado_reservas','EstadoReserva',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
