<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenHabitacionViewModel();
$item = $model->getImagenHabitacion();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando ImagenHabitacion: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando ImagenHabitacion</h2>
    <?php endif ?>
    <form method="post">
        <input type="hidden" name="controller" value="ImagenHabitacion.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>
					<tr><td colspan="2">
				<input name="id" type="hidden" value="<?=__($item->id)?>"> 
				</td></tr>
	
					<tr class="wrap">
					<th><label>Nombre</label></th>
					<td>
							<?=HTML::listInputTranslate('nombre',$item->nombre,'input',array(
							'onblur'=>'setValuesByLang(this)'
						))?>
						</td>
				</tr>

                    <tr class="wrap">
                        <th><label>Foto</label></th>
                        <td>
                            <input type="file" name="foto">
                        </td>
                    </tr>
	
				<tr class="wrap">
					<th><label>Habitacion</label></th>
					<td>
						<?=HTML::dropDownList('Habitacion_id',$model->getHabitaciones(),$item->id)?>
					</td>
				</tr>
		</tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_imagen_transportes') ?>
        </div>
    </form>
</div>
<script>
    function setValuesByLang(select_el) {
        var $ = jQuery;
        var $sel = $(select_el);
        var arr = $sel.attr('name').split('_');
        var $el = $('[name='+ arr[0] +']');
        $el.val('');
        $('[name^='+ $el.attr('name') +'_]').each(function (i, item) {
            $item = $(item);
            var arr = $item.attr('name').split('_');
            $el.val($el.val()+'[:'+arr[1]+']'+$item.val());
        })
    }
</script>