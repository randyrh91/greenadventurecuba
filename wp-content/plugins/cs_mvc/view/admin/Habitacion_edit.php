<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
require_once CS_MVC_PATH_VMODEL . '/HabitacionViewModel.php';
$model = new HabitacionViewModel();
$item = $model->getHabitacion();
$alojamiento = $item->getAlojamiento();
?>
<div class="wrap">
    <ul class="breadcrumb label">
        <li class="breadcrumb-item"><a href="<?= View::genPathVM("cs_mvc_alojamientos") ?>">Listado de Alojamientos</a>
        </li>
        <li class="breadcrumb-item"><a
                href="<?= View::genPathVM("cs_mvc_alojamientos", "admin/Alojamiento_edit", 'Alojamiento', $alojamiento->id) ?>"><?= __($alojamiento->nombre) ?></a>
        </li>
        <li>D&iacute;a <?= $item->orden . ' ' . __($item->__toString()) ?></li>
    </ul>

    <?php if ($item->id): ?>
        <h2>Editando Habitacion: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando Habitacion</h2>
    <?php endif ?>
    <form method="post">
        <input type="hidden" name="controller" value="Habitacion.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>
            <tr class="wrap">
                <th><label>Orden</label></th>
                <td>
                    <input name="orden" type="number" value="<?= $item->cantMax ?>">
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Capacidad</label></th>
                <td>
                    <input name="cantMax" type="number" value="<?= $item->orden ?>">
                </td>
            </tr>

            <tr class="wrap">
                <th colspan="2">
                    <label>Precio Baja ($)</label> <input required="" name="precioBaja" value="<?= $item->precioBaja ?>"> |
                    <label>Precio Alta ($)&nbsp;</label> <input required="" name="precio" value="<?= $item->precio ?>">
                </th>
            </tr>
            <tr class="wrap">
                <th><label>ServiciosAlojamientos</label></th>
                <td><?= HTML::listBox('servicios', $model->getServicios(), $item->getServicios()) ?></td>
            </tr>


            <tr class="wrap">
                <th><label>Nombre</label></th>
                <td>
                    <?= HTML::listInputTranslate('nombre', $item->nombre, 'input', array(
                        'onblur' => 'setValuesByLang(this)',
                        'required' => 'required'
                    )) ?>
                </td>
            </tr>

            <tr class="wrap">
                <th><label>Descripcion</label></th>
                <td>
                    <?= HTML::listInputTranslate('textoCorto', $item->descripcion, 'textarea', array(
                        'onblur' => 'setValuesByLang(this)'
                    )) ?>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_alojamientos') ?>
        </div>
    </form>
    <HR>
    <form id="form2" enctype="multipart/form-data" method="post" action="<?= get_admin_url() ?>admin.php"
          style="width:100%; display: <?= $item->id ? 'inline-block' : 'none' ?>">
        <input type="hidden" name="controller" value="Habitacion.upLoadImg">
        <input type="hidden" name="Habitacion_id" value="<?= $item->id ?>">

        <h3>Imagenes de Habitacion</h3>
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
        <hr>
        <?php $imgs = $item->getImagenHabitaciones();
        $n = count($imgs); ?>
        <?php for ($i = $n - 1; $i >= 0; $i--): ?>
            <?php $img = $imgs[$i]; ?>
            <div
                style="display: inline-block; width: 30%; margin: 2px; border: 2px solid #e14d43; background-color: #e14d43; color: #f5f5f5">
                <img src="<?= HTML::getFoto(HTML::IMG_HABITACION, $img->foto) ?>" width="100%" style="max-height: 100px"><br>
                <?php /*echo HTML::link_buttonVM('|','cs_mvc_imagen_habitaciones','admin/ImagenHabitacion_edit','ImagenHabitacion',$img->id) */ ?>
                <?php /*
                <a target="_blank"
                   href="admin.php/<?= View::genPathVM('cs_mvc_imagen_habitaciones', 'admin/ImagenHabitacion_edit', 'ImagenHabitacion', $img->id) ?>"
                   style="float:left; background: #FFFFFF; color: #000066; text-decoration: none; padding: 0 4px; border: dotted 2px #000000">
                    <b>Edit</b></a> */?>
                <a href="#"
                   style="float:right; background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"
                   onclick="deleteImg(this,<?= $img->id ?>)"><b>X</b></a>
                <span style="font-size: 10"><?= HTML::truncate(__($img->nombre), 7) ?></span>
            </div>
        <?php endfor ?>
    </form>
</div>
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
    function deleteImg(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_alojamientos","Habitacion","deleteImg")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                $(btn).parent().hide('slow');
            }
        });
        event.preventDefault();
    }
</script>