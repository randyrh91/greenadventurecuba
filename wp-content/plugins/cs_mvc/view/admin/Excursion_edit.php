<?php
/**
 * Created by CS-Genarator.
 * User: pr0x
 */
$model = new ExcursionViewModel();
$item = $model->getExcursion();
$viajes = $item->getViajes();
?>
<div class="wrap">
<ul class="breadcrumb label">
    <li class="breadcrumb-item"><a href="<?= View::genPathVM("cs_mvc_excursiones") ?>">Listado de Excurisiones</a></li>
    <li><?= $item->id ? __($item->nombre) . ' - ' . $item->id : 'Nueva Excursion' ?></li>
</ul>
<?php if ($item->id): ?>
    <h2>Editando Excursion: <?= __($item->__toString()) ?></h2>
<?php else: ?>
    <h2>Agregando Excursion</h2>
<?php endif ?>
<form id="form1" method="post" action="<?= get_admin_url() ?>admin.php"
      style="float: left; width: <?= $item->id ? 60 : 100 ?>%">
    <input type="hidden" name="controller" value="Excursion.save">
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
            <th><label>Tipo de Excursi&oacute;n</label></th>
            <td>
                <?= HTML::dropDownList('TipoExcursion_id', $model->getTipoExcursiones(), $item->TipoExcursion_id, array(
                    'required' => 'required'
                )) ?>
            </td>

        </tr>
        <tr class="wrap">
            <th><label>Precio ($)</label></th>
            <td>
                <input required="" name="precio" value="<?= __($item->precio) ?>">
            </td>
        </tr>

        <tr class="wrap">
            <th><label>Modalidades</label></th>
            <td><?= HTML::listBox('modalidades', $model->getModalidades(), $item->getModalidades()) ?></td>
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
            <th><label>Dias</label></th>
            <td>
                <input name="cantDias" type="number" value="<?= __($item->cantDias) ?>">
            </td>
        </tr>

        <tr class="wrap">
            <th><label>P&aacute;gina de Excursi&oacute;n</label></th>
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
                    <?php foreach (ExcursionRepo::create()->getPosts() as $post): ?>
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
        <?= HTML::link_buttonVM('Ver Listado', 'cs_mvc_excursiones') ?>
    </div>
