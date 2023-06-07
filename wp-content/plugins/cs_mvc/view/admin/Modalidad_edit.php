<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ModalidadViewModel();
$item = $model->getModalidad();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando Modalidad: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando Modalidad</h2>
    <?php endif ?>
    <form method="post">
        <input type="hidden" name="controller" value="Modalidad.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <table class="form-table">
            <tbody>

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
                <th><label>TextoCorto</label></th>
                <td>
                    <?= HTML::listInputTranslate('textoCorto', $item->textoCorto, 'textarea', array(
                        'onblur' => 'setValuesByLang(this)'
                    )) ?>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_modalidades') ?>
        </div>
    </form>
</div>
