<?php
/**
 * Created by PhpStorm.
 * User: Randy-PC
 * Date: 3/11/2017
 * Time: 1:40
 */

require_once CS_MVC_PATH_VMODEL . '/ExcursionViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/TipoExcursionViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/CellPortadaViewModel.php';

$modeloExcursiones = new ExcursionViewModel();
$modeloTipoExcursion = new TipoExcursionViewModel();
$modeloCell = new CellPortadaViewModel();

const AVENTURAS = 'adventures';
//DATOS
/** @var ExcursionModel $excursionActiva */
$post = get_post();
$excursionActiva = CellPortadaRepo::create()->getCSPostByID($post->ID);
/** @var ExcursionModel[] $excursiones */
$excursiones = ExcursionRepo::create()->all(null, null, 'isPop DESC, likes DESC');
/** @var TipoExcursionModel[] $tiposExcursiones */
$tiposExcursiones = $modeloTipoExcursion->getTipoExcursiones();
if ($post->post_name == AVENTURAS) {
    $excursionActiva = $excursiones[0];
}
/** @var DestinoTuristicoModel $destinoExcursionActiva */
$destinoExcursionActiva = $modeloExcursiones->getOneDestinoFromExcursion($excursionActiva->id);

?>
<!--===============-->
<!--Hostales-->
<!--===============-->
<nav class="breadcrumb">
    <span class="breadcrumb-item"><?= __(CS_L_PORTADA) ?></span>
    <span class="breadcrumb-item"><?= __(CS_L_AVENTURA) ?></span>
    <span class="breadcrumb-item active"><?= __($excursionActiva->nombre) ?></span>
</nav>
<aside id="right" class="col-xs-12 col-sm-12 col-md-4 float-left">
    <div id="filtro-hostales">
        <select class="form-control form-control-sm" disabled="disabled">
            <option><?= __(CS_L_TODOS_TIPOS) ?></option>
            <option>Paquetes de Viajes</option>
            <option>Excursiones</option>
            <option>Eventos</option>
        </select>
        <select onchange="filtroExcursion(this)" class="form-control form-control-sm">
            <option value="0"><?= __(CS_L_TODAS_MODALIDADES) ?></option>
            <?php
            /** @var TipoExcursionModel $tipoExc */
            foreach ($tiposExcursiones as $tipoExc): ?>
                <option value="<?= $tipoExc->id ?>"><?= __($tipoExc->nombre) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div id="articulos-excursiones">
        <?php
        /** @var ExcursionModel $exc */
        foreach ($excursiones as $exc):?>
            <article
                    class="aside-aventuras <?= $exc->getTipoExcursion()->id ?> <?= ($exc->Post_ID == $excursionActiva->Post_ID) ? 'activo' : ''?>"
                    style="display: inline-block">
                <div class="titulo-aventuras-aside">
                    <a href="<?= get_page_link($exc->Post_ID) ?>#bc"><h3>
                            <b><?= __($exc->nombre)?></b></h3></a>
                </div>
                <div class="cuerpo-aventuras-aside">
                    <div class="col-xs-12 col-sm-12 col-md-6 float-left" style="background: url('<?= View::getFoto(1, $exc->getOneImagenExcursiones()->foto) ?>') no-repeat; background-size: cover" >
                    <img class="col-xs-12 col-sm-12 col-md-6 float-left" style="display: none;"
                         src="<?= View::getFoto(1, $exc->getOneImagenExcursiones()->foto) ?>"
                         alt="<?= __($exc->nombre) ?>">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 float-left descr-aventuras-aside">
                        <hr>
                        <p><?= __($exc->textoCorto) ?></p>
                        <hr>
                        <div class="dias-aventuras">
                            <h4><?= ($exc->cantDias == 1) ? __($exc->cantDias) . ' ' . __(CS_L_DIA) : __($exc->cantDias) . ' ' . __(CS_L_DIAS) ?> </h4>
                        </div>
                        <div class="precio-aventuras-aside">
                            <span class="badge badge-warning"><?= $exc->precio ?></span>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </div>
    <div style="clear: both"></div>