</form>
<div style="width:36%; float: right; display: <?= $item->id ? 'inline-block' : 'none' ?>">
    <h3>D&iacute;as / Destinos a Visitar(<?= count($viajes) ?>)</h3>
    <hr>
    <?php
    /** @var ViajeModel $v */
    foreach ($viajes as $v):?>
        <div
            style="display: inline-block; width: 100%; padding: 8px 0px;  font-size: 14px; margin: 2px; border: 2px solid #3C2BB6; background-color: #3C2BB6; color: #f5f5f5">
            <a
               href="admin.php/<?= View::genPathVM('cs_mvc_excursiones', 'admin/Viaje_edit', 'Viaje', $v->id) ?>"
               style="float: left;background: #FFFFFF; color: #3C2BB6; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"><b>Edit</b></a>
            <a href="#"
               style="float: right;background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"
               onclick="deleteViaje(this,<?= $v->id ?>)"><b>X</b></a>
            <b style="margin-left: 20px;">D&iacute;a - (<?= $v->orden ?>) <?= HTML::truncate(__($v->destino)) ?></b>
        </div>
    <?php endforeach ?>
    <form id="form4" method="post" action="<?= get_admin_url() ?>admin.php">
        <input type="hidden" name="controller" value="Excursion.saveDestinoTuristico">
        <input type="hidden" name="Excursion_id" value="<?= $item->id ?>">
        <input type="hidden" name="id" value="0">
        <table class="form-table">
            <tbody>
            <tr class="wrap">
                <th><label>Dia</label></th>
                <td>
                    <input name="orden" type="number" value="1">
                </td>
            </tr>
            <tr class="wrap">
                <th colspan="2">
                    Destino<br>
                    <?= HTML::listInputTranslate('destino', '', 'input', array(
                        'onblur' => 'setValuesByLangForForm(this,"form4")',
                        'style' => 'width: 80%'
                    )) ?>
                    <?php /*
                    Descripci&oacute;n<br>
                    <?= HTML::listInputTranslate('descripcion', '', 'textarea', array(
                        'onblur' => 'setValuesByLangForForm(this,"form4")',
                    )) ?> */
                    ?>
                </th>
            </tr>
            <?php /*
            <tr class="wrap">
                <th><label>Destino</label></th>
                <td>
                    <?= HTML::dropDownList('DestinoTuristico_id', $model->getDestinoTuristicos(), 0, array(
                        'required' => 'required', 'style' => 'width:100%'
                    )) ?>
                </td>
            </tr>
            */?>
            <tr class="wrap">
                <th colspan="2">
                    Alojamiento<br>
                    <?= HTML::listInputTranslate('alojamiento_descripcion', '', 'input', array(
                        'onblur' => 'setValuesByLangForForm(this,"form4")',
                        'style' => 'width: 80%'
                    )) ?>
                </th>
            </tr>
            </tbody>
        </table>
        <?= HTML::button_primary('Añadir Dia') ?>
    </form>
    <HR>
    <form id="form5">
        <h3>Programa Incluye</h3>
        <b>Descripcion</b><br>
        <?= HTML::listInputTranslate('nombre', '', 'input', array(
            'onblur' => 'setValuesByLangForForm(this,"form4")',
            'style' => 'width: 80%'
        )) ?><br>
        <button class="button button-primary" data-bind="click: addIncluido">Añadir Observacion</button>
        <ul data-bind="foreach: observaciones_incluye">
            <li>
            <span lang="en" class="qtranxs-lang-switch"><img src="<?= qtranxf_flag_location() ?>gb.png"> <span
                    style="text-transform: uppercase">en</span></span>
                <input type="text" data-bind="value:nombre_en" style="width: 80%">
                <a href="#"
                   style="float: right;background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000; margin-top: 3px"
                   data-bind="click: $root.removeIncluido"
                ><b>X</b></a>
                <br>
            <span lang="en" class="qtranxs-lang-switch"><img src="<?= qtranxf_flag_location() ?>es.png"> <span
                    style="text-transform: uppercase">en</span></span>
                <input type="text" data-bind="value:nombre_es" style="width: 80%">
            </li>
        </ul>
        <p align="center" data-bind="if: observaciones_incluye().length==0"><span>Sin Observaciones</span></p>
        <button data-bind="click: $root.saveIncluido" class="button button-primary">Guardar Cambios de Observaciones</button>
    </form>
    <HR>
    <form id="form6">
        <h3>Programa No Incluye</h3>
        <b>Descripcion</b><br>
        <?= HTML::listInputTranslate('nombre', '', 'input', array(
            'onblur' => 'setValuesByLangForForm(this,"form4")',
            'style' => 'width: 80%'
        )) ?><br>
        <button class="button button-primary" data-bind="click: addNoIncluido">Añadir Observacion</button>
        <ul data-bind="foreach: observaciones_no_incluye">
            <li>
                <span lang="en" class="qtranxs-lang-switch"><img src="<?= qtranxf_flag_location() ?>gb.png"> <span
                        style="text-transform: uppercase">en</span></span>
                <input type="text" data-bind="value:nombre_en" style="width: 80%">
                <a href="#"
                   style="float: right;background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000; margin-top: 3px"
                   data-bind="click: $root.removeNoIncluido"
                    ><b>X</b></a>
                <br>
                <span lang="en" class="qtranxs-lang-switch"><img src="<?= qtranxf_flag_location() ?>es.png"> <span
                        style="text-transform: uppercase">en</span></span>
                <input type="text" data-bind="value:nombre_es" style="width: 80%">
            </li>
        </ul>
        <p align="center" data-bind="if: observaciones_no_incluye().length==0"><span>Sin Observaciones</span></p>
        <button data-bind="click: $root.saveNoIncluido" class="button button-primary">Guardar Cambios de Observaciones</button>
    </form>
    <script>
        function ViewModel() {
            var self = this;
            self.observaciones_incluye = ko.observableArray([]);
            self.observaciones_no_incluye = ko.observableArray([]);

            self.addIncluido = function () {
                var e = {
                    orden : self.observaciones_incluye.length + 1,
                    nombre_es:document.querySelector('#form5').querySelector("input[name=nombre_es]").value,
                    nombre_en:document.querySelector('#form5').querySelector("input[name=nombre_en]").value,
                };
                e.nombre = "[:en]" + e.nombre_en + "[:es]" + e.nombre_es;
                var o = new Observacion(e);
                self.observaciones_incluye.push(o);
            };
            self.removeIncluido = function (e) {
                self.observaciones_incluye.remove(e);
            };

            self.addNoIncluido = function () {
                var e = {
                    orden : self.observaciones_no_incluye.length + 1,
                    nombre_es:document.querySelector('#form6').querySelector("input[name=nombre_es]").value,
                    nombre_en:document.querySelector('#form6').querySelector("input[name=nombre_en]").value,
                };
                e.nombre = "[:en]" + e.nombre_en + "[:es]" + e.nombre_es;
                var o = new Observacion(e);
                self.observaciones_no_incluye.push(o);
            }
            self.removeNoIncluido = function (e) {
                self.observaciones_no_incluye.remove(e);
            };

            self.saveIncluido = function () {
                jQuery.each(vm.observaciones_incluye(), function (i, item) {
                    item.nombre( "[:en]" + item.nombre_en() + "[:es]" + item.nombre_es());
                });
                jQuery.post('<?=View::create()->genPathCA("cs_mvc_excursiones","Excursion","saveObservacionesIncluyeJSON&id=".$item->id)?>',ko.toJSON(vm.observaciones_incluye), function () {

                });
            }

            self.saveNoIncluido = function () {
                jQuery.each(vm.observaciones_no_incluye(), function (i, item) {
                    item.nombre( "[:en]" + item.nombre_en() + "[:es]" + item.nombre_es());
                });
                jQuery.post('<?=View::create()->genPathCA("cs_mvc_excursiones","Excursion","saveObservacionesNoIncluyeJSON&id=".$item->id)?>',ko.toJSON(vm.observaciones_no_incluye), function () {

                });
            }
        }
        function Observacion(e) {
            var self = this;
            self.id = ko.observable(e.id || 0);
            self.orden = ko.observable(e.orden || 0);
            self.nombre_en = ko.observable(e.nombre_en || "");
            self.nombre_es = ko.observable(e.nombre_es || "");
            self.nombre = ko.observable("[:en]" + e.nombre_en + "[:es]" + e.nombre_es);
            self.isIncluye = ko.observable(e.isIncluye || 0);
            if(e.descripcion) {
                var lang_obj = __obj(e.descripcion);
                self.nombre(e.descripcion);
                self.nombre_en(lang_obj.en);
                self.nombre_es(lang_obj.es);
            }
        }
        var vm = new ViewModel();
        jQuery(function ($) {
            $.post('<?=View::create()->genPathCA("cs_mvc_excursiones","Excursion","observacionesJSON")?>',{id:<?=$item->id?>}, function (response) {
                if(response.success) {
                    $.each(response.data, function (i, item) {
                        var obj = new Observacion(item);
                        if(item.isIncluye==1)
                            vm.observaciones_incluye.push(obj);
                        else vm.observaciones_no_incluye.push(obj);
                    })
                }
            });
        })

                //test
