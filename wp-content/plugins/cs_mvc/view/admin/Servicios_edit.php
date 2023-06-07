<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ServiciosViewModel();
$item = $model->getServicio();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando Servicio: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando Servicio</h2>
    <?php endif ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="Servicio.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>
					<tr><td colspan="2">
				<input name="id" required="" type="hidden" value="<?=__($item->id)?>">
				</td></tr>
                    <tr class="wrap">
                        <th>
                            <img src="<?=View::getFoto(View::IMG_SERVICIO,$item->icono)?>" width="40px" style="vertical-align:middle ">
                            <label>Foto</label></th>
                        <td>
                            <input type="file" name="icono">
                        </td>
                    </tr>
	
					<tr class="wrap">
					<th><label>Nombre</label></th>
					<td>
                        <?=HTML::listInputTranslate('nombre',$item->nombre,'input',array(
							'onblur'=>'setValuesByLang(this)',
                             'required'=>'required'
						))?>
						</td>
				</tr>
	
					<tr class="wrap">
					<th><label>TextoCorto</label></th>
					<td>
							<?=HTML::listInputTranslate('descripcion',$item->descripcion,'textarea',array(
							'onblur'=>'setValuesByLang(this)'
						))?>
						</td>
				</tr>
	
		</tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_servicios') ?>
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