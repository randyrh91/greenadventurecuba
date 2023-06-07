<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
require_once CS_MVC_PATH_VMODEL.'/ViajeViewModel.php';
$model = new ViajeViewModel();
$item = $model->getViaje();
$excursion = $item->getExcursion();
?>
<div class="wrap">
    <ul class="breadcrumb label">
        <li class="breadcrumb-item"><a href="<?= View::genPathVM("cs_mvc_excursiones") ?>">Listado de Excurisiones</a>
        </li>
        <li class="breadcrumb-item"><a
                href="<?= View::genPathVM("cs_mvc_excursiones", "admin/Excursion_edit", 'Excursion', $excursion->id) ?>"><?= $excursion->id ? __($excursion->nombre) . ' - ' . $excursion->id : 'Nueva Excursion' ?></a>
        </li>
        <li>D&iacute;a <?= $item->orden . ' ' . __($item->__toString()) ?></li>
    </ul>

    <?php if ($item->id): ?>
        <h2>Editando D&iacute;a: <?= $item->orden . ' ' . __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando D&iacute;a</h2>
    <?php endif ?>
    <form method="post" id="form1">
        <input type="hidden" name="controller" value="Viaje.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>
            <tr>
                <td colspan="2">
                    <input name="id" type="hidden" value="<?= __($item->id) ?>">
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Excursi&oacute;n</label></th>
                <td>
                    <?= HTML::dropDownList('Excursion_id', $model->getExcursiones(), $item->Excursion_id) ?>
                </td>
            </tr>
            <tr class="wrap">
                <th><label>D&iacute;a</label></th>
                <td>
                    <input name="orden" type="text" value="<?= __($item->orden) ?>">
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Destino Turistico</label></th>
                <td>
                    <?=HTML::listInputTranslate('destino',$item->destino,'textarea',array(
                        'onblur'=>'setValuesByLang(this)'
                    ))?>
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Alojamiento</label></th>
                <td>
                    <?=HTML::listInputTranslate('alojamiento_descripcion',$item->alojamiento_descripcion,'textarea',array(
                        'onblur'=>'setValuesByLang(this)'
                    ))?>
                </td>
            </tr>
            <?php /*
					<tr class="wrap">
					<th><label>Tiempo</label></th>
					<td>
							<input name="tiempo" type="text" value="<?=__($item->tiempo)?>"> 
						</td>
				</tr>
	
					<tr class="wrap">
					<th><label>DistanciaKM</label></th>
					<td>
							<input name="distanciaKM" type="text" value="<?=__($item->distanciaKM)?>"> 
						</td>
				</tr>
	
				<tr class="wrap">
					<th><label>Transporte</label></th>
					<td>
						<?=HTML::dropDownList('Transporte_id',$model->getTransportes(),$item->Transporte_id)?>
					</td>
				</tr>
                */
            ?>
            </tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_excursiones') ?>
        </div>
    </form>
</div>

<hr>
<a name="programa"></a>

<?php $prog = $item->getPrograma(); ?>

