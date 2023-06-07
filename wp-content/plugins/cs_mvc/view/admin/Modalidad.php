<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ModalidadViewModel();
?>
<div class="wrap">
<h2>Modalidades(<?=count($model->getModalidades())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nueva','cs_mvc_modalidades','admin/Modalidad_edit','Modalidad','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_modalidades">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th width="40px">Id</th>
		<th>Nombre</th>
		<th>TextoCorto</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getModalidades() as $item): ?>
        <tr>
			<td><?=HTML::truncate(__( $item->id ))?></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
			<td><?=HTML::truncate(__( $item->textoCorto ))?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_modalidades','admin/Modalidad_edit','Modalidad',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_modalidades','Modalidad',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
