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
$fotos = $excursion->getImagenExcursiones();
$viajes = $excursion->getViajes();
$precios = $excursion->getListadoPrecios();
$sers = $excursion->getServicioExcursiones();
$observ = $excursion->getObservaciones();

//Lo nuevo
$ratinModel = new RatingViewModel();
$porcientos = array();
$post = get_post();
$id = get_post_field('id', $post);
$porcientos = $ratinModel->getPorciento($id);
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Portada</a></li>
    <li class="breadcrumb-item"><a href="#">Aventuras</a></li>
    <li class="breadcrumb-item active"><?= __($excursion->nombre) ?></li>
</ol>
<div class="container-fluid">
    <h2 class="excursion-title"><b><?= __($excursion->nombre) ?></b></h2>

    <div class="excursion-top">
        <div class="col-xs-12 col-sm-12 col-md-5 top-left">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $i = 0;
                    foreach ($fotos as $foto): ?>
                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                            <img class="d-block img-fluid" src="<?= View::getFoto($foto->foto) ?>" alt="First slide">

                            <div class="carousel-caption d-none d-md-block">
                                <h3><?= __($foto->nombre) ?></h3>

                                <p><?= __($excursion->nombre) ?></p>
                            </div>
                        </div>
                        <?php $i++; endforeach ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 top-right">
            <h3><em class="fa fa-info-circle"></em> Información sobre la aventura</h3>
            <hr>
            <p><?= __($excursion->descripcion) ?></p>

            <div class="extra-info">
                <div class="col-xs-12 col-sm-12 col-md-3 duracion"><h4 class="verde"><em class="fa fa-clock-o"></em>
                        Duración: </h4>
                    <h5><em class="fa fa-moon-o noche"></em> <span
                            style="color: #999999"><?= $excursion->cantNoches ?> noches</span></h5>
                    <h5><em class="fa fa-sun-o dia"></em> <span
                            style="color: #F0AD4E"><?= $excursion->cantDias ?> días</span></h5></div>
                <div class="col-xs-12 col-sm-12 col-md-6 precio">
                    <h4 class="verde"><em class="fa fa-dollar"></em> Precios: </h4>
                    <?php foreach ($precios as $precio): ?>
                        <h5><?= $precio->precio . ' ' . $precio->moneda . "/ Por persona para " . $precio->cantidadPersonas . " viajero" ?></h5>
                    <?php endforeach ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 lugar">
                    <h4 class="verde"><em class="fa fa-map-marker"></em> Lugares: </h4>
                    <?php foreach ($viajes as $viaje): ?>
                        <h5><?= __($viaje->getDestinoTuristico()->nombre) ?></h5>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
    <hr class="hr-limpio">
    <div class="col-xs-12 col-sm-12 col-md-6 booton-left">
        <h2>Programa de la excursion</h2>
        <div class="programa">
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
    <div class="col-xs-12 col-sm-12 col-md-6 booton-right">
        <h2>Servcios:</h2>
        <?php foreach ($sers as $s): ?><?php var_dump($s);?> 
		<h5><?= __($s->getServicio()->nombre) ?></h5>
        <?php endforeach ?>
        <h2>Observaciones:</h2>
        <?php foreach ($observ as $o): ?>
            <h5>- <?= __($o->descripcion) ?></h5>
        <?php endforeach ?>
    </div>
    <div style="clear: both"></div>
</div>

