<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new AlojamientoViewModel();
$item = $model->getAlojamiento();
$habitaciones = $item->getHabitaciones();
?>
<div class="wrap">
<ul class="breadcrumb label">
    <li class="breadcrumb-item"><a href="<?= View::genPathVM("cs_mvc_alojamientos") ?>">Listado de Alojamientos</a></li>
    <li><?= $item->id ? __($item->nombre) . ' - '   . $item->id : 'Nueva Alojamiento' ?></li>
</ul>
<?php if ($item->id): ?>
    <h2>Editando Alojamiento: <?= __($item->__toString()) ?></h2>
<?php else: ?>
    <h2>Agregando Alojamiento</h2>
<?php endif ?>
<form id="form1" method="post" action="<?= get_admin_url() ?>admin.php"
      style="float: left; width: <?= $item->id ? 60 : 100 ?>%">
    <input type="hidden" name="controller" value="Alojamiento.save">
    <input type="hidden" name="id" value="<?= $item->id ?>">
    <b><input type="checkbox" name="active" value="1" <?= $item->active || !$item->id ? 'checked' : '' ?>>(Activado)</b>
    <table class="form-table">
        <tbody>
        <tr class="wrap">
            <th><label>Nombre</label></th>
            <td>
                <?= HTML::listInputTranslate('nombre', $item->nombre, 'input', array(
                    'onblur' => 'setValuesByLang1(this)',
                    'required' => 'required'
                )) ?>
            </td>
        </tr>

        <tr class="wrap">

            <th><label>Texto Corto (Max=1000)</label></th>
            <td>
                <?= HTML::listInputTranslate('textoCorto', $item->textoCorto, 'textarea', array(
                    'onblur' => 'setValuesByLang1(this)',
                    'maxlength' => '1000',
                    'rows' => '5'
                )) ?>
            </td>
        </tr>
        <tr class="wrap">
            <th><label>Descripcion</label></th>
            <td>
                <?= HTML::listInputTranslate('descripcion', $item->descripcion, 'textarea', array(
                    'onblur' => 'setValuesByLang1(this)',
                    'rows' => '10'
                )) ?>
            </td>
        </tr>

        <tr class="wrap">
            <th><label>Tipo de Alojamiento</label></th>
            <td>
                <?= HTML::dropDownList('TipoAlojamiento_id', $model->getTipoAlojamientos(), $item->TipoAlojamiento_id, array(
                    'required' => 'required'
                )) ?>
            </td>

        </tr>
        <tr class="wrap">
            <th colspan="2">
                <label>Precio Baja ($)</label> <input name="precioBaja" value="<?= $item->precioBaja ?>">
                <label>Precio Alta ($)</label> <input name="precio" value="<?= $item->precio ?>">
            </th>

        </tr>

        <tr class="wrap">
            <th><label>ServiciosAlojamientos</label></th>
            <td><?= HTML::listBox('servicios', $model->getServicios(), $item->getServicios()) ?></td>
        </tr>

        <tr class="wrap">
            <th><label>Direccion</label></th>
            <td>
                <textarea cols="50" rows="4" name="direccion"><?= __($item->direccion) ?></textarea>
            </td>
        </tr>
        <tr class="wrap">
            <th><label>Contactar por</label></th>
            <td>
                <textarea cols="50" rows="4" name="contacto"><?= __($item->contacto) ?></textarea>
            </td>
        </tr>
        <tr class="wrap">
            <th><label>Puntos Green</label></th>
            <td>
                <input name="likes" type="number" value="<?= __($item->likes) ?>">
            </td>
        </tr>

        <tr class="wrap">
            <th><label>Es popular</label></th>
            <td>
                <input type="checkbox" name="isPop" value="1" <?= $item->isPop ? 'checked' : '' ?>>
            </td>
        </tr>

        <tr class="wrap">
            <th><label>Capacidad</label></th>
            <td>
                <input name="cantMax" type="number" value="<?= __($item->cantMax) ?>">
            </td>
        </tr>

        <tr class="wrap">
            <th><label>P&aacute;gina de Alojamiento</label></th>
            <td>
                <?php if (!$item->id): ?>
                    <b>Crear Post</b>
                    <div>
                        <input type="radio" name="create_post" value="1" <?= (!$item->id) ? 'checked' : '' ?>>Si
                        <input type="radio" name="create_post" value="0" <?= ($item->id) ? 'checked' : '' ?>>No
                    </div>
                <?php endif ?>
                <a href="./post.php?post=<?= $item->Post_ID ?>&action=edit" class="button"><b><?= ($item->Post_ID)
                            ? '<u>' . $item->Post_ID . '</u> | ' . __(get_post($item->Post_ID)->post_title)
                            : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                    </b></a>
                <select style="width: 100%" onchange="jQuery('input[name=Post_ID]').val(jQuery(this).val())">
                    <option>---</option>
                    <?php foreach (AlojamientoRepo::create()->getPosts() as $post): ?>
                        <option <?= $post->ID == $item->Post_ID ? 'selected' : '' ?>
                            value="<?= $post->ID ?>"> <?= '<u>' . $post->ID . '</u> | ' . __($post->post_title) ?></option>
                    <?php endforeach ?>
                </select>
                <input name="Post_ID" type="hidden" value="<?= __($item->Post_ID) ?>">
            </td>
        </tr>

        </tbody>
    </table>
    <div class="right">
        <?= HTML::button_primary('Guardar') ?>
        <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_alojamientos') ?>
    </div>
