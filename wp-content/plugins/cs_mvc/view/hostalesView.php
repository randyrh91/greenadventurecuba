<?php
/**
 * Created by PhpStorm.
 * User: Randy-PC
 * Date: 3/11/2017
 * Time: 1:40
 */
require_once CS_MVC_PATH_VMODEL . '/AlojamientoViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/CellPortadaViewModel.php';


const HOSTALES = 'hostals';
$post = get_post();

/** @var AlojamientoModel $hostalActivo */
$hostalActivo = CellPortadaRepo::create()->getCSPostByID($post->ID);

/** @var AlojamientoModel[] $hostales */
$hostales = AlojamientoRepo::create()->all(null, null, 'isPop DESC');
$tiposHostales = TipoAlojamientoRepo::create()->all();
$destinosTuristicos = DestinoTuristicoRepo::create()->all();

if ($post->post_name == HOSTALES) {
    $hostalActivo = $hostales[0];
}
$habitacionesHostalActivo = $hostalActivo->getHabitaciones();

?>
<!--===============-->
<!--Hostales-->
<!--===============-->
<nav class="breadcrumb">
    <span class="breadcrumb-item"><?= __(CS_L_PORTADA) ?></span>
    <span class="breadcrumb-item"><?= __(CS_L_ALOJAMIENTO) ?></span>
    <span class="breadcrumb-item active"><?= __($hostalActivo->nombre) ?></span>
</nav>
<aside class="col-xs-12 col-sm-12 col-md-4 float-left">
    <div id="filtro-hostales">
        <select id="select-destino-hostal" onchange="filtroDestinoHostal(this)" class="form-control form-control-sm">
            <option value="0"><?= __(CS_L_TODOS_DESTINOS) ?></option>
            <?php
            /** @var DestinoTuristicoModel $destino */
            foreach ($destinosTuristicos as $destino): ?>
                <option value="<?= $destino->id ?>"><?= __($destino->nombre) ?></option>
            <?php endforeach ?>
        </select>
        <select id="select-tipo-hostal" onchange="filtroTipoHostal(this)" class="form-control form-control-sm">
            <option value="0"><?= __(CS_L_TODOS_TIPOS) ?></option>
            <?php
            /** @var TipoAlojamientoModel $tipoHostal */
            foreach ($tiposHostales as $tipoHostal): ?>
                <option value="<?= $tipoHostal->id ?>"><?= __($tipoHostal->nombre) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div id="articulos-hostales-div">
        <?php
        /** @var AlojamientoModel $hostal */
        foreach ($hostales as $hostal):
            $cantidadHabit = count($hostal->getHabitaciones());
            ?>
            <article
                    class="aside-hostales <?= $hostal->getDestinoTuristico()->id . ' ' . $hostal->getTipoAlojamiento()->id ?> <?= ($hostal->Post_ID == $hostalActivo->Post_ID) ? 'activo' :'' ?>"
                    style="display: inline-block">
                <div class="titulo-hostales-aside">
                    <a href="<?= get_page_link($hostal->Post_ID) ?>#bc"><h2><b><?= __($hostal->nombre) ?></b></h2></a>
                </div>
                <div class="cuerpo-hostales-aside">
                    <img class="col-xs-12 col-sm-12 col-md-6 float-left"
                         src="<?= View::getFoto(View::IMG_ALOJAMIENTO, $hostal->getOneImagenAlojamientos()->foto) ?>"
                         alt="<?= __($hostal->nombre) ?>">
                    <div class="col-xs-12 col-sm-12 col-md-6 float-left">
                        <hr>
                        <h6><?= __($hostal->getTipoAlojamiento()->nombre) ?></h6>
                        <h6><?= __($hostal->direccion) ?></h6>
                        <h5>
                            <b><?= ($cantidadHabit <= 1) ? $cantidadHabit . ' ' . __(CS_L_TODOS_HABITACION) : $cantidadHabit . ' ' . __(CS_L_TODOS_HABITACIONES) ?></b>
                        </h5>
                    </div>
                </div>
                <div class="servicios-hostales-aside">
                    <?php
                    /** @var ServiciosModel $tipoHostal */
                    foreach ($hostal->getServicios() as $servicio): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/icons-hostales/<?= $servicio->icono ?>"
                             alt="<?= __($servicio->nombre) ?>">
                    <?php endforeach ?>
                </div>
            </article>
        <?php endforeach ?>
    </div>
    <div style="clear: both"></div>
