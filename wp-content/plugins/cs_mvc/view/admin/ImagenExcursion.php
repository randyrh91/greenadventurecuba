<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenExcursionViewModel();
?>
<div class="wrap">
<h2>ImagenExcursiones(<?=count($model->getImagenExcursiones())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_imagen_excursiones','admin/ImagenExcursion_edit','ImagenExcursion','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_imagen_excursiones">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Foto</th>
        <th>Excursi&oacute;n</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getImagenExcursiones() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->foto ))?></td>
            <td><?=HTML::truncate(__( $item->getExcursion()->__toString() ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_imagen_excursiones','admin/ImagenExcursion_edit','ImagenExcursion',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_imagen_excursiones','ImagenExcursion',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