</aside>
<section id="content" class="col-xs-12 col-sm-12 col-md-8 float-left">
    <section id="descripcion-general-aventuras">
        <article id="descripcion-general-aventuras-articulo">
            <h2 id="nombre-aventura"><?= __($excursionActiva->nombre) ?></h2>
            <hr>
            <div class="col-xs-12 col-sm-12 col-md-12 imagen-aventura">
                <img class="imagen-aventura-principal"
                     src="<?= View::getFoto(1, $excursionActiva->getOneImagenExcursiones()->foto) ?>"
                     alt="<?= __($excursionActiva->nombre) ?>">
                <div class="dias-precio-lugar-aventura">
                    <h3><?= ($excursionActiva->cantDias == 1) ? __($excursionActiva->cantDias) . ' ' . __(CS_L_DIA) : __($excursionActiva->cantDias) . ' ' . __(CS_L_DIAS) ?>
                        / <?= ($excursionActiva->cantNoches == 1) ? __($excursionActiva->cantNoches) . ' ' . __(CS_L_NOCHE) : __($excursionActiva->cantNoches) . ' ' . __(CS_L_NOCHES) ?></h3>
                    <h3><?= $excursionActiva->precio ?></h3>
                    <div style="clear: both"></div>
                    <hr>
                    <h5><?= __($destinoExcursionActiva->nombre) ?></h5>
                </div>
            </div>
            <div class="descripcion-aventura">
                <p><?= __($excursionActiva->descripcion) ?></p>
            </div>
        </article>
    </section>
    <hr>
    <section id="mas-informacion-aventuras">
        <!-- Nav tabs -->
        <ul id="tabExcursiones" class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#programa"
                   role="tab"><?= __(CS_L_PROGRAMA_AVENTURA) ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reserva" role="tab"><?= __(CS_L_RESERVA_AVENTURA) ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#incluimos"
                   role="tab"><?= __(CS_L_INCLUIMOS_AVENTURA) ?></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="programa" role="tabpanel">
                <?php
                /** @var ViajeModel $viaje */
                foreach ($excursionActiva->getViajes() as $viaje): ?>
                    <div class="programa-un-dia-aventuras">
                        <h4>
                            <span><?= __(CS_L_DIA) . ' ' . $viaje->orden . ': ' ?></span><?= __($viaje->getDestinoTuristico()->nombre) ?>
                        </h4>
                        <hr>
                        <ul>
                            <?php
                            /** @var AccionModel $programa */
                            foreach ($viaje->getActividades() as $actividad): ?>
                                <li><?= __($actividad->nombre) ?></li>
                            <?php endforeach ?>
                        </ul>
                        <div class="lugar-hospedaje">
                            <img class="imagen-icon-hostal"
                                 src="<?php bloginfo('template_directory'); ?>/img/hostales.png"
                                 alt="Imagen principal">
                            <h4><?= __($viaje->alojamiento_descripcion) ?></h4>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="tab-pane" id="reserva" role="tabpanel">
                <form id="form-reserva-aventura" class="form-inline" role="form"
                      action="<?= View::genPathSite('aventuras?id=' . View::in('id')) ?>">
                    <input type="hidden" name="tokenForm1" value="<?= wp_get_session_token(); ?>">
                    <input type="hidden" name="controller" value="ReservaExcursion.saveJSON">
                    <input type="hidden" name="Excursion_id" value="<?=$exc->id?>">
                    <input type="hidden" name="page" value="site">

                    <p class=" ayuda-form
                "><?= __(CS_L_ALERTA1) ?> <span class="req-fiel">*</span> <?= __(CS_L_ALERTA2) ?></p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="example-date-input" class="col-form-label"><?= __(CS_L_FECHA_INICIO) ?><span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="fecha" class="form-control" type="date" value="2017-11-01"
                                           id="fecha-inicio-aventura-form"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-number-input" class="col-form-label"><?= __(CS_L_CANT_VIAJEROS) ?>
                                    <span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="cantidadPersona" class="form-control" type="number" value="1" min="1" max="6"
                                           id="numero-viajeros-aventura-form"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" class="col-form-label"><?= __(CS_L_NOMBRE_VIAJERO) ?>
                                    <span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="nombre" type="text" class="form-control" id="nombre-aventura-form"
                                           placeholder="<?= __(CS_L_NOMBRE_VIAJERO) ?>"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" class="col-form-label"><?= __(CS_L_APELLIDO_VIAJERO) ?>
                                    <span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="apellido" type="text" class="form-control" id="apellidos-aventura-form"
                                           placeholder="<?= __(CS_L_APELLIDO_VIAJERO) ?>"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email-input" class="col-form-label"><?= __(CS_L_EMAIL_VIAJERO) ?>
                                    <span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="email" class="form-control" type="email" value="nombre@example.com"
                                           id="email-aventura-form"
                                           required="required">
                                </div>
                            </div>


                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label  for="example-date-input" class="col-form-label"><?= __(CS_L_NUMERO_PASAP) ?><span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="pasaporte" type="text" class="form-control" id="pasaporte-aventura-form"
                                           placeholder="<?= __(CS_L_NUMERO_PASAP) ?>"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-tel-input" class="col-form-label"><?= __(CS_L_PAIS) ?></label>
                                <div>
                                    <select name="pais" class="form-control" id="pais-aventuras-form">
                                        <option>Canada</option>
                                        <option>EEUU</option>
                                        <option>Cuba</option>
                                        <option>Brasil</option>
                                        <option>Alemania</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-tel-input" class="col-form-label"><?= __(CS_L_IDIOMA) ?><span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <select name="lenguaje" class="form-control" required="required" id="idioma-aventuras-form">
                                        <option>Espanol</option>
                                        <option>Ingles</option>
                                        <option>Frances</option>
                                        <option>Italiano</option>
                                        <option>Portugues</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-tel-input"
                                       class="col-form-label"><?= __(CS_L_TELEFONO_VIAJERO) ?></label>
                                <div>
                                    <input name="tel" class="form-control" type="tel" value="1-(555)-555-5555"
                                           id="telefono-aventura-form">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" class="col-form-label"><?= __(CS_L_LUGAR_RECOGIDA) ?>
                                    <span
                                            class="req-fiel">*</span></label>
                                <div>
                                    <input name="hora" type="text" class="form-control" id="lugar-aventura-form"
                                           placeholder="<?= __(CS_L_LUGAR_RECOGIDA) ?>"
                                           required="required">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleTextarea" class="col-form-label"><?= __(CS_L_DESCRIPCION) ?></label>
                                <div>
                                    <textarea name="descripcion" class="form-control" id="descripcion" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check pull-left">
                                <label class="custom-control custom-checkbox">
                                    <input required="required" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description"><?= __(CS_L_LICENCIA_1) ?>
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#exampleModalLong"><?= __(CS_L_LICENCIA_2) ?></a></span>
                                </label>
                            </div>
                            <div id="enviar-form-habitacion" class="pull-right">
                                <button type="submit" class="btn btn-success"><?= __(CS_L_ENVIAR) ?></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="tab-pane" id="incluimos" role="tabpanel">
                <div class="servicios-aventuras">
                    <h4><?= __(CS_L_SERVICIOS) ?></h4>
                    <hr>
                    <ul>
                        <?php if (count($excursionActiva->getServicioIncluye()) >= 1): ?>
                            <?php
                            /** @var ObservacionesModel $servicio */
                            foreach ($excursionActiva->getServicioIncluye() as $servicio): ?>
                                <li><?= __($servicio->descripcion) ?></li>
                            <?php endforeach ?>
                        <?php endif ?>
                        <?php if (count($excursionActiva->getServicioIncluye()) < 1): ?>
                            <p><?= __(CS_L_NO_SERVICIOS) ?></p>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="galeria-aventuras">
        <div class="row no-gutter popup-gallery">
            <?php
            /** @var ImagenExcursionModel $img */
            foreach ($excursionActiva->getImagenExcursiones() as $img): ?>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="#">
                        <img class="img-fluid" src="<?= View::getFoto(1, $img->foto) ?>"
                             alt="<?= __($img->nombre) ?>">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">

                                </div>
                                <div class="project-name">

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</section>
<div style="clear: both"></div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= __(CS_L_TERMINOS) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Iniciada en enero de 2001 por Jimmy Wales y Larry Sanger,[6] es la mayor y más popular obra de
                    consulta
                    en Internet.[7][8][9][10] Desde su fundación, Wikipedia no solo ha ganado en popularidad —se
                    encuentra
                    entre los 10 sitios web más populares del mundo—,[10][11] sino que su éxito ha propiciado la
                    aparición
                    de proyectos hermanos: Wikcionario, Wikilibros, Wikiversidad, Wikiquote, Wikinoticias, Wikisource,
                    Wikiespecies y Wikiviajes.
                <p>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>-->
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= __(CS_L_ACEPTAR) ?></button>
            </div>
        </div>
    </div>