//        vm.observaciones_incluye([
//            new Observacion({
//                id: 1, orden: 1, nombre_es: "Observacion 1", nombre_en: "Observation 1", isIncluye: 1
//            }),
//            new Observacion({
//                id: 2, orden: 2, nombre_es: "Observacion 2", nombre_en: "Observation 2", isIncluye: 1
//            }),
//            new Observacion({
//                id: 2, orden: 2, nombre_es: "Observacion 2", nombre_en: "Observation 2", isIncluye: 1
//            }),
//            new Observacion({
//                id: 2, orden: 2, nombre_es: "Observacion 2", nombre_en: "Observation 2", isIncluye: 1
//            }),
//            new Observacion({
//                id: 3, orden: 3, nombre_es: "Observacion 3", nombre_en: "Observation 3", isIncluye: 1
//            })
//        ])
        ko.applyBindings(vm);
    </script>

    <?php /*
    <h3>Servicios de Excursi&oacute;n</h3>
    <hr>
    <table>
        <tr>
            <th width="45%">Existentes</th>
            <th>&nbsp;</th>
            <th width="45%">Asignados</th>
        </tr>
        <tr>
            <td>
                <?= HTML::listBox("servicios_noasig", $item->getServicioNoAsignados(), 0, array(
                    "style" => "width: 100%"
                )) ?>
            </td>
            <td>
                <button onclick="asingServ(this)" class="button-primary">&gt;</button>
                <button onclick="noAsingServ(this)" class="button-primary">&lt;</button>
            </td>
            <td>
                <?= HTML::listBox("servicios_asig", $item->getServicios(), 0, array(
                    "style" => "width: 100%"
                )) ?>
            </td>

        </tr>
    </table>
    */
    ?>
