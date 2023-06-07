<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new AlojamientoViewModel();
?>
<div class="wrap">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">Listado de Alojamientos</li>
    </ul>

    <h2>Alojamientos(<?=count($model->getAlojamientos())?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_alojamientos','admin/Alojamiento_edit','Alojamiento','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <input type="hidden" name="page" value="cs_mvc_alojamientos">
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
		<th>Contacto</th>
		<th>Post</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php foreach($model->getAlojamientos() as $item): ?>
        <tr>
			<td><b><?=HTML::truncate(__( $item->id ))?></b></td>
			<td><?=HTML::truncate(__( $item->nombre ))?></td>
            <td><?=HTML::truncate(__( $item->getTipoAlojamiento()->__toString() ))?></td>
			<?php /*
            <td><?=HTML::truncate(__( $item->precio ))?></td>
			<td><?=HTML::truncate(__( $item->likes ))?></td> */?>
			<td><?=HTML::truncate($item->contacto)?></td>
			<td><?=$item->Post_ID?'<b>'.$item->Post_ID.'</b> - '.HTML::truncate(__( get_post($item->Post_ID)->post_name)):''?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_alojamientos','admin/Alojamiento_edit','Alojamiento',$item->id)?>
                <?=HTML::link_buttonCA('Eliminar','cs_mvc_alojamientos','Alojamiento',"remove&id=$item->id")?>
            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