</aside>
<section class="col-xs-12 col-sm-12 col-md-8 float-left">
    <section id="descripcion-general-hostales">
        <article id="descripcion-general-hostal-articulo">
            <h2 id="nombre-hostal"><?= __($hostalActivo->nombre) ?></h2>
            <hr>
            <h6 id="direccion-hostal"><?= __($hostalActivo->direccion) ?>
                , <?= __($hostalActivo->getDestinoTuristico()->nombre) ?></h6>
            <div class="col-xs-12 col-sm-12 col-md-12 imagen-hostal">
                <img class="imagen-habitacion-principal"
                     src="<?= View::getFoto(2, $hostalActivo->getOneImagenAlojamientos()->foto) ?>"
                     alt="<?= __($hostalActivo->nombre) ?>">
                <div class="habitaciones-capacidad-hostal">
                    <h3><?= __(CS_L_TODOS_HABITACIONES_ACTIVA) . ' ' . count($habitacionesHostalActivo) ?></h3>
                    <h3><?= __(CS_L_TODOS_CAPACIDAD) . ' ' . $hostalActivo->cantMax ?> </h3>
                </div>
                <div class="iconos-servicios-hostales">
                    <?php
                    /** @var ServiciosModel $tipoHostal */
                    foreach ($hostalActivo->getServicios() as $servicio): ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/icons-hostales/<?= $servicio->icono ?>"
                             alt="<?= __($servicio->nombre) ?>">
                    <?php endforeach ?>
                </div>
            </div>
            <div class="descripcion-hostal">
                <p><?= __($hostalActivo->descripcion) ?></p>
            </div>
        </article>
    </section>
    <hr>
    <section id="habitaciones-hostales">
        <?php
        $i = 1;
        /** @var HabitacionModel $habitac */
        foreach ($habitacionesHostalActivo as $habitac):
            $icono = "hav" . $i . ".png";
            ?>
            <article class="articulo-habitacion-hostal">
                <div class="col-xs-12 col-sm-12 col-md-12 imagen-hostal">
                    <img class="logo-habitacion"
                         src="<?php bloginfo('template_directory'); ?>/img/icons-hostales/<?= $icono ?>">
                    <img class="imagen-habitacion-principal"
                         src="<?= View::getFoto(5, $habitac->getOneImagenHabitaciones()->foto) ?>"
                         alt="<?= __($habitac->getOneImagenHabitaciones()->nombre) ?>">
                    <div class="habitaciones-precio-hostal">
                        <h3><?= $habitac->precioBaja ?></h3>
                        <h3><?= $habitac->precio ?></h3>
                    </div>
                    <div class="iconos-servicios-hostales">
                        <?php
                        /** @var ServiciosModel $tipoHostal */
                        foreach ($habitac->getServicios() as $servicio): ?>
                            <img src="<?php bloginfo('template_directory'); ?>/img/icons-hostales/<?= $servicio->icono ?>"
                                 alt="<?= __($servicio->nombre) ?>">
                        <?php endforeach ?>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </section>
    <section id="reserva-hostales">
        <div id="form-reserva-header">
            <h2>Reservar Habitacion</h2>
        </div>
        <form id="form-reserva-habitacion" class="form-inline">
            <p class="ayuda-form"><?=__(CS_L_ALERTA1)?> <span class="req-fiel">*</span> <?=__(CS_L_ALERTA2)?></p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_FECHA_ENTRADA) ?><span>*</span></label>
                        <div>
                            <input class="form-control" type="date" value="2017-11-01" id="fecha-entrada-form"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_FECHA_SALIDA) ?><span>*</span></label>
                        <div>
                            <input class="form-control" type="date" value="2017-11-05" id="fecha-salida-form"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_NOMBRE_VIAJERO) ?><span>*</span></label>
                        <div>
                            <input type="text" class="form-control" id="nombre-form"
                                   placeholder="<?= __(CS_L_NOMBRE_VIAJERO) ?>"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_APELLIDO_VIAJERO) ?><span>*</span></label>
                        <div>
                            <input type="text" class="form-control" id="apellidos-form"
                                   placeholder="<?= __(CS_L_APELLIDO_VIAJERO) ?>"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email-input" class="col-form-label"><?= __(CS_L_EMAIL_VIAJERO) ?><span>*</span></label>
                        <div>
                            <input class="form-control" type="email" value="nombre@example.com" id="email-form"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea" class="col-form-label"><?= __(CS_L_DESCRIPCION) ?></label>
                        <div>
                            <textarea class="form-control" id="descripcion-form" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="example-number-input" class="col-form-label"><?= __(CS_L_NO_HABITACIONES) ?><span>*</span></label>
                        <div>
                            <input class="form-control" type="number" value="1" min="1" max="6" id="numero-habitaciones-form"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_NUMERO_PASAP) ?><span>*</span></label>
                        <div>
                            <input type="text" class="form-control" id="pasaporte-form"
                                   placeholder="<?= __(CS_L_NUMERO_PASAP) ?>"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-tel-input" class="col-form-label"><?= __(CS_L_PAIS) ?></label>
                        <div>
                            <select class="form-control" id="pais-form">
                                <option>Canada</option>
                                <option>EEUU</option>
                                <option>Cuba</option>
                                <option>Brasil</option>
                                <option>Alemania</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-tel-input" class="col-form-label"><?= __(CS_L_TELEFONO_VIAJERO) ?></label>
                        <div>
                            <input class="form-control" type="tel" value="1-(555)-555-5555" id="telefono-form">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input" class="col-form-label"><?= __(CS_L_LUGAR_RECOGIDA) ?>
                            <span
                                    class="req-fiel">*</span></label>
                        <div>
                            <input type="text" class="form-control" id="lugar-hostal-form"
                                   placeholder="<?= __(CS_L_LUGAR_RECOGIDA) ?>"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="enviar-form-habitacion" class="offset-sm-2">
                            <button type="submit" class="btn btn-success"><?= __(CS_L_ENVIAR) ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section id="galeria-hostales">
        <div class="row no-gutter popup-gallery">
            <?php
            /** @var ImagenAlojamientoModel $img */
            foreach ($hostalActivo->getImagenAlojamientos() as $img): ?>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="#">
                        <img class="img-fluid" src="<?= View::getFoto(2, $img->foto) ?>"
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
