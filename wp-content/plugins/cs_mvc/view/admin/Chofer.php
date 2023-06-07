<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ChoferViewModel();
?>
<div class="wrap">
<h2>Choferes(<?=count($model->getChoferes())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_choferes','admin/Chofer_edit','Chofer','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_choferes">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Telefono</th>
		<th>AnosExperiencia</th>
		<th>Foto</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getChoferes() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->telefono ))?></td>
			<td><?=HTML::truncate(__( $item->anosExperiencia ))?></td>
			<td><?=HTML::truncate(__( $item->foto ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_choferes','admin/Chofer_edit','Chofer',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_choferes','Chofer',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
