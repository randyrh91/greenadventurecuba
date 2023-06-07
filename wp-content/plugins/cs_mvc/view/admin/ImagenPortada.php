<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ImagenPortadaViewModel();
$cells = $model->getCelsAssoc();
?>
<div class="wrap" id="portada_wrap">
    <h2>Articulos por posiciones en Portada</h2>
    <table class="wp-list-table widefat fixed">
        <tbody>
        <tr>
            <th colspan="2">
                <h4 align="center">Principal</h4>
                <hr>
                <form method="post" id="form1"  action="<?= get_admin_url() ?>admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="controller" value="ImagenPortada.saveCell">
                    <input type="hidden" name="id" value="<?= $cells[0]->id ?>">
                    <table width="100%">
                        <tr class="wrap">
                            <th><label>Nombre</label></th>
                            <td>
                                <?= HTML::listInputTranslate('nombre', $cells[0]->nombre, 'input', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form1")'
                                )) ?>
                            </td>
                        </tr>
                        <tr class="wrap">
                            <th><label>Texto Corto</label></th>
                            <td>
                                <?= HTML::listInputTranslate('textoCorto', $cells[0]->textoCorto, 'textarea', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form1")'
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
                            <th><label>Post</label></th>
                            <td>
                                <a href="./post.php?post=<?= $cells[0]->Post_ID ?>&action=edit"
                                   class="button"><b><?= ($cells[0]->Post_ID)
                                            ? '<u>' . $cells[0]->Post_ID . '</u> | ' . __(get_post($cells[0]->Post_ID)->post_title)
                                            : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                                    </b></a>
                                <select style="width: 100%"
                                        onchange="jQuery('#Post_ID_cell1').val(jQuery(this).val())">
                                    <option>---</option>
                                    <?php foreach (CellPortadaRepo::create()->getAllPosts() as $post): ?>
                                        <option <?= $post->ID == $cells[0]->Post_ID ? 'selected' : '' ?>
                                            value="<?= $post->ID ?>"> <?= '<u>' . $post->ID . '</u> | ' . __($post->post_title) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input id="Post_ID_cell1" name="Post_ID" type="hidden" value="<?= __($cells[0]->Post_ID) ?>">
                            </td>
                        </tr>
                    </table>
                    <input type="submit" style="float: right" class="button button-primary">
                </form>
            </th>
        </tr>
        <tr>
            <td>
                <h4 align="center">Izquierda</h4>
                <hr>
                <form method="post" id="form2"  action="<?= get_admin_url() ?>admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="controller" value="ImagenPortada.saveCell">
                    <input type="hidden" name="id" value="<?= $cells[1]->id ?>">
                    <table width="100%">
                        <tr class="wrap">
                            <th><label>Nombre</label></th>
                            <td>
                                <?= HTML::listInputTranslate('nombre', $cells[1]->nombre, 'input', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form2")'
                                )) ?>
                            </td>
                        </tr>
                        <tr class="wrap">
                            <th><label>Texto Corto</label></th>
                            <td>
                                <?= HTML::listInputTranslate('textoCorto', $cells[1]->textoCorto, 'textarea', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form2")'
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
                            <th><label>Post</label></th>
                            <td>
                                <a href="./post.php?post=<?= $cells[1]->Post_ID ?>&action=edit"
                                   class="button"><b><?= ($cells[1]->Post_ID)
                                            ? '<u>' . $cells[1]->Post_ID . '</u> | ' . __(get_post($cells[1]->Post_ID)->post_title)
                                            : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                                    </b></a>
                                <select style="width: 100%"
                                        onchange="jQuery('#Post_ID_cell2').val(jQuery(this).val())">
                                    <option>---</option>
                                    <?php foreach (CellPortadaRepo::create()->getPosts() as $post): ?>
                                        <option <?= $post->ID == $cells[1]->Post_ID ? 'selected' : '' ?>
                                            value="<?= $post->ID ?>"> <?= '<u>' . $post->ID . '</u> | ' . __($post->post_title) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input id="Post_ID_cell2" name="Post_ID" type="hidden" value="<?= __($cells[1]->Post_ID) ?>">
                            </td>
                        </tr>
                    </table>
                    <input type="submit" style="float: right" class="button button-primary">
                </form>
            </td>
            <td>
                <h4 align="center">Derecha</h4>
                <hr>
                <form method="post" id="form3"  action="<?= get_admin_url() ?>admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="controller" value="ImagenPortada.saveCell">
                    <input type="hidden" name="id" value="<?= $cells[2]->id ?>">
                    <table width="100%">
                        <tr class="wrap">
                            <th><label>Nombre</label></th>
                            <td>
                                <?= HTML::listInputTranslate('nombre', $cells[2]->nombre, 'input', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form3")'
                                )) ?>
                            </td>
                        </tr>
                        <tr class="wrap">
                            <th><label>Texto Corto</label></th>
                            <td>
                                <?= HTML::listInputTranslate('textoCorto', $cells[2]->textoCorto, 'textarea', array(
                                    'onblur' => 'setValuesByLangForForm(this, "form3")'
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
                            <th><label>Post</label></th>
                            <td>
                                <a href="./post.php?post=<?= $cells[2]->Post_ID ?>&action=edit"
                                   class="button"><b><?= ($cells[2]->Post_ID)
                                            ? '<u>' . $cells[2]->Post_ID . '</u> | ' . __(get_post($cells[2]->Post_ID)->post_title)
                                            : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                                    </b></a>
                                <select style="width: 100%"
                                        onchange="jQuery('#Post_ID_cell3').val(jQuery(this).val())">
                                    <option>---</option>
                                    <?php foreach (CellPortadaRepo::create()->getPosts() as $post): ?>
                                        <option <?= $post->ID == $cells[2]->Post_ID ? 'selected' : '' ?>
                                            value="<?= $post->ID ?>"> <?= '<u>' . $post->ID . '</u> | ' . __($post->post_title) ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input id="Post_ID_cell3" name="Post_ID" type="hidden" value="<?= __($cells[2]->Post_ID) ?>">
                            </td>
                        </tr>
                    </table>
                    <input type="submit" style="float: right" class="button button-primary">
                </form>
            </td>
        </tr>
        </tbody>
    </table>

    <h2>Imagenes de Portada(<?= count($model->getImagenPortadas()) ?>
        ) <?= HTML::link_buttonVM('+ A&ntilde;adir Nuevo', 'cs_mvc_imagen_portadas', 'admin/ImagenPortada_edit', 'ImagenPortada', '', 'add-new-h2') ?>
        <form action="./admin.php" style="float: right">
            <input type="hidden" name="page" value="cs_mvc_imagen_portadas">
            <input type="search" name="q" value="<?= View::in('q') ?>">
            <input type="submit" class="button" value="Filtrar">
        </form>
    </h2>
    <table class="wp-list-table widefat fixed">
        <thead>
        <th width="30px">Id</th>
        <th width="100px">Foto</th>
        <th>Nombre</th>
        <th>Post</th>
        <th width="20%">Acciones</th>
        </thead>
        <tbody>
        <?php foreach ($model->getImagenPortadas() as $item): ?>
            <tr>
                <td><b><?= HTML::truncate(__($item->id)) ?></b></td>
                <td><img src="<?= View::getFoto(HTML::IMG_PORTADA, $item->foto) ?>" width="100px"></td>
                <td><?= HTML::truncate(__($item->nombre)) ?></td>
                <td>
                    <a href="./post.php?post=<?= $item->Post_ID ?>&action=edit"
                       class="button"><b><?= ($item->Post_ID)
                                ? '<u>' . $item->Post_ID . '</u> | ' . __(get_post($item->Post_ID)->post_title)
                                : 'No ha seleccionado ninguna Pagina<br>Cree una Nueva y Asignala luego...' ?>
                        </b></a>
                </td>
                <td>
                    <?= HTML::link_buttonVM('Editar', 'cs_mvc_imagen_portadas', 'admin/ImagenPortada_edit', 'ImagenPortada', $item->id) ?>
                    <?= HTML::link_buttonCA('Eliminar', 'cs_mvc_imagen_portadas', 'ImagenPortada', "remove&id=$item->id") ?>

                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
