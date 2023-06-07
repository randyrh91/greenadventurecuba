<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
require_once CS_MVC_PATH_VMODEL . '/ExcursionViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/BookViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/RatingViewModel.php';

$model = new BookViewModel();
$excursion = $model->getExcursion();

//Lo nuevo
$ratinModel = new RatingViewModel();
$porcientos = array();
$post = get_post();
$id = get_post_field('id', $post);
$porcientos = $ratinModel->getPorciento($id);


?>

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--<script src="gmaps.js"></script>-->
<!--<script src="http://localhost/cubaporfavor.com/wp-content/plugins/cs_mvc/assetic/gmaps.js"></script>-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>-->
<div class="container-fluid no-padding">
    <div class="row-fluid">
        <div class="span9">
            <h1 class="nombre-excursion" style="text-align: center"><em
                    class="fa fa-book"></em> <?= __($excursion->nombre) ?>.
                <a href="#form_reserva" style="color: red;font-style: italic;"><?= __(CS_L_BOOKNOW) ?></a></h1>
            <?php //the_content(); ?>
        </div>
        <hr class="hidden-xs">
        <!--        <div style="text-align: justify">-->
        <?php //echo __($excursion->descripcion)?>
        <!--        </div>-->
    </div>
    <div class="row-fluid">
        <!--            Informacion-->
        <div class="col-xs-12 col-md-7 col-sm-7 right-hr">

            <!--            Carrusel-->
            <div id="carousel-example-generic" class="carousel slide" data-slide="next">
                <ol class="carousel-indicators">
                    <?php /** @var ImagenExcursionModel $fotos */
                    $fotos = $excursion->getImagenExcursiones();
                    $i = 0;
                    foreach ($fotos as $foto): ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"
                            class="<?= $i == 0 ? 'active' : '' ?>"></li>
                        <?php $i++; endforeach ?>
                </ol>
                <div class="carousel-inner">
                    <?php $i = 0;
                    foreach ($fotos as $foto): ?>
                        <div class="item <?= $i == 0 ? 'active' : '' ?>">
                            <img
                                src="<?= View::getFoto($foto->foto) ?>">

                            <div class="carousel-caption">
                                <h4><?= __($foto->nombre) ?></h4>

                                <p><?= __($excursion->nombre) ?></p>
                            </div>
                        </div>
                        <?php $i++; endforeach ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="icon-prev">‹</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="icon-next">›</span>
                </a>
            </div>

        </div>
        <div class="col-xs-12 col-md-5 col-sm-5 hidden-xs">
            <h4><?= __(CS_L_DESC) ?></h4>

            <div style="text-align: justify">
                <?= __($excursion->descripcion) ?>
            </div>
            <?php //qtranxf_esc_html(get_post($excursion->Post_ID)->post_content)?>
            <!--           Carrucel -->


        </div>
        <div style="clear: both"></div>
        <hr class="hidden-xs visible-sm">
        <!--    TABS DE RESERVA DE EXCURSION-->
        <div class="col-sm-12 visible-sm">
            <ul id="tabLargeBook" class="nav nav-tabs">
                <li class="active"><a href="#program" data-toggle="tab"><?= __(CS_L_PROGRAMA) ?></a></li>
                <li class=""><a href="#map" data-toggle="tab"><?= __(CS_L_LOCALIZATION) ?></a></li>
                <li class=""><a href="#populate" data-toggle="tab"><?= __(CS_L_POPULARIDAD) ?></a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active fade in" id="program">
                    <div class=" col-sm-12 padding-15-sm">
                        <!--                            PROGRAMA-->
                        <?php $viajes = $excursion->getViajes() ?>
                        <?php if (count($viajes) > 1): ?>
                            <span class="label label-success" style="font-size: 12px">TOTAL:</span>
                            <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                                : <u><?= $excursion->tiempo ?></u></span>
                            <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                                : <u><?= $excursion->distanciaKM ?></u></span>
                        <?php endif ?>
                        <?php foreach ($viajes as $viaje): ?>
                            <?php $destino = $viaje->getDestinoTuristico(); ?>
                            <h4><em class="fa fa-arrow-right"></em><?= __($destino->nombre) ?></h4>
                            <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                                : <u><?= $viaje->tiempo ?></u></span>
                            <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                                : <u><?= $viaje->distanciaKM ?></u></span>
                            <ul style="list-style: none; font-weight: bold; text-align: justify">
                                <?php foreach ($viaje->getPrograma() as $acc): ?>
                                    <li><em class="fa fa-arrow-circle-o-right"></em> <?= __($acc->nombre) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="map">
                    <div class="col-sm-12 padding-15-sm">
                        <?php
                        /** @var ExcursionModel $excursion */
                        $f = $excursion->getImagenExcursiones();
                        ?>
                        <a data-toggle="modal" href="#mapa">
                            <img src="<?= View::getFoto($f[count($f) - 1]->foto) ?>" width="100%" height="100%">
                        </a>
                        <?php ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="populate">
                    <div class="col-sm-12 padding-15-sm">
                        <!--            5*-->
                        <h4>5 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width: <?= $porcientos['cincoEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['cincoEstrellas'] > 7) ? $porcientos['cincoEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            4*-->
                        <h4>4 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['cuatroEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['cuatroEstrellas'] > 7) ? $porcientos['cuatroEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            3*-->
                        <h4>3 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['tresEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['tresEstrellas'] > 7) ? $porcientos['tresEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            2*-->
                        <h4>2 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['dosEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['dosEstrellas'] > 7) ? $porcientos['dosEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            1*-->
                        <h4>1 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['unaEstrella'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['unaEstrella'] > 7) ? $porcientos['unaEstrella'] . '%' : '' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    FIN TABS DE RESERVA DE EXCURSION-->
        <div class="visible-sm" style="clear: both"></div>
        <hr class="visible-sm">
        <!--    ACORDION DE RESERVA DE EXCURSION-->
        <div class="panel-group-reserva visible-xs" id="accordion-reserva">
            <div class="panel panel-reserva">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="descripAcordionLarge" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-reserva"
                           href="#collapseDescReservaLarge">
                            <h3> <?= __(CS_L_DESC) ?> <em class="fa fa-angle-double-down"></em></h3>
                        </a>
                    </h4>
                </div>
                <div id="collapseDescReservaLarge" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div style="text-align: justify">
                            <?= __($excursion->descripcion) ?></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-reserva">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="programaAcordionLarge" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-reserva"
                           href="#collapseProgramReservaLarge">
                            <h3> <?= __(CS_L_PROGRAMA) ?> <em class="fa fa-angle-double-down"></em></h3>
                        </a>
                    </h4>
                </div>
                <div id="collapseProgramReservaLarge" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-5 col-sm-12 right-hr">
                            <!--                            PROGRAMA-->
                            <?php $viajes = $excursion->getViajes() ?>
                            <?php if (count($viajes) > 1): ?>
                                <span class="label label-success" style="font-size: 12px">TOTAL:</span>
                                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                                    : <u><?= $excursion->tiempo ?></u></span>
                                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                                    : <u><?= $excursion->distanciaKM ?></u></span>
                            <?php endif ?>
                            <?php foreach ($viajes as $viaje): ?>
                                <?php $destino = $viaje->getDestinoTuristico(); ?>
                                <h4><em class="fa fa-arrow-right"></em><?= __($destino->nombre) ?></h4>
                                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                                    : <u><?= $viaje->tiempo ?></u></span>
                                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                                    : <u><?= $viaje->distanciaKM ?></u></span>
                                <ul style="list-style: none; font-weight: bold; text-align: justify">
                                    <?php foreach ($viaje->getPrograma() as $acc): ?>
                                        <li><em class="fa fa-arrow-circle-o-right"></em> <?= __($acc->nombre) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-reserva">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="popularidadAcordionLarge" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-reserva"
                           href="#collapsePopReservaLarge">
                            <h3> <?= __(CS_L_POPULARIDAD) ?> <em class="fa fa-angle-double-down"></em></h3>
                        </a>
                    </h4>
                </div>
                <div id="collapsePopReservaLarge" class="panel-collapse collapse">
                    <div class="panel-body">
                        <h4>5 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width: <?= $porcientos['cincoEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['cincoEstrellas'] > 7) ? $porcientos['cincoEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            4*-->
                        <h4>4 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['cuatroEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['cuatroEstrellas'] > 7) ? $porcientos['cuatroEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            3*-->
                        <h4>3 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['tresEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['tresEstrellas'] > 7) ? $porcientos['tresEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            2*-->
                        <h4>2 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['dosEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['dosEstrellas'] > 7) ? $porcientos['dosEstrellas'] . '%' : '' ?></span>
                            </div>
                        </div>
                        <!--            1*-->
                        <h4>1 <span class="fa fa-star"></span></h4>

                        <div class="progress">
                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width:  <?= $porcientos['unaEstrella'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['unaEstrella'] > 7) ? $porcientos['unaEstrella'] . '%' : '' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--   FIN ACORDION DE RESERVA DE EXCURSION-->
        <h3 class="hidden-xs hidden-sm" style="text-align: center"><em
                class="fa fa-calendar"></em> <?= __(CS_L_PROGRAMA) ?></h3>

        <div class="hidden-xs hidden-sm">
            <?php $viajes = $excursion->getViajes() ?>
            <?php if (count($viajes) > 1): ?>
                <span class="label label-success" style="font-size: 12px">TOTAL:</span>
                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                    : <u><?= $excursion->tiempo ?></u></span>
                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                    : <u><?= $excursion->distanciaKM ?></u></span>
            <?php endif ?>
            <?php foreach ($viajes as $viaje): ?>
                <?php $destino = $viaje->getDestinoTuristico(); ?>
                <h4><em class="fa fa-arrow-right"></em><?= __($destino->nombre) ?></h4>
                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_TIEMPO) ?>
                    : <u><?= $viaje->tiempo ?></u></span>
                <span class="label label-info" style="font-size: 12px"><?= __(CS_L_DISTANCIA) ?>
                    : <u><?= $viaje->distanciaKM ?></u></span>
                <ul style="list-style: none; font-weight: bold; text-align: justify">
                    <?php foreach ($viaje->getPrograma() as $acc): ?>
                        <li><em class="fa fa-arrow-circle-o-right"></em> <?= __($acc->nombre) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
        <a name="form_reserva"></a>
        <!--        Formulario-->
        <div class="row-fluid">
            <h3 class="label-formulario"
                style="margin-top: 40px; text-align: center; color: red"><?= __(CS_L_FORMTITLE) ?> <?= __($excursion->nombre) ?></h3>

            <div class="bookbox col-xs-12 col-sm-6 col-md-6 no-padding">
                <form class="validateEngine" id="form_book1" role="form"
                      action="<?= View::genPathSite('book-page?id=' . View::in('id')) ?>">
                    <input type="hidden" name="controller" value="ReservaExcursion.saveJSON">
                    <input type="hidden" name="page" value="site">
                    <label class="label-book col-xs-12 col-sm-12 col-md-12"
                           style="margin: 0"><?= __(CS_L_RESERVA_IP) ?></label>
                    <input required="" class="validate[required,onlyLetterSp] form-control" id="book_nombre_id"
                           type="text" class="form-control" name="nombre"
                           placeholder="(*) First name / Nombre ...">
                    <input id="book_apellidos" type="text" class="form-control" name="apellido"
                           placeholder="Last Name / Apellidos ...">
                    <input id="book_email" type="email" class="validate[required,custom[email]] form-control"
                           name="email"
                           placeholder="(*) Email / Correo ...">
                    <input required="" class="validate[required,onlyLetterSp] form-control" id="book_nombre_id"
                           type="text" class="form-control" name="pais"
                           placeholder="(*) Country / Pais ...">
                </form>
            </div>
            <div class="bookbox col-xs-12 col-sm-6 col-md-6 no-padding">
                <form class="validateEngine" id="form_book2" role="form"
                      action="<?= View::genPathSite('book-page?id=' . View::in('id')) ?>">
                    <label class="label-book col-xs-12 col-sm-12 col-md-12"
                           style="margin: 0"><?= __(CS_L_RESERVA_IR) ?></label>
                    <input id="book_date_id" type="text"
                           class="validate[required,custom[date],future[<?= date('Y/m/d') ?>]] form-control"
                           name="fecha"
                           placeholder="(*) <?= __(CS_L_DIAEXCURSION) ?> ...">
                    <input id="book_time_id" type="text" class="form-control" name="hora"
                           placeholder="Hotel or Address / Hotel o Dirección">
                    <input id="book_personas_id" type="number" class="form-control" name="cantidadPersona" min="1"
                           placeholder="Number of Pax / Cantidad de Pax ...">
                    <select class="form-control" id="book_lenguaje" name="lenguaje">
                        <option>Other Language</option>
                        <?php $c_lan = $model->getLenguaje();
                        foreach ($model->getLanguages() as $lan => $name): ?>
                            <option value="<?= $lan ?>" <?= $lan == $c_lan ? 'selected' : '' ?> ><?= $name ?></option>
                        <?php endforeach ?>
                    </select>
                </form>
            </div>
            <div class="bookbox col-xs-12 col-sm-12 col-md-12 no-padding">
                <form class="validateEngine" id="form_book3" role="form"
                      action="<?= View::genPathSite('book-page?id=' . View::in('id')) ?>">
                    <label class="label-book col-xs-12 col-sm-12 col-md-12"
                           style="margin: 0"><?= __(CS_L_RESERVA_BD) ?></label>

                    <textarea id="descripcion" name="descripcion" rows="5" cols="5"
                              class="descrpcion-reserva"> </textarea>
                </form>
                <div class="espaciar btn-group col-md-10 col-xs-12 col-sm-10 col-md-offset-1 col-sm-offset-1">
                    <button type="button" onclick="submitForm()" class="btn btn-danger col-xs-12 col-sm-12 col-md-12">
                        <b>
                            <em class="fa fa-book"></em> <?= __(CS_L_RESERVA_BUTTON) ?></b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mail_sended" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= __(CS_L_SUBJECT) ?></h4>
            </div>
            <div class="modal-body">
                <?= __(CS_L_INTENTAR) ?>
            </div>
            <div class="modal-footer">
                <!--                <a href="#" class="btn btn-danger">Cancel</a>-->
                <a href="<?= get_page_link($excursion->Post_ID) ?>"
                   class="btn btn-primary"><?= __(CS_L_YACONFIRME) ?></a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="mail_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= __(CS_L_PROCESS) ?></h4>
            </div>
            <div class="modal-body">
                <?php if (View::in('r') == 2): ?>
                    <div style="color: #4b8df8"><em class="fa fa-exclamation-circle"></em> Reserva confirmada
                        correctamente
                    </div>
                <?php else: ?>
                    <div style="color: #CA333E"><em class="fa fa-exclamation-triangle"></em> Ups Ocurrio un prolblema en
                        el momento de Confirmaci&oacute;n
                    </div>
                <?php endif ?>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" href="#" class="btn btn-primary">OK</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="mapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= __(CS_L_LOCALIZATION) ?></h4>
            </div>
            <div id="img_mapa" class="modal-body" style="overflow-x: scroll;overflow-y: scroll">
                <?php $fotos = $excursion->getImagenExcursiones(); ?>
                <img src="<?= View::getFoto($fotos[count($fotos) - 1]->foto) ?>" width="200%">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    window.onload = function () {
        jQuery('.carousel').carousel('cycle');
        jQuery('.validateEngine').validationEngine({
            scrollOffset: 60
        });

        jQuery('#book_date_id').datepicker({
            format: 'yyyy/mm/dd'
        });
//        jQuery('#book_date_id').datetimepicker({
////            format: 'yyyy/mm/d'
//        });

        <?php if(View::in('r')):?>
        jQuery('#mail_confirm').modal('show');
        <?php endif?>
        jQuery('#mapa').on('show.bs.modal', function () {
            console.log(jQuery('#mapa').children('div.modal-body'))
            jQuery('#img_mapa').css('height', (window.innerHeight - 150) + 'px')
        });
    }

    function submitForm() {
        var st = "", c = 0;

        jQuery('form[id^=form_book]').each(function (i, e) {
            if (jQuery(e).validationEngine("validate")) {
                c++;
                st += jQuery(e).serialize() + "&";
            }

        });
        if (c == 3)
            jQuery.get('<?=View::genPathSite('book-page?Excursion_id='.$excursion->id)?>&' + st, {}, function (response) {
                if (response.success) {
                    jQuery('#mail_sended').modal('show');
                }
            })
        event.preventDefault();
    }
</script>

