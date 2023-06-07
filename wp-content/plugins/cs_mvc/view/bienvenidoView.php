<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
require_once CS_MVC_PATH_VMODEL . '/CellPortadaViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/ExcursionViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/AlojamientoViewModel.php';
//ARTICULOS

$model = new CellPortadaViewModel();
$modelExcursiones = new ExcursionViewModel();
$modelHostales = new AlojamientoViewModel();

$articulosPortada = $model->getArticulosPortada();

/** @var CellPortadaModel $articuloPrincipal */
$articuloPrincipal = $articulosPortada[0];
$post_principal = get_post($articuloPrincipal->Post_ID);
/** @var CellPortadaModel $articuloSecundario */
$articuloSecundario = $articulosPortada[1];
$post_secundario = get_post($articuloSecundario->Post_ID);
/** @var CellPortadaModel $articuloExtra */
$articuloExtra = $articulosPortada[2];
$post_extra = get_post($articuloExtra->Post_ID);

$articulosDestacados = $model->getArticulosDestacados(3);
$excursionespopulares = $modelExcursiones->getExcursionPopulares(2);
$hostalespopulares = $modelHostales->getHostalesPopulares(4);
?>
<nav class="breadcrumb" style="margin-top: 0; background-color: #28a745; border-radius: 0"></nav>

<section id="noticias-portada">
    <article id="articulo-primario" class="col-xs-12 col-sm-12 col-md-12">
        <img class="d-block img-art-princ"
             src="<?= ($articuloPrincipal->foto == '') ? __($post_principal->post_mime_type) : __(View::getFoto(3, $articuloPrincipal->foto)); ?>"
             alt="First slide">
        <div id="descripcion-articulo-principal">
            <div id="titulo-artic-principal">
                <a href="<?= get_page_link($post_principal->ID) ?>">
                    <h2><?= ($articuloPrincipal->nombre == '') ? __($post_principal->post_title) : __($articuloPrincipal->nombre); ?></h2>
                </a>
            </div>
            <div id="texto-artic-principal">
                <p><?= ($articuloPrincipal->textoCorto == '') ? __($post_principal->post_content) : __($articuloPrincipal->textoCorto); ?></p>
            </div>
        </div>
    </article>
    <div style="clear: both"></div>
    <hr class="hidden-phone">
    <article id="articulo-secundario" class="col-xs-12 col-sm-12 col-md-7 float-left">
        <div id="titulo-artic-secundario">
            <a href="<?= get_page_link($post_secundario->ID) ?>">
                <h2><?= ($articuloSecundario->nombre == '') ? __($post_secundario->post_title) : __($articuloSecundario->nombre); ?></h2>
            </a>
        </div>
        <img class="d-block img-art-secundario"
             src="<?= ($articuloSecundario->foto == '') ? __($post_secundario->post_mime_type) : __(View::getFoto(3, $articuloSecundario->foto)); ?>"
             alt="First slide">
        <div id="descripcion-articulo-secundario">
            <div id="texto-artic-secundario">
                <p><?= ($articuloSecundario->textoCorto == '') ? __($post_secundario->post_content) : __($articuloSecundario->textoCorto); ?></p>
            </div>
        </div>
    </article>
    <section id="seccion-derecha" class="col-xs-12 col-sm-12 col-md-5 float-left">
        <article id="articulo-terciario">
            <img class="d-block img-art-terciario col-xs-12 col-sm-12 col-md-6 float-left"
                 src="<?= ($articuloExtra->foto == '') ? __($post_extra->post_mime_type) : __(View::getFoto(3, $articuloExtra->foto)); ?>"
                 alt="First slide">
            <div class="col-xs-12 col-sm-12 col-md-6 float-left">
                <div id="titulo-artic-terciario">
                    <a href="<?= get_page_link($post_extra->ID) ?>">
                        <h3><?= ($articuloExtra->nombre == '') ? __($post_extra->post_title) : __($articuloExtra->nombre); ?></h3>
                    </a>
                </div>
                <div id="descripcion-articulo-terciario">
                    <div id="texto-artic-terciario">
                        <p><?= ($articuloExtra->textoCorto == '') ? __($post_extra->post_content) : __($articuloExtra->textoCorto); ?></p>
                    </div>
                </div>
            </div>
        </article>
        <div style="clear: both"></div>
        <hr>
        <aside>
            <div id="titulo-aside-articulos">
                <h3><?= __(CS_L_ARTICULOS_DESTACADOS) ?></h3>
                <hr>
            </div>
            <div id="lista-aside-articulos">
                <ul>
                    <?php foreach ($articulosDestacados as $post): ?>
                        <li><a href="<?= get_page_link($post->ID) ?>"><?= __($post->post_title) ?></a></li>
                        <hr>
                    <?php endforeach ?>
                </ul>
            </div>
            <div id="boton-mas-aside-articulos">
                <a class="btn btn-warning"
                   href="<?= View::genPathSite('articulos') ?>"><?= __(CS_L_MAS_ARTICULOS) ?></a>
            </div>
        </aside>
    </section>
