<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenTransporteViewModel();
?>
<div class="wrap">
<h2>ImagenTransportes(<?=count($model->getImagenTransportes())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_imagen_transportes','admin/ImagenTransporte_edit','ImagenTransporte','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_imagen_transportes">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Foto</th>
        <th>Transporte</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getImagenTransportes() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->foto ))?></td>
            <td><?=HTML::truncate(__( $item->getTransporte()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_imagen_transportes','admin/ImagenTransporte_edit','ImagenTransporte',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_imagen_transportes','ImagenTransporte',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