</div>
<!--MODAL DE CONFIRMACION DE RESERVA-->
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
                <h4 class=""><?php if (View::in('r') == 1): ?>FELICIDADES!!!<?php endif?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <?php if (View::in('r') == 1): ?>
                    <div style="color: #4b8df8"><em class="fa fa-exclamation-circle"></em> Reserva realizada
                        correctamente. Confirm en su correo electronico. Muchas Gracias.
                    </div>
                <?php elseif (View::in('r') == 2): ?>
                    <div style="color: #CA333E"><em class="fa fa-exclamation-triangle"></em> Ups Ocurrio un problema en
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
<script>
    window.onload = function () {
        <?php if(View::in('r')):?>
        jQuery('#mail_confirm').modal('show');
        <?php endif?>


        var $content = $('#content'), $right = $('#right');

        var height = window.innerHeight * 1;
        var hdiv_content = $content[0].clientHeight * 1,
            ydiv_content = $content[0].offsetTop,
            thdiv_content = ydiv_content + hdiv_content,
            hdiv_right = ($right[0]) ? $right[0].clientHeight * 1 : 0,
//  		ydiv_right = $right[0].offsetTop,
            ydiv_right = ydiv_content,
            thdiv_right = ydiv_right + hdiv_right,
        //es para saber quien es + alto el right o content
            flag = hdiv_right > hdiv_content,
        //comprobando de que ya esta pasado entonces debe estar fijo
            flag_fijo = window.scrollY * 1 > thdiv_content - height;
        flag_igual = false;

        function fijarPaneles(event) {
//            var hamb = $('.navbar-ex1-collapse');
//            hamb.removeClass('in');
//            hamb.addClass('collapse');
//            if (window.innerWidth < 768) {
//                var logo = $('#logoPortada');
//                if (window.scrollY > 20) {
//                    logo.fadeOut('normal');
//                }
//                else {
//                    logo.fadeIn('normal');
//                }
//            }
            if ($right && window.innerWidth > 991) {
                height = window.innerHeight * 1;
                if (flag) {
                    //ydiv_content = $content[0].offsetTop;
                    //thdiv_content = ydiv_content + hdiv_content;
                    if (window.scrollY * 1 > thdiv_content - height) {
                        flag_igual = window.scrollY * 1 >= thdiv_right - height;
                        if (flag_igual) {
                            $content.css({
                                position: 'relative',
                                left: 0, top: hdiv_right - hdiv_content
                            });
                        }
                        else {
                            $content.css({
                                position: 'fixed',
//                            left: 0, top: ((ydiv_content - offsetScroll))
                                left: 0, top: height - hdiv_content
                            });

                        }


                        //alert(ydiv_content+"-"+hdiv_content+"-"+window.scrollY);
                    } else {
                        $content.css({
                            position: 'relative',
                            left: 0, top: 0
                        });
                        //flag_fijo = false;
                    }
                }
                else {
                    if (window.scrollY > ydiv_right + hdiv_right - height) {
                        flag_igual = window.scrollY * 1 >= thdiv_content - height;
                        if (flag_igual) {
                            $right.css({
                                position: 'relative',
                                right: 0, top: hdiv_content - (hdiv_right)
                            });
                        }
                        else {
                            $right.css({
                                position: 'fixed',
                                right: 0, top: height - hdiv_right
                            });

                        }
                    } else {
                        $right.css({
                            position: 'relative',
                            right: 0, top: 0
                        });
                        //flag_fijo = false;
                    }

                }
            }
        }

        function calculoParametros() {
            if ($right[0]) {
                hdiv_content = $content[0].clientHeight * 1,
                    ydiv_content = $content[0].offsetTop,
                    thdiv_content = ydiv_content + hdiv_content,
                    hdiv_right = $right[0].clientHeight * 1,
//  		ydiv_right = $right[0].offsetTop,
                    ydiv_right = ydiv_content,
                    thdiv_right = ydiv_right + hdiv_right,
                    //es para saber quien es + alto el right o content
                    flag = hdiv_right > hdiv_content,
                    //comprobando de que ya esta pasado entonces debe estar fijo
                    flag_fijo = window.scrollY * 1 > thdiv_content - height;
                flag_igual = false;
                fijarPaneles();
            }
        }

        fijarPaneles();
//        setTimeout(calculoParametros, 3000);
//        if ($right[0]) {
//            window.onscroll = fijarPaneles;
//            window.onresize = calculoParametros;
//        }

    };
</script>
