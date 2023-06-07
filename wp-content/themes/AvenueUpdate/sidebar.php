<?php

/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
require_once CS_MVC_PATH_VMODEL . '/ExcursionViewModel.php';
require_once CS_MVC_PATH_VMODEL . '/RatingViewModel.php';
require_once CS_MVC_PATH_MODEL . '/TransporteModel.php';
require_once CS_MVC_PATH_MODEL . '/DestinoTuristicoModel.php';
$model = new ExcursionViewModel();
$ratinModel = new RatingViewModel();
$porcientos = array();
$transportes = $model->getRandomTransportes();
$destinos = $model->getRandomDestinos();
$post = get_post();
$is_book = $post && get_post_field('view', $post) == 'bookView' || get_post_field('view', $post) == 'bookLargeView';
$id = 0;
$is_visitor = $post && $post->post_name == "book-of-visit";
if ($is_book && ($id = get_post_field('id', $post))) {
    /** @var ExcursionModel $exc */
    $transportes = $model->getTransporteFromExcursion($id);
    $destinos = $model->getDestinosFromExcursion($id);
    $porcientos = $ratinModel->getPorciento($id);
}
?>
<div id="right" class="col-xs-12 col-sm-12 col-md-3 visible-md visible-lg">
    <!--    Mapa-->
    <div id="fast_contact" class="sidebox clearfix">

        <h3 class="sidetitle"><?= $is_book ? __(CS_L_LOCALIZATION) : __(CS_L_MEJORESAUTOS) ?></h3>

        <div class="mejores-autos">
            <?php if ($is_book && $id):
                /** @var ExcursionModel $excursion */
                $excursion = ExcursionRepo::create()->oneBy($id * 1);
                $fotos = $excursion->getImagenExcursiones();
                ?>
                <a data-toggle="modal" href="#mapa">
                <img src="<?= View::getFoto($fotos[count($fotos) - 1]->foto) ?>" width="100%">
                </a>
            <?php
            /** @var TransporteModel $transp */
            else: foreach ($transportes as $transp): ?>
                <a href="#" class="pull-left">
                    <img width="100px"
                         src="<?= View::getFoto($transp->foto) ?>">
                </a>
                <div class="mejores-autos-body">
                    <h4 class="media-heading"><?= __($transp->nombre) ?></h4>
                    <label class="label label-info"><?=$transp->getTipoTransporte()?></label><br>
                    <?= __($transp->textoCorto) ?>
                </div>
                <hr>
            <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <!--    Rating  -->
    <?php if ($is_book): ?>
        <div id="best_cars" class="sidebox clearfix">
            <h3 class="sidetitle"><?= __(CS_L_POPULARIDAD) ?></h3>
            <!--Grafico Barra-->
            <div class="popularidad">
                <!--            5*-->
                <h4>5 <span class="fa fa-star"></span></h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100" style="width: <?= $porcientos['cincoEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['cincoEstrellas'] > 7) ? $porcientos['cincoEstrellas'] . '%' : '' ?></span>
                    </div>
                </div>
                <!--            4*-->
                <h4>4 <span class="fa fa-star"></span></h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100" style="width:  <?= $porcientos['cuatroEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['cuatroEstrellas'] > 7) ? $porcientos['cuatroEstrellas'] . '%' : '' ?></span>
                    </div>
                </div>
                <!--            3*-->
                <h4>3 <span class="fa fa-star"></span></h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100" style="width:  <?= $porcientos['tresEstrellas'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['tresEstrellas'] > 7) ? $porcientos['tresEstrellas'] . '%' : '' ?></span>
                    </div>
                </div>
                <!--            2*-->
                <h4>2 <span class="fa fa-star"></span></h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100" style="width:  <?= $porcientos['dosEstrellas'] ?>%">
                        <span
                            class="sr-only"> <?= ($porcientos['dosEstrellas'] > 7) ? $porcientos['dosEstrellas'] . '%' : '' ?></span>
                    </div>
                </div>
                <!--            1*-->
                <h4>1 <span class="fa fa-star"></span></h4>

                <div class="progress">
                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100" style="width:  <?= $porcientos['unaEstrella'] ?>%">
                        <span
                            class="sr-only"><?= ($porcientos['unaEstrella'] > 7) ? $porcientos['unaEstrella'] . '%' : '' ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <!--  Mejores Destinos  -->
    <div id="best_cars" class="sidebox clearfix">
        <h3 class="sidetitle"><?= $is_book ? __(CS_L_DESTINOSUTIL) : __(CS_L_MEJORESDESTINOS) ?></h3>

        <div class="metro-social metro-height" style="">
            <div class="mejores-autos">
                <?php
                /** @var DestinoTuristicoModel $dest */
                foreach ($destinos as $dest):?>
                    <a href="#" class="pull-left">
                        <img width="100px" height="60px" src="<?= View::getFoto($dest->foto) ?>">
                    </a>
                    <div class="mejores-autos-body">
                        <h4 class="media-heading"><?= __($dest->nombre) ?></h4>
                        <?= __($dest->textoCorto) ?>
                    </div>
                    <hr>
                <?php endforeach ?>
            </div>
        </div>

    </div>
    <!--    Redes socilaes-->
    <div id="best_cars" style="border-bottom: 4px solid #3192C8" class="sidebox clearfix">
        <h3 class="sidetitle"><?= __(CS_L_FOLLOW) ?></h3>
        <div class="social-icons ">
            <span><a href="https://facebook.com" onclick="errorSocial();" data-original-title="facebook" class="facebook"></a></span>
            <span><a href="https://twitter.com" onclick="errorSocial();" data-original-title="twitter" class="twitter"></a></span>
            <span><a href="https://instagram.com" onclick="errorSocial();" data-original-title="instagram" class="instagram"></a></span>
            <span><a href="https://tripAdvisor.com" onclick="errorSocial();" data-original-title="tripAdvisor" class="tripAdvisor"></a></span>
        </div>

    </div>
    <ul>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar')) : else : ?>
        <?php endif; ?>
    </ul>
</div>
