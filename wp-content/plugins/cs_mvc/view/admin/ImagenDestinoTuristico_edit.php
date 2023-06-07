<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenDestinoTuristicoViewModel();
$item = $model->getImagenDestinoTuristico();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando ImagenDestinoTuristico: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando ImagenDestinoTuristico</h2>
    <?php endif ?>
    <form method="post">
        <input type="hidden" name="controller" value="ImagenDestinoTuristico.save">
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
							<?=HTML::listInputTranslate('foto',$item->foto,'input',array(
							'onblur'=>'setValuesByLang(this)'
						))?>
						</td>
				</tr>
	
				<tr class="wrap">
					<th><label>DestinoTuristico</label></th>
					<td>
						<?=HTML::dropDownList('Destino_Turistico_id',$model->getDestinoTuristicos(),$item->id)?>
					</td>
				</tr>
		</tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_imagen_destino_turisticos') ?>
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