</section>
<div style="clear: both"></div>
<div id="aventuras-titulo">
    <h2><b><?= __(CS_L_AVENTURAS) ?></b></h2>
    <a href="<?= get_page_link(154) ?>"><h2><em class="fa fa-arrow-circle-right"></em></h2></a>
    <div style="clear: both"></div>
</div>
<section id="aventuras-portada">
    <div id="aventuras" class="col-xs-12 col-sm-12 col-md-9 float-left">
        <?php
        /** @var ExcursionModel $popExc */
        foreach ($excursionespopulares as $popExc): ?>
            <article class="articulos-aventuras">
                <div class="aventuras-detalles">
                    <img class="img-new" src="<?php bloginfo('template_directory'); ?>/img/new-w.png" alt="Nuevo">
                    <img class="d-block img-avent col-xs-12 col-sm-12 col-md-8 float-left"
                         src="<?= HTML::getFoto(1, $popExc->getOneImagenExcursiones()->foto) ?>"
                         alt="<?= __($popExc->nombre) ?>">
                    <div class="col-xs-12 col-sm-12 col-md-4 float-left panel-aventuras-derecha">
                        <div id="titulo-aventura">
                            <a href="<?= get_page_link($popExc->Post_ID) ?>#bc"><h3><?= __($popExc->nombre) ?></h3></a>
                        </div>
                        <div id="descripcion-aventura">
                            <div id="texto-aventura">
                                <p><?= __($popExc->textoCorto) ?></p>
                            </div>
                        </div>
                        <div class="dias-aventuras">
                            <h3><?= ($popExc->cantDias == 1) ? __($popExc->cantDias) . ' ' . __(CS_L_DIA) : __($popExc->cantDias) . ' ' . __(CS_L_DIAS) ?></h3>
                        </div>
                        <div class="precio-aventuras">
                            <span class="badge badge-warning"><?= $popExc->precio ?></span>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </div>
    <aside id="aventuras-aside" class="col-xs-12 col-sm-12 col-md-3 float-left">
        <div class="text-center">
            <img src="<?php bloginfo('template_directory'); ?>/img/app.png" class="rounded" alt="Logo App">
        </div>
        <a href="#"><h2><?= __(CS_L_APP) ?></h2></a>
        <p><?= __(CS_L_APP_DESC) ?></p>
        <div class="boton-descarga-app">
            <button type="button" class="btn btn-warning"><?= __(CS_L_DESCARGA) ?></button>
        </div>
        <hr>
        <div class="text-center">
            <img src="<?php bloginfo('template_directory'); ?>/img/promo.png" class="rounded" alt="Logo Promo">
        </div>
        <div class="enlace-promo">
            <a href="#"><?= __(CS_L_NEGOCIO) ?></a>
        </div>
    </aside>
    <div style="clear: both"></div>
</section>
<div id="hostales-titulo">
    <h2><b><?= __(CS_L_HOSTALES) ?></b></h2>
    <a href="<?= View::genPathSite('hostales') ?>"><h2><em class="fa fa-arrow-circle-right"></em></h2></a>
    <div style="clear: both"></div>
</div>
<section id="hostales-portada" class="col-xs-12 col-sm-12 col-md-12">
    <?php
    /** @var AlojamientoModel $popHost */
    foreach ($hostalespopulares as $popHost):
        $cantHabitac=count($popHost->getHabitaciones());
        ?>
        <div class="col-xs-12 col-sm-12 col-md-3 float-left card" style="width: 20rem;">
            <img class="card-img-top" src="<?= HTML::getFoto(2, $popHost->getOneImagenAlojamientos()->foto) ?>"
                 alt="<?= __($popHost->nombre) ?>">
            <div class="card-block">
                <a href="<?= get_page_link($popHost->Post_ID) ?>#bc"><h4 class="card-title">
                        <b><?= __($popHost->nombre) ?></b></h4></a>
                <h4 class="card-text"><?= ($cantHabitac <= 1) ? $cantHabitac.' ' . __(CS_L_TODOS_HABITACION) : $cantHabitac.' ' . __(CS_L_TODOS_HABITACIONES) ?></h4>
            </div>
        </div>
    <?php endforeach ?>
</section>
<div style="clear: both"></div>

