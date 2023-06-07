<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenPortadaViewModel();
$item = $model->getImagenPortada();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando ImagenPortada: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando ImagenPortada</h2>
    <?php endif ?>
    <form enctype="multipart/form-data" method="post">
        <input type="hidden" name="controller" value="ImagenPortada.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>
            <tr>
                <td colspan="2">
                    <input name="id" type="hidden" value="<?= __($item->id) ?>">
                </td>
            </tr>

            <tr class="wrap">
                <th><label>Nombre</label></th>
                <td>
                    <?= HTML::listInputTranslate('nombre', $item->nombre, 'textarea', array(
                        'onblur' => 'setValuesByLang(this)'
                    )) ?>
                </td>
            </tr>

            <tr class="wrap">
                <th><label>Foto</label></th>
                <td>
                    <input type="file" name="foto">
                </td>
            </tr>

            <tr class="wrap">
                <th><label>Texto Corto</label></th>
                <td>
                    <?= HTML::listInputTranslate('textoCorto', $item->textoCorto, 'textarea', array(
                        'onblur' => 'setValuesByLang(this)'
                    )) ?>
                </td>
            </tr>
            <tr class="wrap">
                <th><label>Post</label></th>
                <td>
                    <a href="./post.php?post=<?= $item->Post_ID ?>&action=edit"
                       class="button"><b><?= ($item->Post_ID)
                                ? '<u>' . $item->Post_ID . '</u> | ' . __(get_post($item->Post_ID)->post_title)
                                : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                        </b></a>
                    <select style="width: 100%"
                            onchange="jQuery('#Post_ID_cell2').val(jQuery(this).val())">
                        <option>---</option>
                        <?php foreach (CellPortadaRepo::create()->getAllPosts() as $post): ?>
                            <option <?= $post->ID == $item->Post_ID ? 'selected' : '' ?>
                                value="<?= $post->ID ?>"> <?= '<u>' . $post->ID . '</u> | ' . __($post->post_title) ?></option>
                        <?php endforeach ?>
                    </select>
                    <input id="Post_ID_cell2" name="Post_ID" type="hidden" value="<?= __($item->Post_ID) ?>">
                </td>
            </tr>

            </tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_imagen_portadas') ?>
        </div>
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
</script>