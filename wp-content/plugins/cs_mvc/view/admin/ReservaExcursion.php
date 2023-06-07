<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ReservaExcursionViewModel();
?>
<div class="wrap">
<h2>Reserva de <?=View::in('page','cs_mvc_reserva_excursiones')=='cs_mvc_reserva_alojamienientos'?'Alojamientos':'Excursiones'?>(<?=$model->count()?>) <?=HTML::link_buttonVM('+ A&ntilde;adir Nuevo','cs_mvc_reserva_excursiones','admin/ReservaExcursion_edit','ReservaExcursion','','add-new-h2')?>
    <form action="./admin.php" style="float: right">
        <?=(View::in('q')?'Regs: <b>('.count($model->getReservaExcursiones()).')</b>':'')?>
        <input type="hidden" name="page" value="cs_mvc_reserva_excursiones">
        <input type="hidden" name="type" value="<?=View::in('type',2)?>">
        <input type="search" name="q" value="<?=View::in('q')?>">
        <input type="submit" class="button" value="Filtrar">
    </form>
</h2>
<ul class="subsubsub">
    <li><a href="<?=View::genPathVM('cs_mvc_reserva_excursiones')?>&type=2" class="<?=(View::in('type')<3)?'current':''?>">Bandeja de Entrada <span class="count">(<?=$model->countTipo1_2()?>)</span></a> |</li>
    <li><a href="<?=View::genPathVM('cs_mvc_reserva_excursiones')?>&type=3" class="<?=(View::in('type')==3)?'current':''?>">En Proceso <span class="count">(<?=$model->countTipo3()?>)</span></a> |</li>
    <li><a href="<?=View::genPathVM('cs_mvc_reserva_excursiones')?>&type=4" class="<?=(View::in('type')==4)?'current':''?>">Completadas <span class="count">(<?=$model->countTipo4()?>)</span></a> |</li>
    <li><a href="<?=View::genPathVM('cs_mvc_reserva_excursiones')?>&type=5" class="<?=(View::in('type')==5)?'current':''?>">Canceladas <span class="count">(<?=$model->countTipo5()?>)</span></a></li>
</ul>
<table id="list" class="wp-list-table widefat fixed">
    <thead>
		<th width="40pX">Id</th>
		<th width="90px">Fecha</th>
<!--		<th width="40px">Precio</th>-->
		<th width="40px">Pax</th>
        <th>Estado de Reserva</th>
        <th>Excursi&oacute;n</th>
		<th>User</th>
        <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <?php
    /** @var ReservaExcursionModel $item */
    foreach($model->getReservaExcursiones() as $item): $user = json_decode($item->User_JSON);?>
        <tr>
			<td><b><?=$item->id?></b></td>
			<td style="color: <?=$item->isPass() && $item->EstadoReserva_id!=4?'#D1512A':'green'?>"><?=$item->fecha?></td>
			<td><?=$item->cantidadPersona?></td>
            <td><?=__($item->getEstadoReserva()->__toString())?><br>(<b>-<?=$item->diasRestantes()?> D&iacute;as</b>)</td>
            <td><?=__($item->getExcursion()->__toString())?></td>
			<td><b><?=$user->nombre?> <?=$user->apellido?></b>: <?=$item->User_ID?><br><b>Pais:</b> <?=$user->pais?><br><b>Lugar:</b> <?=$item->hora?></td>
            <td>
                <?=HTML::link_buttonVM('Editar','cs_mvc_reserva_excursiones','admin/ReservaExcursion_edit','ReservaExcursion',$item->id)?>

            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
</div>
<audio id="audio">
    <source src="<?=CS_MVC_URL_ASSETIC.'/audio/s5c.mp3'?>">
    <source src="<?=CS_MVC_URL_ASSETIC.'/audio/s5c.ogg'?>">
</audio>
<script>
    var count = <?=$model->countTipo1_2()?>,c= 0,title=window.document.title;
    function newReserva() {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_reserva_excursiones","ReservaExcursion","existNew")?>', {count:count}, function(response) {
            if(response.success && response.exist) {
                //location.reload(true);
                count++;
                c+=response.items.length;
                changeTitle();

                $('audio').get(0).play();

                $.each(response.items, function(i,item) {
                    var table = $('#list>tbody');
                    var html = table.html();
                    table.get(0).innerHTML =
                        "<tr style='font-weight: bold;background-color: green;'>" +
                        "<td style='color: #f5f5f5'>"+item.id+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.fecha+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.precioOferta+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.cantidadPersona+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.estadoreserva_display+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.excursion_display+"</td>" +
                        "<td style='color: #f5f5f5'>"+item.User_ID+"</td>" +
                        "<td>"+
                        '<a class="button" href="?page=cs_mvc_reserva_excursiones&amp;view=admin/ReservaExcursion_edit&amp;viewmodel=ReservaExcursion&amp;id='+item.id+'"> Editar</a>'+
                        '<a class="button" href="?page=cs_mvc_reserva_excursiones&amp;controller=ReservaExcursion.remove&amp;id='+item.id+'"> Eliminar</a>'+
                        "</td>" +
                        "</tr>" +
                        html;

                });

            }
        });
        setTimeout(newReserva,5000);
    }
    setTimeout(newReserva,5000);

    function changeTitle() {
        if(document.title[0]=='+')
            document.title = title;
        else document.title = '+'+c+' >> '+title;
        setTimeout(changeTitle,2000);
    }
</script>
