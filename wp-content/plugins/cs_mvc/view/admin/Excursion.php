<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ExcursionViewModel();
?>
<div class="wrap">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">Listado de Excurisiones</li>
    </ul>

    <h2>Excursiones(<?=count($model->getExcursiones())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_excursiones','admin/Excursion_edit','Excursion','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_excursiones">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<table class="wp-list-table widefat fixed">
    <thead>
		<th width="40px"><b>Id</b></th>
		<th>Nombre</th>
        <th>Tipo</th>
<!--		<th>Precio</th>-->
<!--		<th>Likes</th>-->
		<th>Dias</th>
		<th>Post</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getExcursiones() as $item): ?>
        <tr>
			<td><b><?=HTML::truncate(__( $item->id ))?></b></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
            <td><?=HTML::truncate(__( $item->getTipoExcursion()->__toString() ))?></td>
			<?php /*
            <td><?=HTML::truncate(__( $item->precio ))?></td>
			<td><?=HTML::truncate(__( $item->likes ))?></td> */?>
			<td><?=HTML::truncate(__( $item->cantDias ))?></td>
			<td><?=$item->Post_ID?'<b>'.$item->Post_ID.'</b> - '.HTML::truncate(__( get_post($item->Post_ID)->post_name)):''?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_excursiones','admin/Excursion_edit','Excursion',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_excursiones','Excursion',"remove&id=$item->id")?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
