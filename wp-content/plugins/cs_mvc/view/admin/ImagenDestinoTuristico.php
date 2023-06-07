<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenDestinoTuristicoViewModel();
?>
<div class="wrap">
<h2>ImagenDestinoTuristicos(<?=count($model->getImagenDestinoTuristicos())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_imagen_destino_turisticos','admin/ImagenDestinoTuristico_edit','ImagenDestinoTuristico','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_imagen_destino_turisticos">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Foto</th>
        <th>DestinoTuristico</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getImagenDestinoTuristicos() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->foto ))?></td>
            <td><?=HTML::truncate(__( $item->getDestinoTuristico()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_imagen_destino_turisticos','admin/ImagenDestinoTuristico_edit','ImagenDestinoTuristico',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_imagen_destino_turisticos','ImagenDestinoTuristico',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