</form>
<div style="width:36%; float: right; display: <?= $item->id ? 'inline-block' : 'none' ?>">
    <h3>D&iacute;as / Destinos a Visitar(<?= count($habitaciones) ?>)</h3>
    <hr>
    <?php
    /** @var HabitacionModel $v */
    foreach ($habitaciones as $v):?>
        <div
            style="display: inline-block; width: 100%; padding: 8px 0px;  font-size: 14px; margin: 2px; border: 2px solid #3C2BB6; background-color: #3C2BB6; color: #f5f5f5">
            <a
               href="admin.php/<?= View::genPathVM('cs_mvc_alojamientos', 'admin/Habitacion_edit', 'Habitacion', $v->id) ?>"
               style="float: left;background: #FFFFFF; color: #3C2BB6; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"><b>Edit</b></a>
            <a href="#"
               style="float: right;background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"
               onclick="deleteHabitacion(this,<?= $v->id ?>)"><b>X</b></a>
            <b style="margin-left: 20px;"> - (<?= $v->orden ?>) - <?= HTML::truncate(__($v->nombre)) ?></b>
        </div>
    <?php endforeach ?>
    <form id="form4" method="post" action="<?= get_admin_url() ?>admin.php">
        <input type="hidden" name="controller" value="Alojamiento.saveHabitacion">
        <input type="hidden" name="Alojamiento_id" value="<?= $item->id ?>">
        <input type="hidden" name="id" value="0">
        <table class="form-table">
            <tbody>
            <tr class="wrap">
                <th><label>Orden</label></th>
                <td>
                    <input name="orden" type="number" value="<?=count($habitaciones)+1?>">
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Capacidad</label></th>
                <td>
                    <input name="cantMax" type="number" value="3">
                </td>
            </tr>

            <tr class="wrap">
                <th colspan="2">
                    <label>Precio Baja ($)</label> <input required="" name="precioBaja" value=""><br>
                    <label>Precio Alta ($)&nbsp;</label> <input required="" name="precio" value="">
                </th>
            </tr>

            <tr class="wrap">
                <th colspan="2">
                    Nombre<br>
                    <?= HTML::listInputTranslate('nombre', '', 'input', array(
                        'onblur' => 'setValuesByLangForForm(this,"form4")',
                        'style' => 'width: 80%'
                    )) ?>
                    <?php /*
                    Descripci&oacute;n<br>
                    <?= HTML::listInputTranslate('descripcion', '', 'textarea', array(
                        'onblur' => 'setValuesByLangForForm(this,"form4")',
                    )) ?> */?>
                </th>
            </tr>

            </tbody>
        </table>
        <?= HTML::button_primary('Añadir Habitacion') ?>
    </form>
    <HR>
    <form id="form2" enctype="multipart/form-data" method="post" action="<?= get_admin_url() ?>admin.php"
          style="width:100%; display: <?= $item->id ? 'inline-block' : 'none' ?>">
        <input type="hidden" name="controller" value="Alojamiento.upLoadImg">
        <input type="hidden" name="Alojamiento_id" value="<?= $item->id ?>">

        <h3>Imagenes de Alojamiento</h3>
        <input type="file" name="foto" placeholder="Subir nueva foto">
        <?= HTML::button_primary('Subir Imagen') ?>
        <table class="form-table">
            <tbody>
            <tr class="wrap">
                <th><label>Titular</label></th>
                <td>
                    <?= HTML::listInputTranslate('nombre', '', 'input', array(
                        'onblur' => 'setValuesByLang2(this)',
                        'required' => 'required'
                    )) ?>
                </td>
            </tr>
            <tr class="wrap">
                <th><label>URL</label></th>
                <td>
                    <input type="text" name="foto">
                </td>
            </tr>
            </tbody>
        </table>
        <?php $imgs = $item->getImagenAlojamientos();
        $n = count($imgs); ?>
        <?php for ($i = $n - 1; $i >= 0; $i--): ?>
            <?php $img = $imgs[$i]; ?>
            <div
                style="display: inline-block; width: 30%; margin: 2px; border: 2px solid #e14d43; background-color: #e14d43; color: #f5f5f5">
                <img src="<?= HTML::getFoto(HTML::IMG_ALOJAMIENTO, $img->foto) ?>" width="100%" style="max-height: 100px"><br>
                <?php /*echo HTML::link_buttonVM('|','cs_mvc_imagen_alojamientos','admin/ImagenAlojamiento_edit','ImagenAlojamiento',$img->id) */ ?>
                <a target="_blank"
                   href="admin.php/<?= View::genPathVM('cs_mvc_imagen_alojamientos', 'admin/ImagenAlojamiento_edit', 'ImagenAlojamiento', $img->id) ?>"
                   style="float:left; background: #FFFFFF; color: #000066; text-decoration: none; padding: 0 4px; border: dotted 2px #000000">
                    <b>Edit</b></a>
                <a href="#"
                   style="float:right; background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"
                   onclick="deleteImg(this,<?= $img->id ?>)"><b>X</b></a>
                <span style="font-size: 10"><?= HTML::truncate(__($img->nombre), 7) ?></span>
            </div>
        <?php endfor ?>
    </form>

</div>
<div style="clear: both"></div>
<script>

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

    function deleteImg(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_alojamientos","Alojamiento","deleteImg")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().hide('slow');
            }
        });
        event.preventDefault();
    }
    function deleteHabitacion(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_habitaciones","Habitacion","removeJSON")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().hide('slow');
            }
        });
        event.preventDefault();
    }


</script>