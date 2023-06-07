<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ServiciosViewModel();
?>
<div class="wrap">
<h2>Servicios(<?=count($model->getServicios())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_servicios','admin/Servicios_edit','Servicios','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_servicios">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th width="50px"></th>
		<th>Nombre</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getServicios() as $item): ?>
        <tr>
			<td><img width="40px" src="<?=View::getFoto(View::IMG_SERVICIO,$item->icono)?>"></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_servicios','admin/Servicios_edit','Servicio',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_servicios','Servicio',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
