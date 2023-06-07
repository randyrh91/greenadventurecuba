<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ReservaExcursionViewModel();
$item = $model->getReservaExcursion();
$user = $model->getUser();
?>
<div class="wrap">
    <?php if ($item->id): ?>
        <h2>Editando Reserva de Excursion #<?= __($item->id) ?>: <?= __($item->__toString()) ?></h2>
    <?php else: ?>
        <h2>Agregando Reserva de Excursion</h2>
    <?php endif ?>
    <form method="post" style="float: left;width: 100%">
        <input type="hidden" name="controller" value="ReservaExcursion.save">
        <input type="hidden" name="id" value="<?= $item->id ?>">

        <div style="width: 60%; float: left">

            <table class="form-table">
                <tbody>
                <tr>
                    <td colspan="2">
                        <input name="id" type="hidden" value="<?= __($item->id) ?>">
                    </td>
                </tr>

                <tr class="wrap">
                    <th><label>Fecha</label></th>
                    <td>
                        <input name="fecha" type="date" value="<?= $item->getFecha() ?>">
                    </td>
                </tr>

                <tr class="wrap">
                    <th><label>Lugar de Recogida</label></th>
                    <td>
                        <textarea style="width: 80%" name="hora"><?= $item->hora ?></textarea>
                    </td>
                </tr>

                <tr class="wrap">
                    <th><label>Precio</label></th>
                    <td>
                        <input name="precioOferta" type="text" value="<?= __($item->precioOferta) ?>">
                    </td>
                </tr>

                <tr class="wrap">
                    <th><label>Pax</label></th>
                    <td>
                        <input name="cantidadPersona" type="text" value="<?= __($item->cantidadPersona) ?>">
                    </td>
                </tr>

                <tr class="wrap">
                    <th><label>EstadoReserva</label></th>
                    <td>
                        <?= HTML::dropDownList('EstadoReserva_id', $model->getEstadoReservas(), $item->EstadoReserva_id) ?>
                    </td>
                </tr>
                <tr class="wrap">
                    <th><label>Excursi&oacute;n</label></th>
                    <td>
                        <?= HTML::dropDownList('Excursion_id', $model->getExcursiones(), $item->Excursion_id) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div style="width: 40%; float: left">
            <h3>Formulario de Usuario</h3>
            <input type="hidden" name="controller" value="ReservaExcursion.save">
            <input type="hidden" name="id" value="<?= $item->id ?>">
            <table class="form-table">
                <tbody>
                <tr class="wrap">
                    <th><label>Email</label></th>
                    <td>
                        <input name="User_ID" type="text" value="<?= __($item->User_ID) ?>">
                    </td>
                </tr>
                <tr class="wrap">
                    <th><label>Nombre</label></th>
                    <td>
                        <input name="nombre" type="text" value="<?= $user->nombre ?>">
                    </td>
                </tr>
                <tr class="wrap">
                    <th><label>Apellido</label></th>
                    <td>
                        <input name="apellido" type="text" value="<?= $user->apellido ?>">
                    </td>
                </tr>
                <tr class="wrap">
                    <th><label>Pais</label></th>
                    <td>
                        <input name="pais" type="text" value="<?= $user->pais ?>">
                    </td>
                </tr>
                <tr class="wrap">
                    <th><label>Lenguaje</label></th>
                    <td>
                        <select class="form-control" id="book_lenguaje" name="lenguaje">
                            <option>Other Language</option>
                            <?php $c_lan = $user->lenguaje;
                            foreach ($model->getLanguages() as $lan => $name): ?>
                                <option
                                    value="<?= $lan ?>" <?= $lan == $c_lan ? 'selected' : '' ?> ><?= $name ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div style="clear: both"></div>
        <h4>Descripcion</h4>
        <textarea style="width: 100%" name="descripcion"><?= $item->descripcion ?></textarea>
        <hr>
        <div class="right">
            <?= HTML::button_primary('Guardar') ?>
            <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_reserva_excursiones') ?>
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