<table class="wp-list-table widefat fixed">
    <thead>
    <th width="70px">Orden</th>
    <th>Evento</th>
    <th width="20%">Acciones</th>
    </thead>
    <tbody>
    <tr><td colspan="3">

    <form id="form3" method="post" action="<?= get_admin_url() ?>admin.php#programa">
        <input type="hidden" name="controller" value="Viaje.saveAccion">
        <input type="hidden" name="Excursion_id" value="<?= $excursion->id ?>">
        <input type="hidden" name="Viaje_id" value="<?= $item->id ?>">
        <table style="width: 100%">
        <td width="70px"><input value="<?= count($prog) + 1 ?>" style="width: 100%" type="number" name="orden"></td>
        <td>
            <?= HTML::listInputTranslate('nombre', '', 'textarea', array(
                'onblur' => 'setValuesByLangForForm(this,"form3")',
                'required' => 'required'
            )) ?>
        </td>

        <td width="20%"><input type="submit" value="(+) Nuevo" class="button button-primary"></td>
        </table>
    </form>

    </td></tr>
    <?php foreach ($prog as $acc): $v = $item; ?>

        <tr>
            <td><a name="form3tr<?= $acc->id ?>"></a><b><?= $acc->orden ?></b></td>
            <td><b><?= HTML::truncate(__($acc->nombre)) ?></b></td>
            <td>
                <b>
                    <a onclick="showAccion(this,<?= $acc->id ?>)" class="button">Editar</a>
                    <a onclick="deleteAccion(this,<?= $acc->id ?>)" class="button">Eliminar</a>
                </b>
            </td>
        </tr>
        <tr id="form3_<?= $acc->id ?>_tr" style="display: none">
            <td colspan="4">
                <form id="form3_<?= $acc->id ?>" method="post"
                      action="<?= get_admin_url() ?>admin.php#form3tr<?= $acc->id ?>">
                    <input type="hidden" name="controller" value="Viaje.saveAccion">
                    <input type="hidden" name="id" value="<?= $acc->id ?>">
                    <input type="hidden" name="Excursion_id" value="<?= $excursion->id ?>">
                    <input type="hidden" name="Viaje_id" value="<?= $item->id ?>">

                    <b>Orden:</b> <input type="number" width="30px" name="orden" value="<?= $acc->orden ?>">
                    <br>
                    <b>Nombre:</b>
                    <br>
                    <?= HTML::listInputTranslate('nombre', $acc->nombre, 'textarea', array(
                        'onblur' => 'setValuesByLangForForm(this,"form3_' . $acc->id . '")',
                        'required' => 'required',
                        'cols' => 30
                    )) ?>
                    <input type="submit" value="Guardar" class="button button-primary">
                </form>
            </td>

            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>


<script>
    function setValuesByLang(select_el) {
        var $ = jQuery;
        var $sel = $(select_el);
        var arr = $sel.attr('name').split('_');
        var $el = $('[name=' + arr[0] + ']');
        $el.val('');
        $('[name^=' + $el.attr('name') + '_]').each(function (i, item) {
            $item = $(item);
            var arr = $item.attr('name').split('_');
            $el.val($el.val() + '[:' + arr[1] + ']' + $item.val());
        })
    }





    function setValuesByLang1(select_el) {
        var $ = jQuery;
        var $sel = $(select_el);
        var arr = $sel.attr('name').split('_');
        var $el = $('[name=' + arr[0] + ']');
        $el.val('');
        $('[name^=' + $el.attr('name') + '_]', $('#form1')).each(function (i, item) {
            $item = $(item);
            var arr = $item.attr('name').split('_');
            $el.val($el.val() + '[:' + arr[1] + ']' + $item.val());
        });
        console.log($el.val())
    }
    function setValuesByLang2(select_el) {
        var $ = jQuery;
        var $sel = $(select_el);
        var arr = $sel.attr('name').split('_');
        var $el = $('[name=' + arr[0] + ']');
        $el.val('');
        $('[name^=' + $el.attr('name') + '_]', $('#form2')).each(function (i, item) {
            $item = $(item);
            var arr = $item.attr('name').split('_');
            $el.val($el.val() + '[:' + arr[1] + ']' + $item.val());
        });
        console.log($el.val())
    }

    function saveAccion(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_acciones","Accion","saveJSON")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().parent().parent().hide('slow');
            }
        });
        event.preventDefault();
    }
    function toogleTBody(a) {
        jQuery(a).parents('table').children('tbody').slideToggle();
        event.preventDefault();
    }
    function showAccion(btn, id) {
        var $ = jQuery;
        $('#form3_' + id + '_tr').slideToggle();
    }
    function deleteAccion(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_acciones","Accion","removeJSON")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().parent().parent().hide('slow');
            }
        });
        event.preventDefault();
    }
    //desplazar unos px para mostrar en el top la acc editada
    jQuery(function ($) {
        if (/form3tr\d+$/.test(window.location.href)) {
            setTimeout(function () {
                document.body.scrollTop -= 40;
                console.log(window.screenY)
            }, 300);
        }
    })
</script>