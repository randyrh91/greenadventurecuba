<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new HabitacionViewModel();
?>
<div class="wrap">
<h2>Habitaciones(<?=count($model->getHabitaciones())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_viajes','admin/Habitacion_edit','Habitacion','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_viajes">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
        <th>Excursi&oacute;n</th>
        <th>DestinoTuristico</th>
		<th>Orden</th>
		<th>Tiempo</th>
		<th>DistanciaKM</th>
        <th>Transporte</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getHabitaciones() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
            <td><?=HTML::truncate(__( $item->getExcursion()->__toString() ))?></td>
            <td><?=HTML::truncate(__( $item->getDestinoTuristico()->__toString() ))?></td>
			<td><?=HTML::truncate(__( $item->orden ))?></td>
			<td><?=HTML::truncate(__( $item->tiempo ))?></td>
			<td><?=HTML::truncate(__( $item->distanciaKM ))?></td>
            <td><?=HTML::truncate(__( $item->getTransporte()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_viajes','admin/Habitacion_edit','Habitacion',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_viajes','Habitacion',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
