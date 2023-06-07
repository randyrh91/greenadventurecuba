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

//vm = new E();
/** @var ExcursionModel $excursion */
$excursion = $this->item;

//Lo nuevo
$ratinModel = new RatingViewModel();
$porcientos = array();
$post = get_post();
$id = get_post_field('id', $post);
$porcientos = $ratinModel->getPorciento($id);
?>

<div class="container-fluid no-padding">
    <div class="row-fluid">
        <div class="span9">
            <h1 class="nombre-excursion" style="text-align: center"><em class="fa fa-book"></em> <?= __($excursion->nombre) ?></h1>
        </div>
        <hr class="hidden-xs">
    </div>
    <div class="row-fluid">
        <!--    ACORDION DE RESERVA DE EXCURSION-->
        <div class="panel-group-reserva" id="accordion-reserva">
            <div class="panel panel-reserva">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="descripAcordion" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-reserva"
                           href="#collapseDescReserva">
                            <h3><?= __(CS_L_DESC) ?> <em class="fa fa-angle-double-down"></em></h3>
                        </a>
                    </h4>
                </div>
                <div id="collapseDescReserva" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div style="text-align: justify">
                            <?= __($excursion->descripcion) ?></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-reserva">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="programaAcordion" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-reserva"
                           href="#collapseProgReserva">
                            <h3><?= __(CS_L_PROGRAMA) ?> <em class="fa fa-angle-double-down"></em></h3>
                        </a>
                    </h4>
                </div>
                <div id="collapseProgReserva" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-12 col-sm-12 right-hr">
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

        </div>
        <!--   FIN ACORDION DE RESERVA DE EXCURSION-->
        <div id="carousel-example-generic" class="carousel slide" style="width: 100%" data-slide="next">
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


        <!--           Carrucel -->

    </div>
</div>