</div>


<div style="clear: both"></div>
<hr>
<form id="form2" enctype="multipart/form-data" method="post" action="<?= get_admin_url() ?>admin.php"
      style="width:46%%; float: right; display: <?= $item->id ? 'inline-block' : 'none' ?>">
    <input type="hidden" name="controller" value="Excursion.upLoadImg">
    <input type="hidden" name="Excursion_id" value="<?= $item->id ?>">

    <h3>Imagenes de Excursi&oacute;n</h3>
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
    <?php $imgs = $item->getImagenExcursiones();
    $n = count($imgs); ?>
    <?php for ($i = $n - 1; $i >= 0; $i--): ?>
        <?php $img = $imgs[$i]; ?>
        <div
            style="display: inline-block; width: 30%; margin: 2px; border: 2px solid #e14d43; background-color: #e14d43; color: #f5f5f5">
            <img src="<?= HTML::getFoto(HTML::IMG_EXCURSION, $img->foto) ?>" width="100%" style="max-height: 100px"><br>
            <?php /*echo HTML::link_buttonVM('|','cs_mvc_imagen_excursiones','admin/ImagenExcursion_edit','ImagenExcursion',$img->id) */ ?>
            <a target="_blank"
               href="admin.php/<?= View::genPathVM('cs_mvc_imagen_excursiones', 'admin/ImagenExcursion_edit', 'ImagenExcursion', $img->id) ?>"
               style="float:left; background: #FFFFFF; color: #000066; text-decoration: none; padding: 0 4px; border: dotted 2px #000000">
                <b>Edit</b></a>
            <a href="#"
               style="float:right; background: #FFFFFF; color: #e14d43; text-decoration: none; padding: 0 4px; border: dotted 2px #000000"
               onclick="deleteImg(this,<?= $img->id ?>)"><b>X</b></a>
            <span style="font-size: 10"><?= HTML::truncate(__($img->nombre), 7) ?></span>
        </div>
    <?php endfor ?>
</form>

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
        $.post('<?=View::genPathCA("cs_mvc_excursiones","Excursion","deleteImg")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().hide('slow');
            }
        });
        event.preventDefault();
    }
    function deleteViaje(btn, id) {
        var $ = jQuery;
        $.post('<?=View::genPathCA("cs_mvc_viajes","Viaje","removeJSON")?>', {id: id}, function (response) {
            console.log(response);
            if (response.success) {
                console.log($(btn).parent());
                $(btn).parent().hide('slow');
            }
        });
        event.preventDefault();
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